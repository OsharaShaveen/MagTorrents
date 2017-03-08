<?php
use gabrielcarvalhogama\MagTorrents as MT;

?>
<!DOCTYPE html>
<html lang="pt-br">
<?= MT\Inclusions\Head::get() ?>
<body>
<?= MT\Inclusions\Header::get() ?>
<div id="main">
    <div id="slider-highlights">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $sql = MT\App::$db->prepare("SELECT id_post, title, link, sinopse, poster, category, duration, year, size, quality FROM mt_posts ORDER BY id_post DESC LIMIT 10");

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
                ?>
                <div class="swiper-slide">
                    <a href="<?= MT\App::link('movies/' . $movie->link) ?>">
                        <div class="info">
                            <?= $movie->title ?>
                        </div>
                        <img src="<?= $movie->poster ?>"/>
                    </a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- Box de filmes -->
<?= MT\Inclusions\Movies::get() ?>
<?= MT\Inclusions\Partners::get() ?>

<?= MT\Inclusions\Footer::get() ?>
</body>
</html>
