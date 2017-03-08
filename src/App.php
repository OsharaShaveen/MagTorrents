<?php

namespace gabrielcarvalhogama\MagTorrents;

class App
{
    const PASSWORD_PANEL = 'magtorrents123@';

    public static $db;

    public function __construct()
    {
        define('ROOT_PATH', realpath('../'));
        $database = new Db();
        self::$db = $database::$db;
    }
}