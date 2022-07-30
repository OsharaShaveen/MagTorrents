<?php

namespace gabrielcarvalhogama\MagTorrents;

class Db
{
    private static $db_host = "Oshara";
    private static $db_user = "root";
    private static $db_pass = "root";
    private static $db_name = "Shaveen1234#";

    public static $db;

    public function __construct()
    {
        if (!isset(self::$db)) {
            self::$db = new \mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
        }
    }
}
