<?php
// si la session n'est pas démarré alors le faire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

// Vérifier si le rôle est défini
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'user';
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    exit;
}

if ($_SESSION['role'] == 'admin') {
    header("Location: index.php?page=admin");
    exit();
}

?>
<h3 class="mt-4">📰 Nouveautés du campus</h3>
    <ul class="list-group mb-4">
        <li class="list-group-item">Nouveaux ateliers IA disponibles ce mois-ci.</li>
        <li class="list-group-item">Hackathon de 24h – inscriptions ouvertes.</li>
        <li class="list-group-item">Nouveau partenariat → plus d’offres de stage.</li>
    </ul>

    <!-- Affiches style campus -->
    <h3 class="mt-4">📢 Affiches du campus</h3>
    <div class="d-flex gap-3 flex-wrap mb-4">
        <img class="img-fluid rounded" style="width:300px" src="https://source.unsplash.com/400x200/?coding">
        <img class="img-fluid rounded" style="width:300px" src="https://source.unsplash.com/400x200/?students">
        <img class="img-fluid rounded" style="width:300px" src="https://source.unsplash.com/400x200/?presentation">
</div>