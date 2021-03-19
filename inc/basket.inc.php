<?php
require_once 'functions.php';
require_once 'eshop-config.inc.php';
?>

<h1 class="mt-5 mb-3">Ваша корзина</h1>

<?php
if (!$count) :
?>

	<h4 class="mt-3">В вашей корзине пока ничего нет</h4>
	<h4 class="mt-3">Вернуться в <a href="index.php?id=eshop" class="text-decoration-none">каталог</h4>

<?php
	exit;
endif;
?>

<h4 class="mt-3">Вернуться в <a href="index.php?id=eshop" class="text-decoration-none">каталог</a></h4>

<?php
$arr = get_basket();
$i = 1;
$sum = 0;
?>

<table class="table mt-4 mb-4">
	<tr>
		<th>N п/п</th>
		<th>Название</th>
		<th>Автор</th>
		<th>Год издания</th>
		<th>Цена, руб.</th>
		<th>Количество</th>
		<th></th>
	</tr>
	<?php
	foreach ($arr as $item) :
	?>
		<tr>
			<td valign="middle"><?= $i++ ?></td>
			<td valign="middle"><?= $item['title'] ?></td>
			<td valign="middle"><?= $item['author'] ?></td>
			<td valign="middle"><?= $item['pubyear'] ?></td>
			<td valign="middle"><?= $item['price'] ?></td>
			<td valign="middle"><?= $item['quantity'] ?></td>
			<td valign="middle"><a href="inc/delete-from-basket.inc.php?id=<?= $item['item_id'] ?>" class="btn btn-outline-primary btn-sm">Удалить</a></td>
		</tr>
	<?php
		$sum += $item['price'] * $item['quantity'];
	endforeach;
	?>
</table>

<p>Всего товаров в корзине на сумму: <?= $sum ?> руб.</p>

<div align="center">
	<button type="button" class="btn btn-success" onClick="location.href='index.php?id=orderform'">
		Оформить заказ!
	</button>
</div>