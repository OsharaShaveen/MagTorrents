<?php
  #Comente a próxima linha para exibir os erros
  error_reporting(0);
  require_once("application/class/Pg.class.php");
  require_once("application/functions/Includes.php");
  require_once("application/class/DB.class.php");
  $pg = new Pg(strip_tags($_GET['pg']));

?>
