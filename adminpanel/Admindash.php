<?php
  include("../layout/header.php");
  include("../Private/Functions.php");
  if (!isset($_SESSION)) {
    session_start();
  }
  $records = (new User)->getAllrecords();
  $deny = false;
  switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Uw heeft niet de rechten om dit te zien, over 3 seconden word u teruggestuurd naar uw dashboard.");
        header("refresh:0;url=../index.php");
        break;
  }
if($deny == false){
?>
<body>
  <nav>
    <ul>
        <li><a class="active" href="Admindash.php">Dashboard</a></li>
        <li><a href="sign-up.php">User aanmaken</a></li>
        <li><a href="user_overzicht.php">User overzicht</a></li>
        <li><a href="../Private/loguit.php">Loguit</a></li>
    </ul>
  </nav>
</body>
<div class="welkommes">
  <?php echo "Welkom terug " . $_SESSION['first_name'];?> <br>
</div>
<h2 class="h2_text">Uren overzicht</h2>
<div class="container">
    <br>
    <table class="table table-striped table-responsive-md btn-table">
      <thead>
      <tr>
          <th>User ID:</th>
          <th>Datum:</th>
          <th>Taak:</th>
          <th>Uren:</th>
          <th>Omschrijving:</th>
          <th>Verwijderen</th>
      </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($records as $record) {
              echo '<tr>';
              echo '<th scope="row">' . $record["user_id"] . '</th>';
              echo '<th>' . $record["datum"] . '</th>';
              echo '<th>' . $record["taak"] . '</th>';
              echo '<th>' . $record["uren"] . '</th>';
              echo '<th>' . $record["omschrijving"] . '</th>';
              echo '<td><button type="button" class="btn btn-danger"><a href="deleterecord.php?uren_id=' . $record["uren_id"] . '">Verwijderen</a></button></td>';
              echo '</tr>';
            }
        ?>
      </tbody>
    </table>
</div>
<?php
} 
?>
