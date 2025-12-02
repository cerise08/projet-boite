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
    <title>Boite à livrable</title>
    <link href="https://bootswatch.com/5/pulse/bootstrap.min.css" rel="stylesheet" >
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Boite à livrable</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">

        <!-- Liens principaux à gauche -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php?page=home">Home
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          <?php if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true): ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=signup">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=connexion">Connexion</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=fichier">Envoyer un fichier</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
          <?php endif; ?>
        </ul>

        <!-- Prénom à droite -->
        <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === true): ?>
          <span class="navbar-text fw-bold ms-auto">
            Bonjour, <?php echo htmlspecialchars($_SESSION['prenom']); ?>
          </span>
        <?php endif; ?>

      </div>
    </div>
  </nav>

  <div class="container text-center">
    <div class="row align-items-start">