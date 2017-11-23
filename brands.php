<?php
$base_dir = "img/Marken/";
$brand_dirs = scandir($base_dir, 1);

echo '<ul class="list-group">';

foreach ($brand_dirs as $key => $dir) {
	$pathToBrand = $base_dir . $dir;
	if (is_dir($pathToBrand) && ($dir != ".." && $dir != ".")) {
		if (($pathToImg = glob($pathToBrand . "/logo.*")))
			generateLogoHtml($pathToImg[0]);
	}
}

echo '</ul>';

function generateLogoHtml($logoUrl) {
	echo '<li class="list-group-item">';
	echo '<img src="' . $logoUrl . '" class="img-responsive">';
	echo '</li>';
}
?>