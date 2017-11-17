<?php
require "BasePost.php";
class EventPost extends BasePost {
	private $eventId;
	private $startTime, $endTime;
	private $place;
	private $eventName;

	public function __construct($postId, $eventId, $type, $message, $story, $imageUrls, $createdTime, 
								$startTime, $endTime, $place, $eventName) {
		parent::__construct($postId, $type, $message, $story, $imageUrls, $createdTime);
		$this->eventId = $eventId;
		$this->startTime = $startTime;
		$this->endTime = $endTime;
		$this->place = $place;
		$this->eventName = $eventName;
	}

	public function getEventId() {
		return $this->eventId;
	}

	public function getStartTime() {
		return $this->startTime;
	}

	public function getEndTime() {
		return $this->endTime;
	}

	public function getPlace() {
		return $this->place;
	}

	public function getEventName() {
		return $this->eventName;
	}

	public function setEventId($eventId) {
		$this->eventId = $eventId;
	}

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
	}

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
	}

	public function setPlace($place) {
		$this->place = $place;
	}

	public function setEventName($eventName) {
		$this->eventName = $eventName;
	}

	public function toHtml() {
		echo '<div class="tl-circ"></div>';
    	echo '<div class="timeline-panel">';
    	echo '<div class="tl-heading">';
    	echo '<h4>' . $this->getEventName() . '</h4>';
    	echo '<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> ' . $this->getCreatedTime()->format("d. F") . '</small></p>';
    	echo '</div>';
    	echo '<div class="tl-body">';
    	echo '<p>' . $this->getMessage() . '</p>';
    	$this->imgToHtml();
    	echo '</div>';
    	echo '</div>';
	}
}
?>