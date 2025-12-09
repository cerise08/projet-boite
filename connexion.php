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

    if (empty($email)) {
        echo 'Veuillez saisir un Email';
        $validemail = false;
    } else {
        $validemail = true;
    }
    if (empty($password)) {
        echo 'Veuillez saisir un Mot De passe';
        $validpassword = false;
    } else {
        $validpassword = true;
    }

    if ($validemail && $validpassword) {

        // récupérer aussi role (vérifie le nom de ta table/colonnes)
        $sql = 'SELECT nom, prenom, email, password, role FROM user WHERE email = :email';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            // si execute échoue, on lève une erreur visible en dev
            $err = $stmt->errorInfo();
            echo "Erreur SQL: " . htmlspecialchars($err[2]);
            exit;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            echo "Identifiants Incorrects";
        } else {

            // DEBUG TEMP: pour voir le contenu retourné (retirer après)
            // var_dump($row);

            if (password_verify($password, $row['password'])) {

                // On stocke l'email et le role dans la session
                $_SESSION['login'] = $row['email'];
                $_SESSION['role'] = isset($row['role']) ? $row['role'] : null;

                // DEBUG TEMP: afficher role avant redirection (retirer après)
                // echo "Role trouvé : " . htmlspecialchars($_SESSION['role']);

                // Normalisation (au cas où rôle en majuscule / espaces)
                $role = trim(strtolower((string)$_SESSION['role']));

                $_SESSION['connected'] = true;

                if ($role === 'admin') {
                    header('Location: index.php?page=admin');
                    exit;
                } else {
                    header('Location: index.php?page=home');
                    exit;
                }

            } else {
                echo "Identifiants Incorrects";
            }
        }
    }
}
?>

<link href="https://bootswatch.com/5/pulse/bootstrap.min.css" rel="stylesheet">
<form action="index.php?page=connexion" method="post">
  <h1 class = "text-danger text-center">Connexion</h1>
    <div>
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="AdresseMail">
    </div>
    <div>
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" name="Password">
    </div>
    <div>
      <button name="Valider" type="submit" class="btn btn-primary m-4">Connexion</button>
    </div>
</form>
