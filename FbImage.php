<?php
require 'exceptions/orientationexception.php';
require 'exceptions/imageurlexception.php';
class FbImage {
	private $imageUrl;
	private $orientation;
	private const IMGURL_PATTERN = '#https://scontent.xx.fbcdn.net/.*?\.jpg.*#';

	public function __construct($imageUrl, $orientation) {
			
		setOrientation($orientation);
		setImageUrl($imageUrl);
	}

	public function setImageUrl($imageUrl) {
		if (preg_match(self::IMGURL_PATTERN, $imageUrl) == 0)
			throw new ImageUrlException("Not a valid facebook image url: " . $imageUrl);
		$this->imageUrl = $imageUrl;
	}

	public function setOrientation($orientation) {
		if ($orientation != 'p' || $orientation != 'l')
			throw new OrientationException("Wrong orientation type for value "  . $orientation . 
				". Only l=landscape and p=portrait are allowed");
		$this->orientation = $orientation;
	}

	public function getOrientation() {
		return $this->orientation;
	}

	public function getImageUrl() {
		return $this->imageUrl;
	}
}
?>