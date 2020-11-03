<?php include_once ("lib/includes.php"); ?>
<!doctype html>
<html lang="pt">
  <head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Recuperar Senha</title>
  </head>
  <body>
<div class="row">
  <div class="col-sm-5 offset-md-3">
  <?php
  $url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio';
  $ext = '.php';
  $load = new LoadPage($url,$ext);
  $load->load();
  ?>
  </div>
</div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
  </body>
</html>