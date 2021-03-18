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
}
