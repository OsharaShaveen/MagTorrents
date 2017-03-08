<?php
require "../vendor/autoload.php";

use gabrielcarvalhogama\MagTorrents\App;
use gabrielcarvalhogama\MagTorrents\Page;

$app = new App;

$page = '';

if (isset($_GET['pg'])) {
    $page = strip_tags($_GET['pg']);
}

$pg = new Page($page);