<?php
include 'inc/alert.inc.php';
?>

<form class="mt-3" enctype="multipart/form-data" action="inc/save-changes.inc.php" method="post">

    <span>Обложка (необязательно):</span>
    <input class="form-control" type="file" name="userfile"></br>
    
    <span>Название:</span>
    <input class="form-control mb-3" type="text" name="title">

    <span>Автор:</span>
    <input class="form-control mb-3" type="text" name="author">
    
    <span>Дата публикации:</span>
    <input class="form-control mb-3" type="text"  name="pubyear">

    <span>Цена:</span>
    <input class="form-control mb-3" type="text" name="price">

    <button type="submit" class="btn btn-success mb-3">Добавить</button>

</form>