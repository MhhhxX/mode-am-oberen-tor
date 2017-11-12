<?php
/*
 * config.php contains $app_id, $app_secret,
 * $graph_version, $access_token
 */
require_once "config.php";
require_once "FacebookHelp.php";
require_once "FacebookExtractor.php";

$user_id = '/337336379785052';

$post_offset;
$limit = 3;
isset($_POST['post_offset']) ? $post_offset = $_POST['post_offset'] : $post_offset = 0;

$fbHelp = FacebookHelp::newInstance($app_id, $app_secret, $graph_version, $access_token);
$session = $fbHelp->generateSession();
$extractor = new FacebookExtractor($fbHelp);

$feedEdge = $fbHelp->requestGraphEdge($user_id . '/feed?limit=' . $limit . '&offset=' . $post_offset);
$postList = $extractor->parseFeed($feedEdge);

foreach ($postList as $key => $post) {
	$post_pos = (($key%2)==1) ? 'class="timeline-inverted"' : '';
	echo '<li ' . $post_pos . '>';
    $post->toHtml();
    echo '</li>';
}
?>
