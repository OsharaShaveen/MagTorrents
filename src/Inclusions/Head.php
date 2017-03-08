<?php

namespace gabrielcarvalhogama\MagTorrents\Inclusions;

class Head
{
    public static function get()
    {
        return '
<meta charset="utf-8" />
<base href="http://localhost/MagTorrents/"/>
<link rel="shortcut icon" href="lib/images/icon.ico" type="image/x-icon"/>
<meta name="viewport" content="width=device-width" />';
    }
}
