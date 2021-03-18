<?php
require_once '../functions.php';
require_once 'eshop-config.inc.php';

if (isset($_GET['id'])) {
	$id = clear_int($_GET['id']);
	del_item_from_basket($id);

	header("Location: " . $_SERVER['HTTP_REFERER']);
	exit;
}
