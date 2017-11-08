<?php
require "FacebookHelp.php";
require "config.php";

class FacebookExtractor {
	private $fbHelp;

	public function __construct() {
		$fbHelp = FacebookHelp::newInstance($app_id, $app_secret, $graph_version, $access_token);
		$fbHelp->generateSession();
	}

	/*
	 * Parses a feed GraphEdge from the FacebookApi.
	 *
	 * @params GraphEdge $graphEdge is the feed page to be parsed.
	 * 
	 * @return list of Post objects
	 */
	public function parseFeed($graphEdge) {
		foreach($graphEdge as $key => $post) {
			$attachmentsNode;
			if(!($attachmentsNode = $fbHelp->requestGraphNode('/' . $post->getField('id') . '?fields=attachments')))
				echo "Fehler bitte Log lesen!";
		}
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