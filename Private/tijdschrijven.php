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
  <?php require_once '../layout/sidebar.php'; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 style="margin-top: 10px">Tijdschrijven</h1>
        <p>Vul hier u gegevens in</p>
        <form  method="post">
        <div class="form-group">
            <label for="id">Taak:</label>
            <input class="form-control" type="text" name="taak" id="taak" value="">
        </div>
        <div class="form-group">
            <label for="name">Aantal uren:</label>
            <input  class="form-control" type="text" name="uren" id="uren" value="" >
        </div>
        <div class="form-group">
            <label for="email">Omschrijving:</label>
            <input  class="form-control" type="text" name="omschrijving" id="omschrijving" value="">
        </div>
        <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Opslaan!">                    
        </form>
    </main>
</body>
