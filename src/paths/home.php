<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <title>MagTorrents</title>
    <?= \gabrielcarvalhogama\MagTorrents\Inclusions\Head::get() ?>
    <link rel="stylesheet" href="lib/css/bootstrap.css"/>
    <link rel="stylesheet" href="lib/css/plugins.css"/>
    <link rel="stylesheet" href="lib/css/styles.css"/>
    <link rel="stylesheet" href="lib/css/home.css"/>

    <meta property="og:title" content="MagTorrents"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://magtorrents.com"/>
    <meta property="og:image" content="http://magtorrents.com/lib/images/opengraph.jpg"/>
    <meta property="og:image:width" content="514"/>
    <meta property="og:image:height" content="384"/>
    <meta property="og:description" content="Filmes a um download! Baixe todos os seus filmes favoritos!"/>

</head>
<body>
<?= \gabrielcarvalhogama\MagTorrents\Inclusions\Header::get() ?>
<div id="main">
    <div id="slider-highlights">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $sql = \gabrielcarvalhogama\MagTorrents\App::$db->prepare("SELECT id_post, title, link, sinopse, poster, category, duration, year, size, quality FROM mt_posts ORDER BY id_post DESC");

                $movie = new stdClass();
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

                while ($sql->fetch()) {
                    echo "<div class='swiper-slide'>",
                    "<a href='movies/$movie->link'>",
                    "<div class='info'>",
                    "{$movie->title}",
                    "</div>",
                    "<img src='{$movie->poster}' />",
                    "</div>",
                    "</a>";
                }
                ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <!-- Box de filmes -->

    <?= \gabrielcarvalhogama\MagTorrents\Inclusions\Movies::get() ?>
    <?= \gabrielcarvalhogama\MagTorrents\Inclusions\Partners::get() ?>
</div>

<?= \gabrielcarvalhogama\MagTorrents\Inclusions\Footer::get() ?>
<script src="lib/js/jquery.js"></script>
<script src="lib/js/plugins.js"></script>
<script src="lib/js/home.js"></script>
</body>
</html>
