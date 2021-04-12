<?php
  include("layout/header.php"); 
  include("Private/Functions.php");
  $login = (new User);
  if(isset($_POST['submit'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $login->login($email,$password);
  }
?>

<div class="container container-center">
<div class="loginCard">
  <img class="logo" src="afbeeldingen/logo.png" alt="">
  <form action="" method="POST">
  <label>E-mailadres:</label>
  <input class="w3-input" type="text" name="email" placeholder="E-mailadres" required></p>
  <p>
  <label>Wachtwoord:</label>
  <input class="w3-input" type="password" name="password" placeholder="Wachtwoord" required></p>
  <div class="button-container">
      <button id="loginEmail" id="loginBtn" name="submit" class="submit" type="submit">Inloggen</button>
    </div>
  </form>
</div>