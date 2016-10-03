<?php
  class Pg{
    public function __construct($pg){
      $pg = (isset($_GET['pg']) AND !empty($_GET['pg'])) ? addslashes(strip_tags($_GET['pg'])) : "home";
      $pg = explode("/",$pg);
      $pg[0] = "public_html/$pg[0].php";
      if(file_exists($pg[0])):
        include($pg[0]);
      else:
        include("public_html/404.php");
      endif;
    }
  }
