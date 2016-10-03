<?php
  $db = new DB;
  $sql = $db->con()->prepare("SELECT * FROM mt_posts WHERE link = :link");
  $sql->bindValue("link", $pg[1]);
  $sql->execute();
  $movie = $sql->fetchObject();
  if($sql->rowCount() > 0):
    $movieExists = true;
  endif;
  $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <title>MagTorrents - <?=(isset($movieExists) AND $movieExists == true) ? $movie->title: "Filmes" ; ?></title>
    <?=get_head()?>

    <meta property="og:title" content="MagTorrents - <?=(isset($movieExists) AND $movieExists == true) ? $movie->title: "Filmes" ; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=$url?>" />
    <meta property="og:image" content="<?=(isset($movieExists) AND $movieExists == true) ? $movie->poster : 'http://magtorrents.com/lib/images/opengraph.jpg' ?>" />
    <meta property="og:description" content="<?=(isset($movieExists) AND $movieExists == true) ? $movie->sinopse : 'Filmes a um download! Baixe todos os seus filmes favoritos!' ?>" />

    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/plugins.css" />
    <link rel="stylesheet" href="lib/css/styles.css" />
    <link rel="stylesheet" href="lib/css/movies.css" />
  </head>
  <body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=504716589736941";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <?=get_header()?>
    <div id="main">
      <?php if(isset($movieExists) AND $movieExists == true): ?>
        <div id="box-poster"><img src="<?=$movie->poster?>" /></div>
        <div id="box-movie">
          <h1 id="name-movie"><?=$movie->title?></h1>
          <div id="infos-movie">
            <p>Ano: <?=$movie->year?></p>
            <p>Categoria: <?=$movie->category?></p>
            <p>Duração: <?=$movie->duration?></p>
            <p>Diretor(es): <?=$movie->director?></p>
            <p id='imdb-movie'>IMDb: <?=$movie->imdb?></p>
            <p>Qualidade: <?=$movie->quality?></p>
            <p>Vídeo: <?=$movie->quality_video?></p>
            <p>Áudio: <?=$movie->quality_audio?></p>
          </div>
          <div id="sinopse-movie"><h1 class="section-title">Sinopse</h1><?=$movie->sinopse?></div>
          <div id="links-movie">
            <?php
              $sqLinks = $db->con()->prepare("SELECT link, post, type_link FROM mt_links WHERE post = :post");
              $sqLinks->bindValue("post", $movie->id_post);
              $sqLinks->execute();
              if($sqLinks->rowCount() > 0){
                while($ftc = $sqLinks->fetchObject()){
                  switch($ftc->type_link){
                    case 1:
                      echo "<a href='{$ftc->link}'><img src='lib/images/download-torrent.png' /></a>";
                    break;
                    case 2:
                      echo "<a href='{$ftc->link}'><img src='lib/images/download-magnetic.png' /></a>";
                    break;
                    default:
                      echo "<p>Download não disponível</p>";
                    break;
                  }
                }
              }else{
                echo "<hr /><p>Download não disponível</p>";
              }
            ?>
          </div>
        </div>
        <div class="fb-comments" data-width="100%" data-colorscheme="dark" data-href="<?="{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";?>"></div>
        <div class="clear" style="margin-bottom: 10px;"></div>
        <div class="fb-like" data-href="<?="{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";?>" data-colorscheme="dark" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
      <?php else:get_movies($error = true); endif; get_partners(); ?>
      </div>
      <?=get_footer(); ?>
  </body>
</html>
