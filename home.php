<?php
// si la session n'est pas démarrée alors le faire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si le rôle est défini
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'user';
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    echo "Non connecté !";
    exit;
}

// Si l'utilisateur est admin, redirection vers la page admin
if (strtolower($_SESSION['role']) === 'admin') {
    header("Location: index.php?page=admin");
    exit();
}
?>

<h3 class="mt-4">📰 Nouveautés du campus</h3>
<table class="table table-hover">
  <tbody>
    <tr class="table-primary">
      <th scope="row">Primary</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
    <tr class="table-warning">
      <th scope="row">Warning</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
    <tr class="table-info">
      <th scope="row">Info</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
    </tr>
  </tbody>
</table>
    <!-- Affiches style campus -->
    <h3 class="mt-4">🪧 Tableau d'affichage du campus</h3>
    <div class="d-flex gap-3 flex-wrap mb-4">
        <img class="img-fluid rounded" style="width:350px" src="https://media.licdn.com/dms/image/v2/D4E22AQH3QVaCMPGK3A/feedshare-shrink_800/B4EZpZXtrNKgBI-/0/1762435980551?e=1766620800&v=beta&t=zNwSb2DYYUIEjbctfggtZ9XhIUES8VrPqiDxduvpfmk">
        <img class="img-fluid rounded" style="width:600px" src="https://media.licdn.com/dms/image/v2/D4E22AQFltIDzPDAeCQ/feedshare-shrink_1280/B4EZp8XBvLGoAs-/0/1763023007086?e=1766620800&v=beta&t=MJHjushszaJsJEcAeAyrNGZk5uJUjAa_g5yxyoWqIrM">
        <img class="img-fluid rounded" style="width:600px" src="https://media.licdn.com/dms/image/v2/D4E22AQG4bZ87rE7vrw/feedshare-shrink_800/B4EZoMbU1wKsAg-/0/1761145082510?e=1766620800&v=beta&t=0zAprvNxKNGG0OPox-I5KwmTH8lY3ZnB7XL4DI9Fs2U">
    </div>
