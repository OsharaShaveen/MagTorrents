<?php

namespace gabrielcarvalhogama\MagTorrents\Inclusions;

class Header
{
    public function __construct()
    {
        return '
<header>
  <div id="box-logo"><a href=\'/\'><img src="lib/images/logo-magtorrents.png" /></a></div>
  <nav>
    <ul>
      <li><a href=\'javascript:void()\' class="arrow_bottom">Navegação</a>
        <ul class="submenu">
          <div class="rows_items">
            <li><a href="home">Início</a></li>
            <li><a href="http://online.magtorrents.com" target="_blank">Filmes Online</a></li>
            <li><a href="quem-somos">Quem somos</a></li>
            <li><a href="contato">Contato</a></li>
          </div>
          <div class="rows_items">
            <div>
              <li><a href="generos/Acao">Ação</a></li>
              <li><a href="generos/Terror">Terror</a></li>
              <li><a href="generos/Suspense">Suspense</a></li>
              <li><a href="generos/Guerra">Guerra</a></li>
            </div>
            <div>
              <li><a href="generos/Nacional">Nacional</a></li>
              <li><a href="generos/Aventura">Aventura</a></li>
              <li><a href="generos/Ficcao">Ficção</a></li>
              <li><a href="generos/Comedia">Comédia</a></li>
            </div>
            <div>
              <li><a href="generos/Animacao">Animação</a></li>
              <li><a href="generos/Documentario">Documentário</a></li>
              <li><a href="generos/Drama">Drama</a></li>
              <li><a href="generos/Fantasia">Fantasía</a></li>
            </div>
          </div>
        </ul>
      </li>
    </ul>
    <div id="box-search">
      <form action="search" method="get">
        <input type="search" name="q" placeholder="Faça uma busca..." />
      </form>
    </div>
  </nav>

  <select onChange="window.location.href=this.value">
    <option value="home">Início</option>
    <option value="http://online.magtorrents.com">Assistir on-line</option>
    <option value="quem-somos">Quem somos</option>
    <option value="contato">Contato</option>
    <option value="#">Gêneros</option>
    <option value="generos/Acao"> - Ação</option>
    <option value="generos/Terror"> - Terror</option>
    <option value="generos/Suspense"> - Suspense</option>
    <option value="generos/Guerra"> - Guerra</option>
    <option value="generos/Nacional"> - Nacional</option>
    <option value="generos/Aventura"> - Aventura</option>
    <option value="generos/Ficcao"> - Ficção</option>
    <option value="generos/Comedia"> - Comédia</option>
    <option value="generos/Animacao"> - Animação</option>
    <option value="generos/Documentário"> - Documentário</option>
    <option value="generos/Drama"> - Drama</option>
    <option value="generos/Fantasia"> - Fantasía</option>
  </select>


</header>';
    }
}
