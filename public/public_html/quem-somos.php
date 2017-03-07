<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <title>MagTorrents - Quem Somos</title>
    <?=get_head()?>
    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/plugins.css" />
    <link rel="stylesheet" href="lib/css/styles.css" />
    <link rel="stylesheet" href="lib/css/quem-somos.css" />

    <meta property="og:title" content="MagTorrents - Quem somos" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <meta property="og:image" content="http://magtorrents.com/lib/images/opengraph.jpg" />
    <meta property="og:image:width" content="514" />
    <meta property="og:image:height" content="384" />
    <meta property="og:description" content="Conheça mais a MagTorrents." />
  </head>
  <body>
    <?php include_once("temps/header.inc.php");?>
    <div id="main">
      <div id="content">
        <h1 class="">Quem somos?</h1>
        <p>Um site focado na disponibilização de downloads como filmes e series, tendo como diferencial a facilidade de uso. Feito por profissionais que contem uma larga vivência na área de progamação , além de todo o conhecimento referente a cinema. Todo o site foi projetado para facilitar e disponibilizar os melhores conteudos, tendo como objetivo agradar o visitante!</p>
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
