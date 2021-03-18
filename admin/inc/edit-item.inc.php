<?php
require_once 'inc/lib.inc.php';

if (isset($_GET['item']))
    $item_id = clear_str($_GET['item']);
$item = get_item($item_id);
?>

<h3 class="mb-3">
    <a href="index.php?id=catalog" class="text-decoration-none">Вернуться</a>
</h3>
<form enctype="multipart/form-data" action="inc/save-changes.inc.php" method="get">

    Обложка:</br>
    <img src="../eshop/images/<?= $item['item_id'] ?>.jpg" class="mb-2" style="width: 100px"></br>
    <input type="hidden" name="MAX_FILE_SIZE" value="2000" />

    <span>Загрузить новую:</span>
    <input class="mb-3" type="file" name="<?= $item['item_id'] ?>" id=""></br>
    
    <span>Название:</span>
    <input class="form-control mb-3" type="text" value="<?= $item['title'] ?>">

    <span>Автор:</span>
    <input class="form-control mb-3" type="text" value="<?= $item['author'] ?>">
    
    <span>Дата публикации:</span>
    <input class="form-control mb-3" type="text" value="<?= $item['pubyear'] ?>">

    <span>Цена:</span>
    <input class="form-control mb-3" type="text" value="<?= $item['price'] ?>">

    <button type="submit" class="btn btn-success mb-3">Сохранить</button>
    
</form>