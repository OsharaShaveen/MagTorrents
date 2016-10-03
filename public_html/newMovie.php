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
    <title>MagTorrents - Novo Filme</title>

    <link rel="stylesheet" href="lib/css/bootstrap.css" />
    <link rel="stylesheet" href="lib/css/dashboard.css" />
  </head>
  <body>
    <?=get_nav_adm()?>
    <main>
      <div id="boxForm">
        <form action="javascript:void()" method="post" id="newFilme">
          <div id="message"></div>
          <p><input type="text" placeholder="Nome do Filme" id="title" required class="form-style" /></p>
          <p><textarea id="sinopse" placeholder="Sinopse" rows="7" required class="form-style"></textarea></p>
          <p><input type="url" placeholder="Poster do Filme (URL)" id="poster" required class="form-style" /></p>
          <p><input type="text" placeholder="Categorias (Ex: ação, comédia)" id="categories" required class="form-style" /></p>
          <p><input type="number" placeholder="Duração (Minutos)" id="duration" required class="form-style" /></p>
          <p><input type="number" placeholder="Ano de Lançamento (XXXX)" id="year" required class="form-style" /></p>
          <p><input type="text" placeholder="Diretor" id="director" required class="form-style" /></p>
          <p><input type="number" placeholder="Tamanho (Em MB)" id="size" required class="form-style" /></p>
          <p><input type="text" placeholder="iMDB (Ex: 8.1)" id="imdb" required class="form-style" /></p>
          <p><input type="text" placeholder="Qualidade (Ex: 720p (Blu-Ray) )" id="quality" required class="form-style" /></p>
          <p><input type="number" placeholder="Qualidade do Áudio (0 - 10)" id="qualityAudio" min="1" max="10" required class="form-style" /></p>
          <p><input type="number" placeholder="Qualidade do Vídeo (0 - 10)" id="qualityVideo" min="1" max="10" required class="form-style" /></p>
          <p><input type="text" placeholder="URL para Download" class="urlDownload form-style" required /></p>
          <p id='moreLinks'></p>
          <a href="javascript:void()" id="moreLink">+ Link</a>

          <p><input type="checkbox" id="haveLegend" />URL da Legenda
            <input type="url" placeholder="URL da Legenda Para Download" class="form-style" id="legendUrl" />
          </p>

          <p><input type="submit" value="Adicionar Filme" /></p>


        </form>
      </div>
    </main>

    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/dashboard.js"></script>
  </body>
</html>
