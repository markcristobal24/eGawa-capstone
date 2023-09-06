<?php
require_once dirname(__FILE__) . "/../../vendor/autoload.php";

$options = array (
    'cluster' => 'ap1',
    'useTLS' => true
);

$pusher = new Pusher\Pusher(
    '7717fc588fb67a40c2c6',
    'ce2de37e95416673e758',
    '1650503',
    $options
);
?>