<?php 
  include("../layout/header.php");
  include("../Private/Functions.php");

  $deny = false;
  switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
        header("refresh:1;url=../index.php");
        break;
  }

  $user = (new user);

  if(isset($_POST['register'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordRepeat = htmlspecialchars($_POST['passwordRepeat']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    if($password == $passwordRepeat){
        echo "<p style= 'padding-top: 25px ; width:100%; font-size: 25px; text-align: center;'> Gebruiker succelvol aangemaakt!" . "</p>";
        header("refresh:1;url=user_overzicht.php");
        $user->register($email,$firstname,$lastname,$password);
        return true;
    }else{
        echo "<p style= 'padding-top: 25px ; width:100%; font-size: 25px; text-align: center;'> Er is wat fout gegaan, controleer de ingevoerde gegevens! " . "</p>";
        header("refresh:2;url=sign-up.php");
        return false;
    }
  }
  if($deny == false){
?>
<body>
  <nav>
    <ul>
      <li><a href="Admindash.php">Dashboard</a></li>
      <li><a class="active" href="sign-up.php">User aanmaken</a></li>
      <li><a href="user_overzicht.php">User overzicht</a></li>
      <li><a href="../Private/loguit.php">Loguit</a></li>
    </ul>
  </nav>
</body>

<h2 class="h2_text">User aanmaken</h2>

<div class="container container-center">
<div class="loginCard">
<img class="logo" src="../afbeeldingen/logo.png" alt="">
        <form action="" method="POST">
          <div class="form-container">
              <label for="loginEmail">E-mailadres:</label>
              <input id="loginEmail" type="email" placeholder="E-mailadres" name="email"  >

              <label for="loginPassword" class="align">Voornaam:</label>
              <input id="loginPassword" type="text" placeholder="Voornaam" name="firstname" class="aligner" >

              <label for="loginPassword">Achternaam:</label>
              <input id="loginPassword" type="text" placeholder="Achternaam" name="lastname" >

              <label for="loginPassword">Wachtwoord:</label>
              <input id="loginPassword" type="password" placeholder="Wachtwoord" name="password" >

              <label for="loginPassword">Herhaal Wachtwoord:</label>
              <input id="loginPassword" type="password" placeholder="Herhaal Wachtwoord" name="passwordRepeat" >
          </div>
          <div class="button-container">
            <button type="submit" name="register" class="btn">Aanmelden</button> <br>
          </div>
        </form>
      </div>
</div>
<?php
} 
?>
