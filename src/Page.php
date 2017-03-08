<?php

namespace gabrielcarvalhogama\MagTorrents;

class Page
{
    public function __construct($pg)
    {
        $pg = (isset($_GET['pg']) AND !empty($_GET['pg'])) ? addslashes(strip_tags($_GET['pg'])) : "home";
        $pg = explode("/", $pg);
        if (file_exists(ROOT_PATH . '/src/paths/' . $pg[0] . '.php')):
            include(ROOT_PATH . '/src/paths/' . $pg[0] . '.php');
        else:
            include(ROOT_PATH . '/src/paths/404.php');
        endif;
    }
}
