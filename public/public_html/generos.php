<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <title>MagTorrents - <?=(isset($pg[1]) AND !empty($pg[1])) ? $pg[1]: "Gêneros" ; ?></title>
    <?=get_head()?>
    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/plugins.css" />
    <link rel="stylesheet" href="lib/css/styles.css" />
    <link rel="stylesheet" href="lib/css/generos.css" />

    <meta property="og:title" content="MagTorrents - <?=(isset($pg[1]) AND !empty($pg[1])) ? $pg[1]: "Gêneros" ; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <meta property="og:image" content="http://magtorrents.com/lib/images/opengraph.jpg" />
    <meta property="og:image:width" content="514" />
    <meta property="og:image:height" content="384" />
    <meta property="og:description" content="Filtragem de filmes por gênero." />
  </head>
  <body>
    <?php include_once("temps/header.inc.php");?>
    <div id="main">
      <div id="content">
        <h1><?=(isset($pg[1]) AND !empty($pg[1])) ? $pg[1]: "Gêneros" ; ?></h1>
      </div>
      <div id='all-movies' class='boxes'>
        <h1 class='section-title'>Filmes</h1>
        <?php
          $genres = addslashes(strip_tags((isset($pg[1])) ? $pg[1] : ""));
          $db = new DB;
          $sql = $db->con()->prepare("SELECT id_post, title, link, sinopse, poster, category, duration, year, size, quality FROM mt_posts WHERE category Like :genres ORDER BY id_post DESC");
          $sql->bindValue("genres", $genres);
          $sql->execute();
          if($sql->rowCount() > 0){
            while($ftc = $sql->fetchObject()){
              echo "<a href='movies/$ftc->link'>",
                "<div class='item'>",
                  "<img src='$ftc->poster' />",
                  "<div class='info'>",
                    "<h1>$ftc->title</h1>",
                  "</div>",
                "</div>",
              "</a>";
            }
          }else{
            echo "<p>Nenhum filme deste gênero foi encontrado.</p>";
          }
        ?>
      </div>
      <!-- Box de filmes -->
      <?php get_partners()?>
    </div>

    <?=get_footer()?>
    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/plugins.js"></script>
    <script src="lib/js/home.js"></script>
  </body>
</html>
