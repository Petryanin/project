<?php
switch ($id) {
    case 'index':
        include 'inc/index.inc.php';
        break;
    case 'catalog':
        include '../templates/catalog.php';
        break;
    case 'edit-item':
        include 'inc/edit-item.inc.php';
        break;
    case 'add-item':
        include 'inc/add-item.inc.php';
        break;
}
