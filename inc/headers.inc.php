<?php
if (isset($_GET['id']))
	$id_get = $_GET['id'];
else $id_get = "";

$id = strtolower(strip_tags(trim($id_get)));

switch ($id) {
	case 'about':
		$title = 'Информация';
		break;
	case 'blog':
		$title = 'Блог';
		break;
	case 'log':
		$title = 'Журнал посещений';
		break;
	case 'gbook':
		$title = 'Чат';
		break;
	case 'eshop':
		$title = 'Магазин';
		break;
	case 'basket':
		$title = 'Корзина';
		break;
	case 'orderform':
		$title = 'Оформление заказа';
		break;
	case 'saveorder':
		$title = 'Оформление заказа';
		break;
	default:
		$title = 'Добро пожаловать!';
}
