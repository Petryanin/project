<?php
require_once 'db.php';

function clear_str($data) {
	return trim(strip_tags($data));
}

function clear_int($data) {
	return abs((int) $data);
}

function save_comment_to_db() {
	global $link;
	$user_id = $_SESSION['user']['user_id'];
	$msg = clear_str($_POST['msg']);

	$sql = "INSERT INTO msgs(user_id, msg) VALUES (?, ?)";
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, "is", $user_id, $msg);
	mysqli_stmt_execute($stmt);

	header("Location: " . $_SERVER['REQUEST_URI']);
	exit;
}

function del_comment_from_db() {
	global $link;
	$del = abs((int) $_GET['del']);

	if ($del) {
		$sql = "DELETE FROM msgs WHERE  msg_id = ?";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "i", $del);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}

function output_comments() {
	global $link;

	$sql = "SELECT u.user_id, msg_id, msg, username, email, UNIX_TIMESTAMP(datetime) as dt
					FROM msgs m
					JOIN users u
						ON m.user_id = u.user_id
					ORDER BY msg_id DESC";
	$result = mysqli_query($link, $sql);
	mysqli_close($link);

	if (!$result)
		return false;

	$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $arr;
}

function convert_res_to_arr($data) {
	global $basket;
	$arr = [];

	while ($row = mysqli_fetch_assoc($data)) {
		$row['quantity'] = $basket[$row['item_id']];
		$arr[] = $row;
	}

	return $arr;
}

function add_item_to_cat($title, $author, $pubyear, $price) {
	$sql = "INSERT INTO catalog (title, author, pubyear, price)
				VALUES (?, ?, ?, ?)";
	global $link;

	if (!$stmt = mysqli_prepare($link, $sql)) {
		return false;
	}

	mysqli_stmt_bind_param($stmt, "ssii", $title, $author, $pubyear, $price);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	return true;
}

function select_all_items() {
	$sql = 'SELECT * FROM catalog ORDER BY title';
	global $link;

	if (!$result = mysqli_query($link, $sql)) {
		return null;
	}

	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $items;
}

function search_books($query) {
	global $link;
	$query = clear_str($query);
	$sql = "SELECT * FROM catalog
			WHERE title REGEXP ?
				OR author REGEXP ?
				OR pubyear REGEXP ?
			ORDER BY title";

	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, 'sss', $query, $query, $query);
	if (!mysqli_stmt_execute($stmt)) {
		return null;
	}

	$result = mysqli_stmt_get_result($stmt);
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $items;
}

function count_basket() {
	global $basket;
	$tmp = $basket;
	unset($tmp['order_id']);
	$cnt = 0;
	foreach ($tmp as $item) {
		$cnt += (int) $item;
	}
	return $cnt;
}

function save_basket() {
	global $basket;

	$basket = base64_encode(serialize($basket));
	setcookie('basket', $basket, 0x7FFFFFFF, '/');
}

function basket_init() {
	global $basket, $count;

	if (!isset($_COOKIE['basket'])) {
		$basket = ['order_id' => uniqid()];
		save_basket();
	} else {
		$basket = unserialize(base64_decode($_COOKIE['basket']));
		$count = count_basket();
	}
}

function add_to_basket($id) {
	global $basket;
	if (isset($basket[$id])) {
		$basket[$id]++;
	} else {
		$basket[$id] = 1;
	}

	save_basket();
}

function get_basket() {
	global $link, $basket;

	$goods = array_keys($basket);
	array_shift($goods);
	if (!$goods) {
		return false;
	}

	$ids = implode(", ", $goods);
	$sql = "SELECT * FROM catalog WHERE item_id IN ($ids)";
	if (!$result = mysqli_query($link, $sql)) {
		return false;
	}

	$items = convert_res_to_arr($result);
	mysqli_free_result($result);

	return $items;
}

function del_basket() {
	setcookie('basket', NULL, time() - 3600, '/');
}

function del_item_from_basket($id) {
	global $basket;
	unset($basket[$id]);
	save_basket();
}

function save_order($dateTime) {
	global $link, $basket;
	$goods = get_basket();
	if (!$goods) {
		return false;
	}

	$stmt = mysqli_stmt_init($link);
	$sql = "INSERT INTO orders (
										item_id,
										quantity,
										order_id,
										datetime
									 )
						VALUES (?, ?, ?, ?)";
	mysqli_stmt_prepare($stmt, $sql);
	foreach ($goods as $item) {
		mysqli_stmt_bind_param($stmt, "iisi", $item['item_id'], $item['quantity'], $basket['order_id'], $dateTime);
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);
	del_basket();
	return true;
}

