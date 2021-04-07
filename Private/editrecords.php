<?php
    include("../layout/header.php");
    include("Private/Functions.php");

    $deny = false;
    switch($_SESSION['role']){
        case NULL:
            $deny = true;
            echo("Uw heeft niet de rechten om dit te zien, over 3 seconden word u teruggestuurd naar uw dashboard.");
            header("refresh:3;url=../index.php");
            break;
    }
    if($deny == false){

        $Records = (new User)->getRecordsById($_GET["uren_id"]);
        if(isset($_POST['submit'])){
            $Datum = htmlspecialchars($_POST['datum']);
            $taak = htmlspecialchars($_POST['taak']);
            $uren = htmlspecialchars($_POST['uren']);
            $omschrijving = htmlspecialchars($_POST['omschrijving']);
            if((new User)->updaterecords($Records['uren_id'],$Datum,$taak,$uren,$omschrijving)){
            }
            else{
                echo "Er ging iets fout met het aanpassen van de gebruiker, probeer het later nog eens.";
        }
    }
?>
  <nav>
    <ul>
      <li><a class="active" href="overzicht.php">Overzicht</a></li>
      <li><a href="tijdschrijven.php">Tijdschrijven</a></li>
      <li><a href="loguit.php">Loguit</a></li>
    </ul>
  </nav>
<h2 class="h2_text">Uren wijzigen</h2>
<div class="container">
    <div class="roles">
        <a href="overzicht.php"><button class="btn btn-warning goBack">Ga Terug</button><a>
    </div>
    <br>
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
            <th>Datum;</th>
            <th>Taak:</th>
            <th>Uren:</th>
            <th>Omschrijving:</th>
            <th>Opslaan:</th>
        </tr>
        </thead>
        <tbody>
        <form method="POST">
            <tr>
             
                <td><input value="<?= $Records['datum']?>" name="datum" type="text" ></td>
                <td><input value="<?= $Records['taak']?>"name="taak" type="text" ></td>
                <td><input value="<?= $Records['uren']?>"name="uren" type="text" ></td>
                <td><input value="<?= $Records['omschrijving']?>"name="omschrijving" type="text" ></td>
                <?php
                    echo'<td><button name="submit" class="btn btn-success"></a>Opslaan</button></td>';
                 ?>
            </tr>
        </form>
        </tbody>
    </table>
</div>
<?php
} 
?>
