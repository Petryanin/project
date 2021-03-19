<?php
require '../functions.php';

if (!$orders = get_orders()) :
?>
    <h3 class="mt-3">Тут ничего нет...</h3>
<?php
    exit;
endif;

foreach ($orders as $order) :
    $num = 0;
    $sum = 0;
?>
    <div class="mb-5">
        <hr>
        <h3 class="mt-5 mb-4">Заказ номер <?= $order['order_id'] ?></h3>
        <p>
            <span style="font-weight: bold">Имя пользователя:</span>
            <?= $order['name'] ?>
        </p>

        <p>
            <span style="font-weight: bold">Адрес электронной почты:</span>
            <?= $order['email'] ?>
        </p>
        <p>
            <span style="font-weight: bold">Адрес доставки:</span>
            <?= $order['address'] ?>
        </p>
        <p>
            <span style="font-weight: bold">Дата оформления заказа:</span>
            <?= date('H:i:s d-m-Y', $order['date']) ?>
        </p>

        <table class="table">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Дата публикации</th>
                    <th scope="col">Цена, руб</th>
                    <th scope="col">Количество</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($order['goods'] as $item) :
                ?>
                    <tr>
                        <th scope="row"><?= ++$num ?></th>
                        <td><?= $item['title'] ?></td>
                        <td><?= $item['author'] ?></td>
                        <td><?= $item['pubyear'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                    </tr>
                <?php
                    $sum += $item['price'] * $item['quantity'];
                endforeach;
                ?>
            </tbody>

        </table>

        <p>
            <span style="font-weight: bold">Итого товаров на сумму:</span>
            <?= $sum ?> руб
        </p>
    </div>
<?php
endforeach;
?>