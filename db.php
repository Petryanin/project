<?php
define('DB_HOST', 'mysql');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', 'secret');
define('DB_NAME', 'project');

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()) {
	$err = mysqli_connect_error();
	echo "Ошибка подключения к базе данных: {$err}";
	exit;
}
