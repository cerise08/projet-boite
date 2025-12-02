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
        <li class="nav-item"><a class="nav-link active" href="index.php?page=home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?page=fichier">Envoyer un fichier</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php
        // Si l'utilisateur est connecté
        if(isset($_SESSION['login'])){
            $prenom = $_SESSION['prenom']; // récupère le prénom stocké à la connexion
            echo '<li class="nav-item">
                    <span class="nav-link fw-bold">Bonjour, '.$_SESSION['login'].'</span>
                  </li>';
            echo '<li class="nav-item">
                    <a class="nav-link fw-bold" href="index.php?page=deconnexion">Déconnexion</a>
                  </li>';
        } else {
            // Si l'utilisateur n'est pas connecté
            echo '<li class="nav-item">
                    <a class="nav-link fw-bold" href="index.php?page=connecter">Se connecter</a>
                  </li>';
            echo '<li class="nav-item">
                    <a class="nav-link fw-bold" href="index.php?page=signup">S\'inscrire</a>
                  </li>';
        }
        ?>
      </ul>

    </div>
  </div>
</nav>
