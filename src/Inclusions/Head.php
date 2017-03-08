<?php

namespace gabrielcarvalhogama\MagTorrents\Inclusions;

class Head
{
    public static function get()
    {
        return '
<head>
    <title>MagTorrents</title>
    <meta charset="utf-8" />
    
    <link rel="stylesheet" href="/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="/assets/css/styles.css" />
    <link rel="stylesheet" href="/assets/css/quem-somos.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/generos.css" />
    
    <link rel="shortcut icon" href="/assets/images/icon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width" />
</head>
';
    }
}
