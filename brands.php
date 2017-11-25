<?php
$base_dir = "img/Marken/";
$brand_dirs = scandir($base_dir, 1);

echo '<ul class="list-group">';

foreach ($brand_dirs as $key => $dir) {
	$pathToBrand = $base_dir . $dir;
	$brandName = $dir;
	if (is_dir($pathToBrand) && ($dir != ".." && $dir != ".")) {
		if (($pathToImg = glob($pathToBrand . "/logo.*"))) {
			generateLogoHtml($pathToImg[0], $pathToBrand, $brandName, $key);
			generatePhotoGrid($pathToBrand);
			generateInfoBox($pathToBrand, $brandName);
		}
	}
}

echo '</ul>';

function generateLogoHtml($logoUrl, $pathToBrand, $brandName, $key) {
	echo '<li class="list-item">';
	echo '<div class="card mb-3">';
	echo '<img src="' . $logoUrl . '" class="card-img-top">';
	generateXsInfoBox($pathToBrand, $brandName, $key);
	echo '</div>';
	echo '</li>';
}

function generatePhotoGrid($path) {
	echo '<div class="pictures">';
	for ($i=0; $i < 3; $i++) { 
		$rowImgUrls = detectRowImages($i, $path);
		$urlSize = count($rowImgUrls);
		echo '<div class="row">';
		if ($rowImgUrls)
			foreach ($rowImgUrls as $key => $img) {
				$columnSize = 12 / $urlSize;
				echo '<div class="col-' . $columnSize . '">';
				echo '<img class="img-responsive" src="' . $img . '">';
				echo '</div>';
			}
		echo '</div>';
	}
	echo '</div>';
}

function generateInfoBox($path, $brandName) {
	echo '<div class="info">';
	echo '<div class="card text-center">';
	echo '<h3 class="card-header">' . $brandName . '</h3>';
	echo '<div class="card-block">';
	echo '<p class="card-text">';
	echo file_get_contents($path . "/text.txt");
	echo '</p>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}

function generateXsInfoBox($path, $brandName, $key) {
	echo '<div class="card-text d-sm-none"><a href="#accordion' . $key . '" data-toggle="collapse"
		  aria-expanded="false" aria-controls="accordion' . $key . '"><i class="material-icons">expand_more</i></a></div>';
	echo '<div id="accordion' . $key . '" class="collapse d-sm-none" role="tabpanel">';
	echo '<h3 class="card-header">' . $brandName . '</h3>';
	echo '<div class="card-block">';
	echo '<p class="card-text">';
	echo file_get_contents($path . "/text.txt");
	echo '</p>';
	echo '</div>';
	echo '</div>';
}

function detectRowImages($row, $path) {
	$top = "/{t,t[lr]}.*";
	$middle = "/{m,m[lr]}.*";
	$bottum = "/{b,b[lr]}.*";
	switch ($row) {
		case 0:
			return glob($path . $top, GLOB_BRACE);
			break;

		case 1:
			return glob($path . $middle, GLOB_BRACE);
			break;

		case 2:
			return glob($path . $bottum, GLOB_BRACE);
			break;
		
		default:
			break;
	}
}

?>