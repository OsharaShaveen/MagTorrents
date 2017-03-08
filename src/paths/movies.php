<?php
use gabrielcarvalhogama\MagTorrents as MT;

$sql = MT\App::$db->prepare("SELECT * FROM mt_posts WHERE link = ?");
$sql->bind_param("s", $pg[1]);

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
    $movie->director,
    $movie->size,
    $movie->imdb,
    $movie->quality,
    $movie->quality_video,
    $movie->quality_audio,
    $movie->type
);

$sql->execute();
$sql->fetch();
$sql->close();

if (isset($movie->id)):
    $movieExists = true;
endif;
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?= MT\Inclusions\Head::get() ?>
<link href="/assets/css/movies.css" rel="stylesheet">
<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=504716589736941";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?= MT\Inclusions\Header::get() ?>
<div id="main">
    <?php if (isset($movieExists) AND $movieExists == true): ?>
        <div id="box-poster"><img src="<?= $movie->poster ?>"/></div>
        <div id="box-movie">
            <h1 id="name-movie"><?= $movie->title ?></h1>
            <div id="infos-movie">
                <p>Ano: <?= $movie->year ?></p>
                <p>Categoria: <?= $movie->category ?></p>
                <p>Duração: <?= $movie->duration ?></p>
                <p>Diretor(es): <?= $movie->director ?></p>
                <p id='imdb-movie'>IMDb: <?= $movie->imdb ?></p>
                <p>Qualidade: <?= $movie->quality ?></p>
                <p>Vídeo: <?= $movie->quality_video ?></p>
                <p>Áudio: <?= $movie->quality_audio ?></p>
            </div>
            <div id="sinopse-movie"><h1 class="section-title">Sinopse</h1><?= $movie->sinopse ?></div>
            <div id="links-movie">
                <?php
                $sqLinks = MT\App::$db->prepare("SELECT link, post, type_link FROM mt_links WHERE post = ?");
                $sqLinks->bind_param("i", $movie->id);

                $link = new stdClass();
                $sqLinks->bind_result(
                    $movie->link,
                    $movie->post,
                    $movie->type_link
                );

                $sqLinks->execute();
                while ($sqLinks->fetch()) {
                    if (isset($link->type_link)) {
                        switch ($link->type_link) {
                            case 1:
                                echo "<a href='{$link->link}'><img src='lib/images/download-torrent.png' /></a>";
                                break;
                            case 2:
                                echo "<a href='{$link->link}'><img src='lib/images/download-magnetic.png' /></a>";
                                break;
                            default:
                                echo "<p>Download não disponível</p>";
                                break;
                        }
                    }
                }
                $sqLinks->close();
                ?>
            </div>
        </div>
        <?php
    else:
        echo MT\Inclusions\Errors::noMovie();
    endif;
    MT\Inclusions\Partners::get(); ?>
</div>
<?= MT\Inclusions\Footer::get() ?>
</body>
</html>
