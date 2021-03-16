<?php
header('Refresh: 5; url = index.php?id=eshop');
if (isset($_SESSION['saveorder_success'])) :
?>

    <h3 class="mt-3">Ваш заказ принят.</h3>
    <h3 class="mt-3">Возвращаем вас в <a href="index.php?id=eshop" class="text-decoration-none">каталог товаров</a>...</h3>

<?php
    unset($_SESSION['saveorder_success']);
else :
?>

    <h3 class="mt-3">Упс...</h3>
    <h4 class="mt-3">Что-то пошло не так! Перенаправляем вас в <a href="index.php?id=eshop" class="text-decoration-none">каталог товаров</a>...</h4>

<?php
endif;
