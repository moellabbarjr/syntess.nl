<?php
   include("../layout/header.php");
   include("Functions.php");
  if (!isset($_SESSION['first_name'])) {
    
  }
  $search = $_GET['search'];

  $searchedUsers = (new User)->searchRecords($search);
  
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

<h2 class="h2_text">Urenoverzicht</h2>
<div class="container">
<div class="searchdiv">
        <form method="GET" action="searchedRecords.php">
            <input type="text" placeholder="Zoeken..." class="searchbar" name="search"><button class="searchbar_btn" name="submit">Zoeken</button>
        </form>
    </div>
    <br>
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
            <th>Datum:</th>
            <th>Taak:</th>
            <th>Uren:</th>
            <th>Omschrijving:</th>
            <th>Aanpassen</th>
            <th>Verwijderen</th>
        </tr>
        </thead>
        <tbody>
          <?php 
              foreach ($searchedUsers as $searchedUser) {
                  echo '<tr>';
                  echo '<th scope="row">' . $searchedUser["datum"] . '</th>';
                  echo '<th>' . $searchedUser["taak"] . '</th>';
                  echo '<th>' . $searchedUser["uren"] . '</th>';
                  echo '<th>' . $searchedUser["omschrijving"] . '</th>';
                  echo '<td><button type="button" class="btn btn-info"><a href="editrecords.php?uren_id=' . $searchedUser["uren_id"] . '">Aanpassen</a></button></td>';
                  echo '<td><button type="button" class="btn btn-danger"><a href="deleterecords.php?uren_id=' . $searchedUser["uren_id"] . '">Verwijderen</a></button></td>';
                  echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<?php
} 
?>

