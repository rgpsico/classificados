<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">

    <title>Classificados</title>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="./" class="navbar-brand">Classificados</a>
            </div> 
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!isset($_SESSION['cloginb']) && !empty($_SESSION['cLogin'])): ?>               
                        <li><a href="meus-anuncios.php">Meus Anuncios</a></li>
                        <li><a href="sair.php">Sair</a></li>
                    <?php else: ?> 
                        <li><a href="cadastre-se.php">Cadastre-se</a></li>
                        <li><a href="login.php">Login</a></li>
                    <?php endif ;?>
                </ul>            
        </div>
    </nav>