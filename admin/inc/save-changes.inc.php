<?php
session_start();
require_once '../../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title   = clear_str($_POST['title']); 
    $author  = clear_str($_POST['author']);
    $pubyear = clear_str($_POST['pubyear']);
    $price   = clear_str($_POST['price']);

    if (!$title or !$author or !$pubyear or !$price) {
        $_SESSION['msg'] = 'Необходимо заполнить все обязательные поля!';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if (!isset($_POST['item_id'])) {
        if (!add_item_to_cat($title, $author, $pubyear, $price)) {
            $_SESSION['msg'] = 'Ошибка с добавлением товара';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            require 'upload-image.inc.php';
            $_SESSION['msg'] = 'Товар успешно добавлен в каталог';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }   
    }
    
    $item_id = $_POST['item_id'];

    require 'upload-image.inc.php';

    if (!update_item($item_id, $title, $author, $pubyear, $price))
        $_SESSION['msg'] = mysqli_error($link);
    else 
        $_SESSION['msg'] = 'Данные сохранены';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}