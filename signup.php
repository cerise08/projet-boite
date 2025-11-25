<?php
if (isset($_POST['transmettre'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    if (empty($email)) {
        echo "veuillez saisir un email ";
    } else {
        echo "vous avez saisi : $email";
    }
    if (empty($password)) {
        echo " veuillez saisir un mot de passe ";
    } else {
        echo "  $password";
    }
    if (empty($nom)) {
        echo " veuillez saisir un nom ";
    } else {
        echo "  $nom";
    }
    if (empty($prenom)) {
        echo " veuillez saisir un prenom ";
    } else {
        echo "  $prenom";
    }
  }
?> 

<form action="index.php?page=signup" method="post">
  <fieldset>
    <legend class="mt-4">Inscription</legend>
    <div>
      <label for="exampleInputNom1" class="form-label mt-4">Votre Nom</label>
      <input type="text" class="form-control" id="exampleInputNom1">
    </div>
    <div>
      <label for="exampleInputPrenom1" class="form-label mt-4">Votre Prénom</label>
      <input type="text" class="form-control" id="exampleInputPrenom1">
    </div>
    <div>
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div>
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>
  