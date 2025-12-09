<?php
if (isset($_POST["Valider"])) {
    $email = htmlentities($_POST["AdresseMail"]);
    $password = htmlentities($_POST["Password"]);

    $validemail = !empty($email);
    $validpassword = !empty($password);

    if (!$validemail) echo 'Veuillez saisir un Email<br>';
    if (!$validpassword) echo 'Veuillez saisir un Mot de passe<br>';

    if (($validemail)&&($validpassword)){
      $sql = 'SELECT name, surname, email,password,role FROM Utilisateur where email= :email';
      $sql = $dbh->prepare($sql);
      $sql->bindParam(':email', $email, PDO::PARAM_STR);
      $sql->execute();
      $row = $sql->fetch();
      if($row==NULL){
      echo "Identifiants Incorrects";
    }
    else{
      if (password_verify($password, $row['password'])) {
      $_SESSION['login'] = $row['email'];
      $_SESSION['role'] = $row['role'];
      header('Location: index.php?page=home');
      exit;
    } else {
      echo "Identifiants Incorrects";
    }
    }
    }
}
?>
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
