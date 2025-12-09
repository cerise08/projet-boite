<?php
// si la session n'est pas démarré alors le faire
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<link href="https://bootswatch.com/5/pulse/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Boite à livrable</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=home">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=fichier">Envoyer un fichier</a>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto">
        <?php
        if(isset($_SESSION['login'])){
          $email = $_SESSION['login'];
          $role = $_SESSION['role'];
          $surname = $_SESSION['prenom'];
        if ($_SESSION['role'] == 'Admin') {;
          echo ' <li class="nav-item">
          <a class="nav-link" href="index.php?page=ListeUser">Liste User</a>
        </li>';
        echo ' <li class="nav-item">
          <a class="nav-link" href="index.php?page=admin">Liste Livrables</a>
        </li>';
        } 
        echo '<li class="nav-item">
        <a class="nav-link" href="">'.$surname.'</a>
        </li>';
        echo '<li class="nav-item">
        <a class="nav-link" href="index.php?page=deconnexion">Se Deconnecter</a>
      </li>';
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
      </ul>

    </div>
  </div>
</nav>