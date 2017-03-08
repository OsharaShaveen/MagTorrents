<?php

namespace gabrielcarvalhogama\MagTorrents;

class Db
{
    private static $db_host = "localhost";
    private static $db_user = "root";
    private static $db_pass = "root";
    private static $db_name = "magtorrents";

    public function __construct()
    {
        return new \mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
    }
}
