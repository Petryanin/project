<?php
session_start();
require '../../inc/lib.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username    = $_POST['username'];
	$email       = $_POST['email'];
	$phone       = $_POST['phone'];
	$address     = $_POST['address'];
	$pwd         = $_POST['password'];
	$pwd_confirm = $_POST['password_confirm'];
	$_SESSION['userdata'] = [
		'username' => $username,
		'email' => $email,
		'phone' => $phone,
		'address' => $address
	];

	//ERRORS
	if (!$username or !$email or !$phone or !$pwd or !$pwd_confirm) {
		$_SESSION['error'] = 'необходимо заполнить все обязательные поля';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if (is_username_exist($username)) {
		$_SESSION['error'] = 'пользователь с таким именем уже существует';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if (is_email_exist($email)) {
		$_SESSION['error'] = 'данный адрес электронной почты уже зарегистрирован';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if (is_phone_exist($phone)) {
		$_SESSION['error'] = 'данный телефон уже зарегистрирован';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if ($pwd !== $pwd_confirm) {
		$_SESSION['error'] = 'пароли не совпадают';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	//NO ERRORS
	$user_id = create_user($username, $email, $phone, $pwd);
	if (!empty($address))
		add_user_address($user_id, $address);
	unset($_SESSION['userdata']);
	$_SESSION['signup_success'] = true;
	header('Location: ../login.php');
	exit;
}
