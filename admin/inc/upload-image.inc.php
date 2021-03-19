<?php
if (!isset($item_id))
    $item_id = mysqli_insert_id($link);

if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    $upload_dir  = '../../eshop/images/';
    $upload_file = $upload_dir . $item_id . '.jpg';
    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file))
        $_SESSION['msg'] = 'Ошибка с загрузкой обложки';
}
