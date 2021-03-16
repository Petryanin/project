<?php
    session_start();
    require_once 'lib.inc.php';
	require_once 'eshop-config.inc.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name  = $_SESSION['user']['username'];
        $email = $_SESSION['user']['email'];
        $phone = $_SESSION['user']['phone'];
        
		if ($_POST['options'] == 'use_existing_adr' and isset($_POST['address'])) {
            $address = $_POST['address'];
        } elseif ($_POST['options'] == 'use_new_adr' and isset($_POST['new-address'])) {
            $address = $_POST['new-address'];
            add_user_address($_SESSION['user']['user_id'], $address);
        } else {
            $_SESSION['error'] = 'Укажите адрес';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

		$id      = $basket['order_id'];
		$dt      = time();
		$order   = "{$name}|{$email}|{$phone}|{$address}|{$id}|{$dt}\n";
		file_put_contents('../log/orders.log', $order, FILE_APPEND);

		if (!save_order($dt)) {
            $_SESSION['error'] = 'Произошла ошибка с сохранением заказа';
            header('Loaction: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
	}
    $_SESSION['saveorder_success'] = true;
    header('Location: ../index.php?id=saveorder');
    exit;