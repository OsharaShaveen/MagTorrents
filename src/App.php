<?php

namespace gabrielcarvalhogama\MagTorrents;

class App
{
    const PASSWORD_PANEL = 'magtorrents123@';

    const REWRITE_URLS = false;

    public static $db;

    public function __construct()
    {
        define('ROOT_PATH', realpath('../'));
        $database = new Db();
        self::$db = $database::$db;
    }

    public static function link($path = '/')
    {
        if (self::REWRITE_URLS) {
            return $path;
        } else {
            return '?pg=' . $path;
        }
    }
}