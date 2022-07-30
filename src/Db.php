<?php

namespace gabrielcarvalhogama\MagTorrents;

class Db
{
    private static $db_host = "unitedstates.database.windows.net";
    private static $db_user = "Oshara";
    private static $db_pass = "Shaveen1234#";
    private static $db_name = "Oshara";

    public static $db;

    public function __construct()
    {
        if (!isset(self::$db)) {
            self::$db = new \mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
        }
    }
}
