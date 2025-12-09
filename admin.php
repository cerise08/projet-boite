<?php
require_once __DIR__ . "/db/mariadb.php";

// Récupération des livrables depuis la base
$sql = "SELECT id, filename, user_email, uploaded_at FROM livrables ORDER BY uploaded_at DESC";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);

$folder = "upload/";

// Suppression d’un fichier
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // récupérer l’enregistrement
    $sql = "SELECT filename FROM livrables WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':id' => $id]);
    $file = $stmt->fetch();

    if ($file) {
        $filePath = __DIR__ . "/upload/" . $file['filename'];

        // supprimer le fichier physique
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // supprimer en base
        $sql = "DELETE FROM livrables WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':id' => $id]);

        echo "<div class='alert alert-success'>Livrable supprimé.</div>";
    }
}
?>

<h1 class="text-center mt-4">Liste des livrables</h1>

<table class="table table-hover table-striped mt-4">
    <thead class="table-primary">
        <tr>
            <th>Nom du fichier</th>
            <th>Utilisateur</th>
            <th>Taille</th>
            <th>Date</th>
            <th>Télécharger</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($files as $file): 
            $path = __DIR__ . "/upload/" . $file['filename'];
            ?>
            <tr>
                <td><?= htmlspecialchars($file['filename']) ?></td>
                <td><?= htmlspecialchars($file['user_email']) ?></td>
                <td><?= file_exists($path) ? round(filesize($path) / 1024, 2) . " Ko" : "?" ?></td>
                <td><?= date("d/m/Y H:i", strtotime($file['uploaded_at'])) ?></td>
                <td>
                    <a href="livrable/<?= urlencode($file['filename']) ?>" 
                       class="btn btn-sm btn-primary" download>
                       Télécharger
                    </a>
                </td>
                <td>
                    <a href="index.php?page=ListeLivrables&delete=<?= $file['id'] ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Supprimer ce livrable ?');">
                       Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>