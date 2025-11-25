<?php
if (isset($_POST['Valider'])) {
    $email = $_POST['Mail'];
    $password = $_POST['Password'];
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];

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
    if (empty($name)) {
        echo " veuillez saisir un name ";
    } else {
        echo "  $name";
    }
    if (empty($surname)) {
        echo " veuillez saisir un Prénom$surname ";
    } else {
        echo "  $surname";
    }
  }
?> 

<form action="index.php?page=signup" method="post">
  <fieldset>
    <legend class="mt-4">Inscription</legend>
    <div>
      <label for="exampleInputNom1" class="form-label mt-4">Votre Nom</label>
      <input type="text" class="form-control" id="exampleInputNom1" name="Name">
    </div>
    <div>
      <label for="exampleInputsurname$surname1" class="form-label mt-4">Votre Prénom</label>
      <input type="text" class="form-control" id="exampleInputsurname$surname1" name="Surname">
    </div>
    <div>
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="Mail">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div>
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off" name="Password">
    </div>
    <button type="submit" class="btn btn-primary" name="Valider">Soumettre</button>
  </fieldset>
</form>
  
