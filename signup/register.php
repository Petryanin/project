<?php
	session_start();
	
	if (!isset($_SESSION['ref']))
		$_SESSION['ref'] = $_SERVER['HTTP_REFERER']; //REF PAGE

	if (isset($_SESSION['userdata']['username']))
		$username = $_SESSION['userdata']['username'];
	else $username = '';
	if (isset($_SESSION['userdata']['email']))
		$email = $_SESSION['userdata']['email'];
	else $email = '';
	if (isset($_SESSION['userdata']['phone']))
		$phone = $_SESSION['userdata']['phone'];
	else $phone = '';
	if (isset($_SESSION['userdata']['address']))
		$address = $_SESSION['userdata']['address'];
	else $address = '';

	$_SESSION['signup_success'] = false;
?>
<!DOCTYPE html>
<html>

<head>
	<title>Авторизация</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="inc/loginstyle.css" />
</head>
  
<body>
	<form class="form" action="inc/signup.inc.php" method="POST">

		<h1 class="form__title">Новый аккаунт</h1>
		<h4 class="form__title">Есть аккаунт? <a href="login.php">Войти!</a></h4>

		<div class="form__group">
			<label class="form__label">Имя пользователя</label>
			<input class="form__input" type="text" name="username" value="<?=$username?>">
		</div>

		<div class="form__group">
			<label class="form__label">Email</label>
			<input class="form__input" type="email" name="email" value="<?=$email?>">
		</div>

		<div class="form__group">
			<label class="form__label">Телефон</label>
			<input class="form__input" type="text" name="phone" value="<?=$phone?>">
		</div>

		<div class="form__group">
			<label class="form__label">Адрес (опционально)</label>
			<input class="form__input" type="text" name="address" value="<?=$address?>">
		</div>

		<div class="form__group">
			<label class="form__label">Пароль</label>
			<input class="form__input" type="password" name="password">
		</div>

		<div class="form__group">
			<label class="form__label">Повторите пароль</label>
			<input class="form__input" type="password" name="password_confirm">
		</div>

		<button class="form__button" type="submit">Зарегистрироваться</button>

	</form>
  
  
	<?php
		if (isset($_SESSION['error'])):
	?>
    <div class="error_msg">
		<?php
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		?>
    </div> 
	<?php
		endif;
	?>
</body>

</html>