<?php
    session_start();
    require '../../inc/lib.inc.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['login'];
        $pwd   = $_POST['password'];
        $_SESSION['userdata'] = $login;

        //ERRORS
        if (!$login or !$pwd) {
            $_SESSION['error'] = 'необходимо заполнить все поля';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (!$_SESSION['user'] = get_user_data($login, $pwd)) {
            $_SESSION['error'] = 'неверно введен логин или пароль';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
			unset($_SESSION['userdata']);
            $ref = $_SESSION['ref'];
            unset($_SESSION['ref']);
            header('Location: ' . $ref);
            exit;
        }
        
    }