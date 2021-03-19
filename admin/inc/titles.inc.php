<?php
if (isset($_GET['id']))
    $id = trim(strip_tags($_GET['id']));
else 
    $id = 'index';

switch ($id) {
    case 'index':
        $title = 'Администрирование';
        break;
    case 'catalog':
        $title = 'Каталог';
        break;
    case 'edit-item':
        $title = 'Редактировать';
        break;
    case 'add-item':
        $title = 'Добавить товар';
        break;
}    