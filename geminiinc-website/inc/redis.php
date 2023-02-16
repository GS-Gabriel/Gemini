<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->auth('8a7b86a2cd89d96dfcc125ebcc0535e6');

?>
