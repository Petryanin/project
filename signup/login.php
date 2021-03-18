<?php
session_start();

if (!isset($_SESSION['ref']))
    $_SESSION['ref'] = $_SERVER['HTTP_REFERER'];

if (basename($_SERVER['HTTP_REFERER']) == 'register.php' and isset($_SESSION['userdata']))
    unset($_SESSION['userdata']);

if (isset($_SESSION['userdata']))
    $login = $_SESSION['userdata'];
else $login = '';

?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Авторизация
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="inc/loginstyle.css" />
</head>

<body>
    <form class="form" action="inc/signin.inc.php" method="POST">

        <h1 class="form__title">Вход</h1>
        <?php
        if (isset($_SESSION['signup_success']) and $_SESSION['signup_success']) :
        ?>
            <h4 class="signup__success">Регистрация прошла успешно!</h4>
        <?php
        else :
        ?>
            <h4 class="form__title">Нет аккаунта? <a href="register.php">Зарегистрироваться!</a></h4>
        <?php
        endif;
        ?>
        <div class="form__group">
            <label class="form__label">Email или телефон</label>
            <input class="form__input" type="text" name="login" value="<?= $login ?>">
        </div>

        <div class="form__group">
            <label class="form__label">Пароль</label>
            <input class="form__input" type="password" name="password">
        </div>

        <button class="form__button" type="submit">Войти</button>

    </form>


    <?php
    if (isset($_SESSION['error'])) :
    ?>
        <div class="error_msg">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php
    endif;
    ?>
</body>

</html>