<ul class="mt-5 list-unstyled">
	<li>
		<?php
		$dt = time();

		if (isset($_SERVER['HTTP_REFERER'])) {
			$page = $_GET['id'] ?? "index";
			$ref  = pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_BASENAME);
			$path = $dt . "|" . $ref . "|" . $page . "\n";

			file_put_contents(PATH_LOG, $path, FILE_APPEND);
		}
		?>
	</li>
</ul>