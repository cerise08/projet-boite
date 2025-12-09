<?php

// Configuration
$uploadDir = __DIR__ . '/uploads'; // dossier d'upload (à créer si n'existe pas)
$maxFileSize = 30 * 1024 * 1024; // 30 MB (ajuste si nécessaire)
$allowed_extensions = ['ptx', 'zip'];

// Crée le dossier uploads si besoin
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        die("Erreur serveur : impossible de créer le dossier d'upload.");
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Aucun fichier reçu.");
}

if (!isset($_FILES['photo'])) {
    die("Aucun fichier envoyé avec le champ 'photo'.");
}

$file = $_FILES['photo'];

// Vérifier erreurs PHP d'upload
if ($file['error'] !== UPLOAD_ERR_OK) {
    $errors = [
        UPLOAD_ERR_INI_SIZE => "Le fichier dépasse la taille maximale.",
        UPLOAD_ERR_FORM_SIZE => "Le fichier dépasse la taille limite.",
        UPLOAD_ERR_PARTIAL => "Le fichier a été partiellement uploadé.",
        UPLOAD_ERR_NO_FILE => "Aucun fichier envoyé.",
        UPLOAD_ERR_NO_TMP_DIR => "Pas de dossier temporaire.",
        UPLOAD_ERR_CANT_WRITE => "Échec de l'écriture sur le disque.",
        UPLOAD_ERR_EXTENSION => "Upload arrêté par une extension PHP.",
    ];
    $code = $file['error'];
    $msg = isset($errors[$code]) ? $errors[$code] : "Erreur inconnue ($code).";
    die("Erreur d'upload : " . $msg);
}

// Vérifier la taille
if ($file['size'] > $maxFileSize) {
    die("Erreur : fichier trop volumineux. Taille max = " . ($maxFileSize / 1024 / 1024) . " Mo.");
}

// Vérifier extension
$originalName = $file['name'];
$ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed_extensions)) {
    die("Erreur : seuls les fichiers .ptx et .zip sont autorisés. (extension : .$ext)");
}

// (Optionnel) Vérifier MIME pour .zip (et laisser .ptx basé sur extension si tu n'as pas de signature précise)
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

// exemple contrôle mime pour zip (si zip attendu)
if ($ext === 'zip') {
    $allowed_mime_zip = ['application/zip', 'application/x-zip-compressed', 'application/octet-stream'];
    if (!in_array($mime, $allowed_mime_zip, true)) {
        // Parfois les zips peuvent avoir des mimes différents selon le système, donc on tolère 'application/octet-stream'
        // Si tu veux être strict : retirer application/octet-stream
        // die("Erreur : le fichier zip n'a pas un type MIME attendu ($mime).");
    }
}

// Générer un nom de fichier sécurisé et unique
$safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($originalName));
$target = $uploadDir . '/' . time() . '_' . $safeName;

if (!move_uploaded_file($file['tmp_name'], $target)) {
    die("Erreur serveur : impossible de sauvegarder le fichier.");
}

echo "Fichier uploadé avec succès : " . htmlspecialchars($safeName) . "<br>";
echo "Taille : " . round($file['size'] / 1024, 1) . " Ko<br>";
echo "Type MIME détecté : " . htmlspecialchars($mime) . "<br>";
echo "Emplacement : " . htmlspecialchars($target);
