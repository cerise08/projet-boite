<?php
// si la session n'est pas démarré alors le faire
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boite à Livrables</title>
    <link href="https://bootswatch.com/5/pulse/bootstrap.min.css" rel="stylesheet">
  </head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Boite à Livrables</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">

      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php?page=home">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=fichier">Envoyer un fichier</a>
        </li>
        <?php
        if(isset($_SESSION['login'])){
          $email = $_SESSION['login'];
          $role = $_SESSION['role'];
        echo '<li class="nav-item">
          <a class="nav-link" href="">'.$role.'</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=deconnexion">Se Deconnecter</a>
        </li>';
        if ($_SESSION['role'] == 'Admin') {;
          echo ' <li class="nav-item">
          <a class="nav-link" href="index.php?page=ListeUser">Liste User</a>
        </li>';
        echo ' <li class="nav-item">
          <a class="nav-link" href="index.php?page=admin">Liste Livrables</a>
        </li>';
        } 
      }
        else {
          echo '<li class="nav-item">
          <a class="nav-link" href="index.php?page=connexion">Connexion</a>
        </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="index.php?page=signup">S\'inscrire</a>
        </li>';
        
      }
        ?>
    </div>
  </div>
</nav>
