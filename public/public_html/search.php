<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <title>MagTorrents - Quem Somos</title>
    <?=get_head()?>
    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/plugins.css" />
    <link rel="stylesheet" href="lib/css/styles.css" />
    <link rel="stylesheet" href="lib/css/quem-somos.css" />
  </head>
  <body>
    <?php include_once("temps/header.inc.php");?>
    <div id="main">
      <div id="content">
        <h1 class="">Resultados para <?=$_GET['q'];?></h1>
      </div>
      <div id='all-movies' class='boxes'>
        <h1 class='section-title'>Filmes</h1>
        <?php
          $search = (isset($_GET['q']) ? addslashes(strip_tags($_GET['q'])) : "");
          $db = new DB;
          $sql = $db->con()->prepare("SELECT id_post, title, link, poster FROM mt_posts WHERE
            (MATCH(title) AGAINST (:search IN BOOLEAN MODE) OR title Like '%:search%' OR sinopse Like '%:search%')
            ORDER BY id_post DESC");
          $sql->bindValue("search", $search);
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
            echo "<p>Nenhum filme foi encontrado.</p>";
          }
        ?>
      </div>
      <!-- Box de filmes -->
      <?php get_partners()?>
    </div>

    <?=get_footer()?>
    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/plugins.js"></script>
  </body>
</html>
