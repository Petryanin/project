<?php
session_start();

require_once '../functions.php';
require_once 'inc/titles.inc.php';

?>
<!doctype html>
<html lang="en" class="h-100">

<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">

	<ul class="mt-5 list-unstyled">
		<li>
				</li>
	</ul>

	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
			<div class="container-fluid">
				<span class="navbar-brand">PROJECT ONE admin</span>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav me-auto mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'index' || !isset($_GET['id']) ? 'active' : '' ?>" aria-current="page" href="index.php?id=index">
								Домой
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'catalog' ? 'active' : '' ?>" aria-current="page" href="index.php?id=catalog">
								Каталог
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'add-item' ? 'active' : '' ?>" aria-current="page" href="index.php?id=add-item">
								Добавить товар
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'orders' ? 'active' : '' ?>" aria-current="page" href="index.php?id=orders">
								Заказы
							</a>
						</li>
					</ul>
					<a class="btn btn-outline-light" href="../index.php">Выйти из режима администрирования</a>
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
		</div>
	</footer>

</body>

</html>