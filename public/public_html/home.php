<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <title>MagTorrents</title>
    <?=get_head()?>
    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/plugins.css" />
    <link rel="stylesheet" href="lib/css/styles.css" />
    <link rel="stylesheet" href="lib/css/home.css" />

    <meta property="og:title" content="MagTorrents" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://magtorrents.com" />
    <meta property="og:image" content="http://magtorrents.com/lib/images/opengraph.jpg" />
    <meta property="og:image:width" content="514" />
    <meta property="og:image:height" content="384" />
    <meta property="og:description" content="Filmes a um download! Baixe todos os seus filmes favoritos!" />

  </head>
  <body>
    <?php include_once("temps/header.inc.php");?>
    <div id="main">
      <div id="slider-highlights">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <?php
              $db = new DB;
              $sql = $db->con()->prepare("SELECT id_post, title, link, sinopse, poster, category, duration, year, size, quality FROM mt_posts ORDER BY id_post DESC");
              $sql->execute();

              while($ftc = $sql->fetchObject()){
                echo "<div class='swiper-slide'>",
                  "<a href='movies/$ftc->link'>",
                    "<div class='info'>",
                      "{$ftc->title}",
                    "</div>",
                    "<img src='{$ftc->poster}' />",
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
      <?php get_movies(); get_partners()?>
    </div>

    <?=get_footer()?>
    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/plugins.js"></script>
    <script src="lib/js/home.js"></script>
  </body>
</html>
