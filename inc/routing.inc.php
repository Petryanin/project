<?php
switch ($id) {
	case 'about':
		include 'inc/about.inc.php';
		break;
	case 'blog':
		include 'inc/blog.inc.php';
		break;
	case 'log':
		include 'inc/view-log.inc.php';
		break;
	case 'gbook':
		include 'inc/gbook.inc.php';
		break;
	case 'eshop':
		include 'templates/catalog.php';
		break;
	case 'basket':
		include 'inc/basket.inc.php';
		break;
	case 'orderform':
		include 'inc/orderform.inc.php';
		break;
	case 'saveorder':
		include 'inc/saveorder.inc.php';
		break;
	default:
		include 'inc/index.inc.php';
}
