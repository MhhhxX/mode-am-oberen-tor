<?php
/*
 * config.php contains $app_id, $app_secret,
 * $graph_version, $access_token
 */
require_once "config.php";
require_once "FacebookHelp.php";
require_once "FacebookExtractor.php";
require_once "BasePost.php";
require_once "EventPost.php";

$user_id = '/337336379785052';

$offset;
$limit = 3;
isset($_POST['offset']) ? $offset = $_POST['offset'] : $offset = 0;

$fbHelp = FacebookHelp::newInstance($app_id, $app_secret, $graph_version, $access_token);
$session = $fbHelp->generateSession();
$extractor = new FacebookExtractor($fbHelp);

$feedEdge = $fbHelp->requestGraphEdge($user_id . '/feed?limit=' . $limit . '&offset=' . $offset);
$postList = $extractor->parseFeed($feedEdge);

var_dump($postList);

?>
