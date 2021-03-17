<?php 
  include("../layout/header.php");
  include("../Private/User.php");


$user = (new user);

if(isset($_POST['register'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordRepeat = htmlspecialchars($_POST['passwordRepeat']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    if($password == $passwordRepeat){
        $user->register($email,$firstname,$lastname,$password);
        return true;
    }else{
        return false;
    }
}
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

<div class="container container-center">
<div class="loginCard">
        <div class="title">
          <p>Syntess portaal</p>
        </div>
        <form action="" method="POST">
          <div class="form-container">
              <label for="loginEmail">E-mailadres:</label>
              <input id="loginEmail" type="email" placeholder="E-mailadres" name="email" required >

              <label for="loginPassword" class="align">Voornaam:</label>
              <input id="loginPassword" type="text" placeholder="Voornaam" name="firstname" class="aligner" required>

              <label for="loginPassword">Achternaam:</label>
              <input id="loginPassword" type="text" placeholder="Achternaam" name="lastname" required>

              <label for="loginPassword">Wachtwoord:</label>
              <input id="loginPassword" type="password" placeholder="Wachtwoord" name="password" required>

              <label for="loginPassword">Herhaal Wachtwoord:</label>
              <input id="loginPassword" type="password" placeholder="Herhaal Wachtwoord" name="passwordRepeat" required>
          </div>
          <div class="button-container">
            <button type="submit" name="register" class="btn">Aanmelden</button> <br>
            <a href="sign-up.php"><button type="button" name="Anu" class="btn">Annuleren</button></a>
          </div>
        </form>
      </div>
</div>

<?php include("layout/footer.php");?>