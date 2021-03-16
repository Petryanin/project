<?php
if (is_file(PATH_LOG)) {
	$file = file(PATH_LOG);

	echo "<ol class='mt-3'>";

	foreach ($file as $line) {
		echo "<li>";

		list($dt, $ref, $page) = explode("|", $line);
		$dt = date('d-m-Y H:i:s', (int)$dt);
		preg_match('/id=([^&]*)/', $ref, $matches);

		if (!isset($matches[1]))
			$ref = basename($ref, ".php");
		else
			$ref = $matches[1];

		echo  $dt . " - " . $ref . " -> " . $page;

		echo "</li>";
	}
	echo "</ol>";
}
