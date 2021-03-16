<?php
require 'lib.inc.php';

if (isset($_SESSION['error'])) :
?>

    <div class="alert alert-warning" role="alert">
        <?= $_SESSION['error'] ?>
    </div>

<?php
    unset($_SESSION['error']);
endif;
?>

<h1 class="mt-1">Оформление заказа</h1>

<?php
if (!isset($_SESSION['user'])) :
?>
    <h4>Чтобы оформить заказ <a href="signup/login.php" class="text-decoration-none">войдите</a> или <a href="signup/register.php" class="text-decoration-none">зарегистрируйтесь</a></h4>
    
<?php
else :
?>
    <form action="inc/saveorder-config.inc.php" method="post">

        <legend>Выберите адрес доставки</legend>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="options" value="use_existing_adr" checked>
                Использовать один из ваших сохраненных адресов
            </label>
            <?php
            if (!$arr = get_user_addresses($_SESSION['user']['user_id'])) :
            ?>
                <br><br><span>У вас нет сохранненых адресов</span>
            <?php
            else :
            ?>
                <div class="form-group mt-3">
                    <label for="exampleSelect1">Выберите адрес</label>
                    <select class="form-control" name='address'>
                        <?php
                        foreach ($arr as $another) :
                        ?>
                            <option><?= $another['address'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            <?php
            endif;
            ?>
        </div>

        <div class="form-check mt-5">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="options" value="use_new_adr">
                Указать новый адрес
            </label>
            <div class="form-group mt-3">
                <input class="form-control" type="text" rows="1" name="new-address">
            </div>
        </div>

        <button class="mt-5 btn btn-primary" type="submit">Оформить заказ</button>

    </form>
<?php
endif;
?>