function get_orders() {
	global $link;
	if (!is_file('../log/orders.log')) {
		return false;
	}

	$orders = file('../log/orders.log');
	$all_orders = [];

	foreach ($orders as $order) {
		list($name, $email, $phone, $address, $order_id, $date) = explode("|", $order);

		$orderinfo = [];
		$orderinfo['name']     = $name;
		$orderinfo['email']    = $email;
		$orderinfo['phone']    = $phone;
		$orderinfo['address']  = $address;
		$orderinfo['order_id'] = $order_id;
		$orderinfo['date']     = $date;

		$sql = "SELECT title, author, pubyear, price, quantity
				FROM orders o
				JOIN catalog c ON o.item_id = c.item_id
				WHERE order_id = '$order_id' AND datetime = '$date'";

		if (!$result = mysqli_query($link, $sql)) {
			return false;
		}

		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);

		$orderinfo['goods'] = $items;
		$all_orders[] = $orderinfo;
	}
	return $all_orders;
}

function create_user($username, $email, $phone, $pwd) {
	global $link;
	$username = clear_str($username);
	$email = clear_str(strtolower($email));
	$phone = clear_str($phone);
	$pwd = password_hash($pwd, PASSWORD_BCRYPT);

	$sql = 'INSERT INTO users (username, email, phone, password)
				VALUES (?, ?, ?, ?)';
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $phone, $pwd);
	mysqli_stmt_execute($stmt);
	return mysqli_stmt_insert_id($stmt);
}

function is_username_exist($username) {
	global $link;
	$username = clear_str($username);

	$sql = 'SELECT username
				FROM users
				WHERE username = ?';

	$stmt = mysqli_prepare($link, $sql);
	if (!$stmt)
		return null;

	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);
	if (!mysqli_stmt_fetch($stmt)) {
		return false;
	}

	return true;
}

function is_email_exist($email) {
	global $link;
	$email = clear_str($email);

	$sql = 'SELECT email
				FROM users
				WHERE email = ?';
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	if (!mysqli_stmt_fetch($stmt)) {
		return false;
	}

	return true;
}

function is_phone_exist($phone) {
	global $link;
	$phone = clear_str($phone);

	$sql = 'SELECT phone
				FROM users
				WHERE phone = ?';
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, 's', $phone);
	mysqli_stmt_execute($stmt);
	if (!mysqli_stmt_fetch($stmt)) {
		return false;
	} else {
		return true;
	}
}

function get_user_data($login, $password) {
	global $link;
	$login = clear_str(strtolower($login));

	$sql = 'SELECT *
				FROM users
				WHERE email = ? OR phone = ?';

	$stmt = mysqli_prepare($link, $sql);
	if (!$stmt)
		return null;

	mysqli_stmt_bind_param($stmt, 'ss', $login, $login);
	mysqli_stmt_execute($stmt);

	if (!$result = mysqli_stmt_get_result($stmt)) {
		return false;
	}

	$user = mysqli_fetch_assoc($result);
	if (!password_verify($password, $user['password'])) {
		return false;
	} else {
		unset($user['password']);
		return $user;
	}
}

function is_user_address_exist($address) {
	global $link;
	$sql = "SELECT *
				FROM addresses
				WHERE address = '{$address}'";
	if (!mysqli_query($link, $sql)) {
		return true;
	}

	return false;
}

function add_user_address($user_id, $address) {
	global $link;
	$address = clear_str($address);

	if (is_user_address_exist($address)) {
		return;
	}

	$sql = 'INSERT INTO addresses (user_id, address)
				VALUES (?, ?)';
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, 'is', $user_id, $address);
	mysqli_stmt_execute($stmt);
}

function get_user_addresses($user_id) {
	global $link;

	$sql = "SELECT address
				FROM addresses
				WHERE user_id = {$user_id}";
	$result = mysqli_query($link, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_item($item_id) {
	global $link;

	$sql = "SELECT * FROM catalog
			WHERE item_id = {$item_id}";
	$result = mysqli_query($link, $sql);
	$item = mysqli_fetch_assoc($result);
	return $item;
}

function update_item($item_id, $title, $author, $pubyear, $price) {
	global $link;

	$sql = "UPDATE catalog
			SET title = '" . $title . "',
				author = '" . $author . "',
				pubyear = '" . $pubyear . "',
				price = '" . $price . "'
			WHERE item_id = '" . $item_id . "'";
	if (!mysqli_query($link, $sql))
		return false;
	else
		return true;
}
