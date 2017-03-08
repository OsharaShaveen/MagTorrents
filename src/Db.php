<?php

namespace gabrielcarvalhogama\MagTorrents;

class Db
{
    private static $db_host = "localhost";
    private static $db_user = "root";
    private static $db_pass = "root";
    private static $db_name = "magtorrents";

    private static $db;

    public function __construct()
    {
        if (!isset(self::$db)) {
            self::$db = new \mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
        }
        return self::$db;
    }
}
