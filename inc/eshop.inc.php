<?php
	require_once 'lib.inc.php';
	require_once 'eshop-config.inc.php';

	if ($_SERVER['REQUEST_METHOD'] == 'GET' and !empty($_GET['search'])) {
		$result = 'search_books';
		$query = $_GET['search'];
	} else {
		$result = 'select_all_items';
		$query = '';
	}
?>

<form class="input-group" method="GET">
	<input type="hidden" name="id" value="eshop">
	<input type="text" maxlength="50" style="padding-right: 54px" class="form-control find rounded shadow-none mt-3 mb-3" placeholder="Поиск (название, автор, год издания)" name="search" value="<?= $query ?>" />
	<button class="btn btn-primary input-group-text rounded-right position-absolute mt-3 mb-3" style="z-index: 100; right: 0; height: 38px" type="submit">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
			<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
		</svg>
	</button>
</form>

<p>Товаров в <a href="index.php?id=basket" class="text-decoration-none">корзине</a>: <?= $count ?></p>
<?php
	$goods = $result($query);
	if ($result == 'search_books') :
?>
		<p>Результатов поиска: <?= count($goods) ?></p>
<?php
	endif;
?>

<table class="table">

	<thead>
		<tr>
			<th style="width: 15%">Обложка</th>
			<th>Название</th>
			<th>Автор</th>
			<th>Год издания</th>
			<th>Цена, руб.</th>
			<th></th>
		</tr>
	</thead>

	<?php
		foreach ($goods as $item) :
			if (!$item['image'])
				$item['image'] = 'Изображение отсутствует';
			else
				$item['image'] = "<img style='width: 60%' src='{$item['image']}'>";
	?>
			<tr>
				<td><?= $item['image'] ?></td>
				<td valign="middle"><?= $item['title'] ?></td>
				<td valign="middle"><?= $item['author'] ?></td>
				<td valign="middle"><?= $item['pubyear'] ?></td>
				<td valign="middle"><?= $item['price'] ?></td>
				<th valign="middle"><a class="btn btn-outline-primary p-2" href="inc/add-to-basket.inc.php?id=<?= $item['item_id'] ?>" role="button">В корзину</a></th>
			</tr>
	<?php
		endforeach;
	?>
	
</table>