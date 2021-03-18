<?php
session_start();
define('PATH_LOG', 'log/path.log');
include 'inc/log.inc.php';
include 'inc/headers.inc.php';
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">

	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
			<div class="container-fluid">
				<span class="navbar-brand">PROJECT ONE</span>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav me-auto mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'index' || !isset($_GET['id']) ? 'active' : '' ?>" aria-current="page" href="index.php?id=index">
								Домой
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'blog' ? 'active' : '' ?>" href="index.php?id=blog">
								Блог
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'about' ? 'active' : '' ?>" href="index.php?id=about">
								О нас
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'log' ? 'active' : '' ?>" href="index.php?id=log">
								Журнал просмотров
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'gbook' ? 'active' : '' ?>" href="index.php?id=gbook">
								Чат
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'eshop' ? 'active' : '' ?>" href="index.php?id=eshop">
								Магазин
							</a>
						</li>
					</ul>

					<?php
					if (!isset($_SESSION['user']) or !$_SESSION['user']) {
						$username = 'Гость';
						$action = 'Войти';
						$btn_option = 'btn-primary';
						$path = 'signup/login.php';
					} else {
						$username = $_SESSION['user']['username'];
						$action = 'Выйти';
						$btn_option = 'btn-danger';
						$path = 'signup/logout.php';
					}
					?>

					<div class="navbar-brand">Вы зашли как <?= $username ?></div>
					<a class="btn <?= $btn_option ?>" href="<?= $path ?>"><?= $action ?></a>
				</div>
			</div>
		</nav>
	</header>

	<main class="flex-shrink-0 mt-3">
		<div class="container">
			<?php
			require 'inc/routing.inc.php';
			?>
		</div>
	</main>

	<footer class="footer mt-auto py-2 bg-light ">
		<div class="container d-flex justify-content-between">
			<span class="btn text-muted">Веб-приложение Алексея Петрянина</span>
			<?php
			if (isset($_SESSION['user']) and $_SESSION['user']['admin'] === 1) :
			?>
				<a href="admin/index.php" class="btn btn-outline-secondary">Администрирование</a>
			<?php
			endif;
			?>
		</div>
	</footer>

</body>

</html>