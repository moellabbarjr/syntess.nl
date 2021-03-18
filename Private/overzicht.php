<?php
  include("../layout/header.php");
  include("../Private/User.php");
  if (!isset($_SESSION['first_name'])) {
    
  }
  $records = (new User)->getAllrecords();
  
  $deny = false;
  switch($_SESSION['role']){
  case NULL:
      $deny = true;
      echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
      header("refresh:5;url=../index.php");
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
<div class="welkommes">
  <?php echo "Welkom terug " . $_SESSION['first_name'];?> <br>
</div>
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
                  echo '<td><button type="button" class="btn_del"><a href="deleterecords.php?uren_id=' . $record["uren_id"] . '">Verwijderen</a></button></td>';
                  echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<?php
} 
?>

