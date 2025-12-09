<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Formulaire d'upload de fichiers</title>
</head>
<body>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <h2>Envoyer le fichier</h2>
    <label for="fileUpload">Fichier :</label>
    <input type="file" name="photo" id="fileUpload" accept=".ptx,.zip">
    <input type="submit" name="submit" value="Envoyer">
    <p><strong>Note :</strong> seuls les formats .ptx et .zip sont autorisés.</p>
  </form>
</body>
</html>

