<?php
require "FacebookHelp.php";
require "config.php"

class FacebookExtractor {
	private $fbHelp = FacebookHelp::newInstance($app_id, $app_secret, $graph_version, $access_token);

	public function __construct() {
		$fbHelp->generateSession();
	}

	public static function parseFeed($graphEdge) {
		foreach($graphEdge as $key => $post) {
			
		}
	}
}
?>