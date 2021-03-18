<?php
require '../functions.php';

if (isset($_GET['item']))
    $item_id = clear_str($_GET['item']);
$item = get_item($item_id);
?>

<h3 class="mb-3">
    <a href="index.php?id=catalog" class="btn btn-outline-primary">Вернуться</a>
</h3>

<?php
if (isset($_SESSION['msg'])):
?>
    <div class="alert alert-warning" role="alert">
        <?= $_SESSION['msg'] ?>
    </div>

<?php
    unset($_SESSION['msg']);
endif;
?>
<form enctype="multipart/form-data" action="inc/save-changes.inc.php" method="post">
    
    <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>" />

    Обложка:</br>
    <img src="../eshop/images/<?= $item['item_id'] ?>.jpg" class="mb-2" style="width: 100px"></br>

    <span>Загрузить новую:</span>
    <input type="hidden" name="MAX_FILE_SIZE" value="2000" />
    <input class="mb-3" type="file" name="<?= $item['item_id'] ?>.jpg"></br>
    
    <span>Название:</span>
    <input class="form-control mb-3" type="text" name="title" value="<?= $item['title'] ?>">

    <span>Автор:</span>
    <input class="form-control mb-3" type="text" name="author" value="<?= $item['author'] ?>">
    
    <span>Дата публикации:</span>
    <input class="form-control mb-3" type="text"  name="pubyear" value="<?= $item['pubyear'] ?>">

    <span>Цена:</span>
    <input class="form-control mb-3" type="text" name="price" value="<?= $item['price'] ?>">

    <button type="submit" class="btn btn-success mb-3">Сохранить</button>

</form>