<?php
  session_start();
  require_once("application/functions/config.php");
  if(!isset($_SESSION['passwordPanel']) OR $_SESSION['passwordPanel'] != PASSWORDPANEL OR $_SESSION['IPOrigin'] != $_SERVER['REMOTE_ADDR']):
    header("Location: administration");
  endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <?=get_head()?>
    <title>MagTorrents - Dashboard</title>

    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/dashboard.css" />
  </head>
  <body>
    <?=get_nav_adm()?>
    <main>
      Estatísticas ou sla
    </main>
  </body>
</html>
