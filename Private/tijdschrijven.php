<?php
  include("../layout/header.php");
  if (!isset($_SESSION)) {
    session_start();
}

require_once "User.php";

$objUser = new User();

    if(isset($_POST['btn_save'])){
        $taak = strip_tags($_POST['taak']);
        $uren = strip_tags($_POST['uren']);
        $omschrijving = strip_tags($_POST['omschrijving']);

        try{
            if($user_id != null){
                if($objUser->update($taak, $uren, $omschrijving, $user_id)){
                    $objUser->redirect("tijdschrijven.php?updated");
                }
                }else{
                    if($objUser->insert($taak, $uren, $omschrijving)){
                        $objUser->redirect("tijdschrijven.php?inserted");
                }else{
                    $objUser->redirect("tijdschrijven.php?error");
                }
            }
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }  
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

        <h1 style="margin-top: 10px; text-align: center;">Tijdschrijven</h1>
        <p>Vul hier u gegevens in</p>
        <form method="post">
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
        <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Opslaan!">                    
        </form>

</body>
