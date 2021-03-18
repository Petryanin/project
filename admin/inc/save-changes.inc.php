<?php
session_start();
require '../../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_FILES['userfile']) and is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        $upload_dir  = '../../eshop/images';
        $upload_file = $upload_dir . basename($_FILES['userfile']['name']);
        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file))
            $_SESSION['msg'] = 'Ошибка с загрузкой обложки';
    }

    $item_id = $_POST['item_id'];
    $title   = clear_str($_POST['title']); 
    $author  = clear_str($_POST['author']);
    $pubyear = clear_str($_POST['pubyear']);
    $price   = clear_str($_POST['price']);

    if (!update_item($item_id, $title, $author, $pubyear, $price))
        $_SESSION['msg'] = mysqli_error($link);
    else 
        $_SESSION['msg'] = 'Данные сохранены';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}