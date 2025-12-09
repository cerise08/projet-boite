<?php
// DEBOGAGE / DEV : activer l'affichage des erreurs (enlever en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// si la session n'est pas démarré alors le faire
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST["Valider"])) {

    $email = htmlentities($_POST["AdresseMail"]);
    $password = htmlentities($_POST["Password"]);

    $validemail = $validpassword = false;

    if ($validemail && !preg_match('/^[\w.+-]+@ecoles-epsi\.fr$/', $email)) {
        echo "Seuls les emails @ecoles-epsi.fr sont autorisés.<br>";
        $validemail = false;
    }

    if ($validemail && $validpassword) {
        $sql = 'SELECT name, surname, email, password, role FROM Utilisateur WHERE email = :email';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row == NULL) {
            echo "Identifiants Incorrects";
        } else {
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['prenom'] = $row['surname'];
                header('Location: index.php?page=home');
                exit;
            } else {
                echo "Identifiants Incorrects";
            }
        }
    }
}
?>

<link href="https://bootswatch.com/5/pulse/bootstrap.min.css" rel="stylesheet">
<form action="index.php?page=connexion" method="post">
  <h1 class="text-danger text-center">Connexion</h1>
  <div>
    <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="AdresseMail" required>
  </div>
  <div>
    <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" name="Password" required>
  </div>
  <div>
    <button name="Valider" type="submit" class="btn btn-primary m-4">Connexion</button>
  </div>
</form>
