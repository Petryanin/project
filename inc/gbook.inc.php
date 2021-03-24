<style>
	img {
		margin-right: 10px;
	}

	.card {
		/* border: none;
		box-shadow: 5px 6px 6px 2px #e9ecef; */
		border-radius: 4px;
	}

	.dots {
		height: 4px;
		width: 4px;
		margin-bottom: 2px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block
	}

	.badge {
		padding: 7px;
		padding-right: 9px;
		padding-left: 16px;
		box-shadow: 5px 6px 6px 2px #e9ecef
	}

	.user-img {
		margin-top: 4px
	}

	.check-icon {
		font-size: 17px;
		color: #c3bfbf;
		top: 1px;
		position: relative;
		margin-left: 3px
	}

	.form-check-input {
		margin-top: 6px;
		margin-left: -24px !important;
		cursor: pointer
	}

	.form-check-input:focus {
		box-shadow: none
	}

	.icons i {
		margin-left: 8px
	}

	.reply {
		margin-left: 12px
	}

	.reply small {
		color: #b7b4b4
	}

	.reply small:hover {
		color: green;
		cursor: pointer
	}
</style>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' and !empty($_POST['msg']))
	save_comment_to_db();
if (isset($_GET['del']))
	del_comment_from_db();

if (!isset($_SESSION['user'])) :
?>
	<h4 class="mt-3">Оставлять сообщения могут только зарегистрированные пользователи.</h4>
	<h4><a href="signup/login.php" class="text-decoration-none">Войдите</a> или <a href="signup/register.php" class="text-decoration-none">зарегистрируйтесь</a></h4>
<?php
else :
?>
	<h4 class="mt-3">Оставьте своё сообщение</h4>
	<form class="form-group mt-3" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
		<div class="form-group">
			<label class="mb-2" for="exampleFormControlTextarea1">Текст сообщения</label>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="100" name="msg" placeholder="Максимальная длина сообщения 100 символов"></textarea><br>
			<button type="submit" class="btn btn-primary">Отправить</button>
		</div>
	</form>
<?php
endif;

$output = output_comments();
if (!$output) :
?>
	<h4 class="mt-3">Упс...</h4>
	<h4 class="mt-3">Что-то пошло не так, обратитесь к администратору</h4>
<?php
	exit;
endif;

$cnt = array_key_last($output) + 1;
?>
<p class="mt-5">Всего сообщений: <?= $cnt ?></p>
<div class="container-fluid">
	<div class="row d-flex justify-content-center">
		<?php
		foreach ($output as $user) :
			$user['dt']  = date('d-m-Y H:i:s', (int)$user['dt']);
			$user['msg'] = nl2br($user['msg']);
		?>
			<div class="card p-3 mb-2">
				<div class="d-flex justify-content-between align-items-center">
					<div class="user d-flex flex-row align-items-center">
						<img src="assets/user_icon.png" width="30" class="user-img rounded-circle mr-2">
						<span>
							<span class="font-weight-bold text-primary"><a href="mailto:<?= $user['email'] ?>" class="text-decoration-none"><?= $user['username'] ?></a></span>
							<?= $user['msg'] ?>
						</span>
					</div>
					<small><?= $user['dt'] ?></small>
				</div>
				<?php
				if (isset($_SESSION['user']) and $_SESSION['user']['user_id'] == $user['user_id']) :
				?>
					<div class="action d-flex justify-content-between mt-2 align-items-center">
						<small><a href="<?= $_SERVER['REQUEST_URI'] ?>&del=<?= $user['msg_id'] ?> class=" text-decoration-none" ">Удалить</a></small>
							</div>
				<?php
				endif;
				?>
				</div>
		<?php
		endforeach;
		?>    	
	</div>
</div>