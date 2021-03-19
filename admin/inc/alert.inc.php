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