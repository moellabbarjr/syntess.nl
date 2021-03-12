<?php
  include("../layout/header.php");
  include("../Private/User.php");
  if (!isset($_SESSION)) {
    session_start();
  }
  if(!$_SESSION['first_name']){
    $deny = true;
    echo("Er is iets fout gegaan met het inloggen, probeer het opnieuw. U word over 5 seconden terug gestuurd.");
    header("refresh:5;url=login.php");
  }

$records = (new User)->getAllrecords();
$deny = false;
switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Er is iets fout gegaan met het inloggen, probeer het opnieuw. U word over 5 seconden terug gestuurd.");
        header("refresh:6;url=login.php");
        break;
    case "user":
    case "user":
        $deny = true;
        echo("Over 5 seconden word u teruggestuurd naar uw overzicht.");
        header("refresh:5;url=overzicht.php");
        break;
}

if($deny == false){

?>


<body>
  <nav>
    <ul>
      <li><a class="active" href="overzicht.php">Overzicht</a></li>
      <li><a href="tijdschrijven.php">Tijdschrijven</a></li>
      <li><a href="loguit.php">Loguit</a></li>
    </ul>
  </nav>
</body>
<p class="welcomeUserMessage"> Welkom <?=$_SESSION['first_name']?></p>

<h2 class="h2_text">Urenoverzicht</h2>


<div class="container">
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>

            <th>Datum:</th>
            <th>Taak:</th>
            <th>Uren:</th>
            <th>Omschrijving:</th>
            <th>Optie</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($records as $record) {
                echo '<tr>';
                echo '<th scope="row">' . $record["datum"] . '</th>';
                echo '<th>' . $record["taak"] . '</th>';

                echo '<th>' . $record["uren"] . '</th>';
                echo '<th>' . $record["omschrijving"] . '</th>';
                echo '<td>
                <button type="button" class="btn btn-danger"><a href="deleteUser.php?user_id=' . $record["user_id"] . '">Verwijderen</a></button>
                    </td>';
                echo '</tr>';
              }
        ?>
        </tbody>
    </table>

</div>
<?php
}
?>