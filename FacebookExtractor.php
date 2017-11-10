<?php
require 'FbImage.php';
require "FacebookHelp.php";
require "config.php";

class FacebookExtractor {
	private $fbHelp;

	public function __construct() {
		$fbHelp = FacebookHelp::newInstance($app_id, $app_secret, $graph_version, $access_token);
		$fbHelp->generateSession();
	}

	/*
	 * Parses a facebook feed as GraphEdge from the FacebookApi.
	 *
	 * @params GraphEdge $graphEdge is the feed page to be parsed.
	 * 
	 * @return list of Post objects
	 */
	public function parseFeed($graphEdge) {
		$postArray = array();
		foreach($graphEdge as $key => $post) {
			$postId = $post->getField('id');
			$type = $post->getField('type');
			$message = $post->getField('message');
			$story = $post->getField('story');
			$createdTime = $post->getField('created_time');
			$attachmentsNode;
			$imageArray = array();
			if(!($attachmentsNode = $fbHelp->requestGraphNode('/' . $postId . '?fields=attachments')))
				echo "Fehler bitte Log lesen!";
			$media = $attachmentsNode->getField('attachments');
			// collect attached media files
			if (($submedia = $media[0]->getField('subattachments')) == true) {	// post has multiple images
				foreach ($submedia as $key1 => $mediaelem) {
					$pictureLink = getPictureLink($mediaelem);
					$orientation = calcOrientation($pictureLink);
					$imageArray[] = new FbImage($pictureLink, $orientation);
				}
			} else {
				$pictureLink = getPictureLink($media);
				$orientation = calcOrientation($pictureLink);
				$imageArray[] = new FbImage($pictureLink, $orientation);
			}
			if ($post->getField('type') == 'event') {
				$eventId = calcEventId($post->getField('id'));
				$eventPost;
				if (!($eventPost = $fbHelp->requestGraphNode('/' . $eventId)))
					continue;
				$postArray[] = new EventPost($postId, $eventId, $type, $message, $story, $imageArray, $createdTime, 
								$eventPost->getField('start_time'), $eventPost->getField('end_time'), 
									$eventPost->getField('place'), $eventPost->getField('name'));
			} else {
				$postArray[] = new BasePost($postId, $type, $message, $story, $imageUrls, $createdTime);
			}
		}

		return $postArray;
	}

	private function calcOrientation($imageurl) {
		$imageDimension = getimagesize($imageurl);
		if ($imageDimension[0] / $imageDimension[1] < 1)
			return 'p';
		elseif ($imageDimension[0] / $imageDimension[1] = 1)
			return 's';
		return 'l';
	}

	private function calcEventId($id) {
		$eventId = split("_", $id);
		return $eventId[1];
	}

	private function getPictureLink($jsonNode) {
		return $jsonNode->getField('media')->getField('image')->getField('src');
	}
}
?>