<?php
$dt = time();

if (isset($_SERVER['HTTP_REFERER'])) {
	$page = $_GET['id'] ?? "index";
	$ref  = pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_BASENAME);
	$path = $dt . "|" . $ref . "|" . $page . "\n";

	if (is_dir('log'))
		file_put_contents(PATH_LOG, $path, FILE_APPEND);
}
