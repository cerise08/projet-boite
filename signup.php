<?php
// si la session n'est pas démarré alors le faire
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$erreurs = [];
$nom = $prenom = $email = $password = "";
$success = false;

if (isset($_POST['transmettre'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    if (empty($email))  { $erreurs['email'] = true; }
    if (empty($password)) { $erreurs['password'] = true; }
    if (empty($nom)) { $erreurs['nom'] = true; }
    if (empty($prenom)) { $erreurs['prenom'] = true; }

    if (empty($erreurs)) {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $role = "user";

        $sql = $dbh->prepare("
            INSERT INTO user (email, password, nom, prenom, role) 
            VALUES (:email, :password, :nom, :prenom, :role)
        ");

        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        $sql->bindParam(':nom', $nom, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sql->bindParam(':role', $role, PDO::PARAM_STR);

        $sql->execute();
        $success = true;

        $_SESSION['login'] = $email;
        $_SESSION['connected'] = true;
    }
}
?>

<?php if (!empty($erreurs)): ?>
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong>Erreur !</strong> Veuillez remplir les champs manquants.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if ($success): ?>
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <strong>Well done!</strong> Inscription réussie !
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <meta http-equiv="refresh" content="1; url=index.php?page=home">
</div>
<?php endif; ?>


<form action="index.php?page=signup" method="post">
  <fieldset>
    <legend class="mt-4">Inscription</legend>

    <div>
      <label class="form-label mt-4">Votre Nom</label>
      <input name="nom" type="text" 
             class="form-control <?= isset($erreurs['nom']) ? 'is-invalid' : '' ?>" 
             value="<?= htmlspecialchars($nom) ?>">
    </div>

    <div>
      <label class="form-label mt-4">Votre Prénom</label>
      <input name="prenom" type="text" 
             class="form-control <?= isset($erreurs['prenom']) ? 'is-invalid' : '' ?>" 
             value="<?= htmlspecialchars($prenom) ?>">
    </div>

    <div>
      <label class="form-label mt-4">Email address</label>
      <input name="email" type="email" 
             class="form-control <?= isset($erreurs['email']) ? 'is-invalid' : '' ?>" 
             value="<?= htmlspecialchars($email) ?>"
             placeholder="Enter email">
    </div>

    <div>
      <label class="form-label mt-4">Password</label>
      <input name="password" type="password"
             class="form-control <?= isset($erreurs['password']) ? 'is-invalid' : '' ?>" 
             placeholder="Password" autocomplete="off">
    </div>

    <button name="transmettre" type="submit" class="btn btn-primary mt-3">Soumettre</button>
  </fieldset>
</form>
