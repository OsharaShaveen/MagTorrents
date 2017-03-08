<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <title>MagTorrents - Contato</title>
    <?=get_head()?>

    <meta property="og:title" content="MagTorrents - Contato" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <meta property="og:image" content="http://magtorrents.com/lib/images/opengraph.jpg" />
    <meta property="og:image:width" content="514" />
    <meta property="og:image:height" content="384" />
    <meta property="og:description" content="Procurando parceria ou está com algum problema? Entre em contato conosco." />
  </head>
  <body>
    <?php include_once("temps/header.inc.php");?>
    <div id="main">
      <div id="content">
        <h1 class="">Contato</h1>
        <p>Entre em contato conosco através do e-mail <strong>suporte@magtorrents.com</strong>.</p>
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
