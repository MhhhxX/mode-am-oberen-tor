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
			$attachmentsNode;
			$imageArray = array();
			if(!($attachmentsNode = $fbHelp->requestGraphNode('/' . $post->getField('id') . '?fields=attachments')))
				echo "Fehler bitte Log lesen!";
			$media = $attachmentsNode->getField('attachments');
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
		}
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