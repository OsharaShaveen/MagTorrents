<?php

namespace gabrielcarvalhogama\MagTorrents\Inclusions;

class Navbar
{
    public static function get()
    {
        return '
<nav id="menuPrincipal">
  <img src="lib/images/logo-magtorrents.png" />
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="newMovie">Novo Filme</a></li>
  </ul>
</nav>
';
    }
}