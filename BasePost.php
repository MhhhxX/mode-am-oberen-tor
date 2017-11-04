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
}
?>