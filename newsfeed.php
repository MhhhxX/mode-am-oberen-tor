<?php
require "config.php";
require "FacebookHelp.php"

$fbHelp = new FacebookHelp($app_id, $app_secret, $graph_version, $access_token);
$session = $fbHelp->generateSession();