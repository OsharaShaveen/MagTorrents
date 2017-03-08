<?php

namespace gabrielcarvalhogama\MagTorrents\Inclusions;

use gabrielcarvalhogama\MagTorrents\App;

class Movies
{
    public static function get()
    {
        $sql = App::$db->prepare("SELECT id_post, title, link, sinopse, poster, category, duration, year, size, quality FROM mt_posts ORDER BY id_post DESC LIMIT 10");
        $sql->execute();

        $movie = new \stdClass();
        $sql->bind_result(
            $movie->id,
            $movie->title,
            $movie->link,
            $movie->sinopse,
            $movie->poster,
            $movie->category,
            $movie->duration,
            $movie->year,
            $movie->size,
            $movie->quality
        );

        $sql->execute();

        $response = '
<div id="all-movies" class="boxes">
    <h1 class="section-title">Filmes</h1>';
        while ($sql->fetch()) {
            $response .= '
            <a href="movies/' . $movie->link . '">
            <div class="item">
            <img src="' . $movie->poster . '" />
            <div class="info">
            <h1>' . $movie->title . '</h1>
            </div>
            </div>
            </a>';
        }
        $response .= '
    </div>
<div id="loading"><img src="lib/images/loading.gif" /></div>';

        return $response;
    }
}