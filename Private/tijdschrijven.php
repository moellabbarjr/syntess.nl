<?php
   include("../layout/header.php");
   include("Private/Functions.php");

  if (!isset($_SESSION['loggedin'])) {
    
  }

  $user = (new User);

  $deny = false;
  switch($_SESSION['role']){
  case NULL:
      $deny = true;
      echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
      header("refresh:5;url=../index.php");
      break;
  }

  if(isset($_POST['btn_save'])){
  // $user_id = htmlspecialchars($_POST['user_id']);
  $taak = htmlspecialchars($_POST['taak']);
  $uren = htmlspecialchars($_POST['uren']);
  $omschrijving = htmlspecialchars($_POST['omschrijving']);
  $Datum = htmlspecialchars($_POST['Datum']);
  $user->insert($taak,$uren,$omschrijving,$Datum);
  }

  if($deny == false){
?>

<body>
  <nav>
    <ul>
      <li><a href="overzicht.php">Overzicht</a></li>
      <li><a class="active" href="tijdschrijven.php">Tijdschrijven</a></li>
      <li><a href="loguit.php">Loguit</a></li>
    </ul>
  </nav>
    <div class="container container-center">
    <div class="loginCard">
        <h1 style="text-align: center;">Tijdschrijven</h1>
        <form method="POST">
        <!-- <div class="form-group">
        <label for="user_id">
        <?php echo "Uw ID is: nr " . $_SESSION['loggedin'];?> <br>
        </label>
            <input class="form-control" type="text" name="user_id" id="user_id" placeholder="Vul hier uw ID in" value="">
        </div> -->
        <div class="form-group">
            <label for="taak">Taak:</label>
            <input class="form-control" type="text" name="taak" id="taak" placeholder="Taak" value="">
        </div>
        <div class="form-group">
            <label for="uren">Aantal uren:</label>
            <input class="form-control" type="text" name="uren" id="uren" placeholder="Alleen het cijfer" value="" >
        </div>
        <div class="form-group">
            <label for="omschrijving">Omschrijving:</label>
            <input class="form-control" type="text" name="omschrijving" id="omschrijving" placeholder="Taak omschrijving" value="">
        </div>
        <div class="form-group">
            <label for="taak">Datum:</label>
            <input class="form-control" type="date" name="Datum" id="Datum" value="">
            <div class="datumstamp">
              <?php 
                echo "De datum van vandaag:  " . date("d/m/y") . "<br>";
              ?>
            </div>
        </div>
            <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Opslaan!">                    
        </form> 

</body>
<?php
} 
?>
