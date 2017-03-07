<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?=get_head()?>
    <title>Administration - MagTorrents</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="lib/css/materialize.min.css" />
    <link rel="stylesheet" href="lib/css/administration.css" />
  </head>
  <body>
    <div id="main">
      <h1><img src="lib/images/logo-magtorrents.png"/></h1>
      <div id="message"></div>
      <form method="post" action="javascript:void();" id="administration_form" class='form-group'>
        <p>
          <input type="password" placeholder="Código de Acesso" id="password" class="input-field validate" required />
      	</p>
        <button class="waves-effect waves-light btn-large">Entrar<i class="material-icons right">send</i></button>
      </form>
    </div>
    <script type="text/javascript" src="lib/js/jquery.js"></script>
    <script type="text/javascript" src="lib/js/administration.js"></script>
  </body>
</html>
