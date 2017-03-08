<?php

namespace gabrielcarvalhogama\MagTorrents\Inclusions;

class Navbar
{
    public function __construct()
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