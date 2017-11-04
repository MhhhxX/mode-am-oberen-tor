<?php
/*
 * config.php contains $app_id, $app_secret,
 * $graph_version, $access_token
 */
require "config.php";
require "FacebookHelp.php";
require "post.php";

$fbHelp = new FacebookHelp($app_id, $app_secret, $graph_version, $access_token);
$session = $fbHelp->generateSession();