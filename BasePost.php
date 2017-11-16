<?php
class BasePost {
	private $postId;
	private $type;
	private $message;
	private $story;
	private $imageUrls;
	private $createdTime;

	public function __construct ($postId, $type, $message, $story, $imageUrls, $createdTime) {
		$this->postId = $postId;
		$this->type = $type;
		$this->message = $message;
		$this->story = $story;
		$this->imageUrls = $imageUrls;
		$this->createdTime = $createdTime;
	}

	public function getPostId() {
		return $this->postId;
	}

	public function getType() {
		return $this->type;
	}

	public function getMessage() {
		return $this->message;
	}

	public function getStory() {
		return $this->story;
	}

	public function getImageUrls() {
		return $this->imageUrls;
	}

	public function getCreatedTime() {
		return $this->createdTime;
	}

	public function setPostId($postId) {
		$this->postId = $postId;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function setStory($story) {
		$this->story = $story;
	}

	public function setImageUrls($imageUrls) {
		$this->imageUrls = $imageUrls;
	}

	public function setCreatedTime($createdTime) {
		$this->createdTime = $createdTime;
	}

	public function toHtml(){
		echo '<div class="tl-circ"></div>';
    	echo '<div class="timeline-panel">';
    	echo '<div class="tl-heading">';
    	echo '<h4>' . $this->getStory() . '</h4>';
    	echo '<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> ' . $this->getCreatedTime()->format("d. F") . '</small></p>';
    	echo '</div>';
    	echo '<div class="tl-body">';
    	echo '<p>' . $this->getMessage() . '</p>';
    	$this->imgToHtml();
    	echo '</div>';
    	echo '</div>';
	}

	private function imgToHtml() {
		$orientation = $this->imageUrls[0]->getOrientation();
		echo '<button class="btn btn-default"type="button" data-toggle="collapse" data-target="#' . $this->getPostId() . '" aria-expanded="true" aria-controls="' . $this->getPostId() . '">';
		echo '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>Expand';
		echo '</button>';
		if (count($this->imageUrls) == 1) {
			echo '<div class="row collapse show" id="' . $this->getPostId() . '">';
			echo '<div class"col-12">';
			echo '<a href="' . $img->getImageUrl() . '" data-lightbox="' . $this->getPostId() . '">';
			echo '<img src="' . $this->imageUrls[0]->getImageUrl() . '">';
			echo '</a>';
			echo '</div>';
			echo '</div>';
			return;
		}
		echo '<div data-height="heightfix" class="row collapse show" id="' . $this->getPostId() . '">';

		foreach ($this->imageUrls as $key => $img) {
			if ($key >= 4) {
				echo '<a href="' . $img->getImageUrl() . '" data-lightbox="' . $this->getPostId() . '"></a>';
				continue;
			}
			if ($key == 0) {
				switch ($orientation) {
					case 'p':
						echo '<div class="col-6 news-padding news-padding-right">';
						echo '<a href="' . $img->getImageUrl() . '" data-lightbox="' . $this->getPostId() . '">';
						echo '<img data-orientation="' . $img->getOrientation() . '" src="' . $img->getImageUrl() . '">';
						echo '</a>';
						echo '</div>';
						echo '<div class="col-6 no-padding">';
						break;

					case 'l':
						echo '<div class="col-12">';
						echo '<img src="' . $img->getImageUrl() . '">';
						echo '</div>';
						echo '<div class="col-12">';
						break;
					
					default:
						break;
				}
				continue;
			}
			switch ($orientation) {
				case 'p':
					$currOrientation = $img->getOrientation();
					echo '<div style="overflow:hidden;" class="col-12 news-padding news-padding-left">';
					echo '<a href="' . $img->getImageUrl() . '" data-lightbox="' . $this->getPostId() . '">';
					if ($currOrientation == 'p')
						echo '<img src="' . $img->getImageUrl() . '">';
					else
						echo '<img style="height:100%;" src="' . $img->getImageUrl() . '">';
					echo '</a>';
					echo '</div>';
					break;

				case 'l':
					echo '<div class="col-4">';
					echo '<img src="' . $img->getImageUrl() . '">';
					echo '</div>';
					break;
				
				default:
					break;
			}
		}
		echo '</div>';
		echo '</div>';
	}
}
?>