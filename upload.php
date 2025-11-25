<?php
// Crée le dossier "uploads" s'il n'existe pas
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
}

// Vérifie si un fichier a été envoyé
if (isset($_FILES['fichier'])) {
    $file = $_FILES['fichier'];
    $targetFile = $uploadDir . basename($file['name']);

    // Vérifie qu'il n'y a pas d'erreur
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Déplace le fichier depuis le dossier temporaire vers "uploads/"
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "Fichier téléchargé avec succès : " . htmlspecialchars($file['name']);
        } else {
            echo "Erreur lors de l'enregistrement du fichier.";
        }
    } else {
        echo "Erreur d'upload : " . $file['error'];
    }
} else {
    echo "Aucun fichier reçu.";

}
?>
