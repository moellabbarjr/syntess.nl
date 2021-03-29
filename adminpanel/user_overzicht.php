<?php
  include("../layout/header.php");
  include("../Private/User.php");

  $records = (new User)->getAllusers();

  $deny = false;
  switch($_SESSION['role']){
      case NULL:
          $deny = true;
          echo("Uw heeft niet de rechten om dit te zien, over 3 seconden word u teruggestuurd naar de inlog pagina.");
          header("refresh:3;url=../index.php");
          break;
  }

  if($deny == false){
  ?>

<body>
  <nav>
    <ul>
      <li><a href="Admindash.php">Dashboard</a></li>
      <li><a href="sign-up.php">User aanmaken</a></li>
      <li><a class="active" href="user_overzicht.php">User overzicht</a></li>
      <li><a href="../Private/loguit.php">Loguit</a></li>
    </ul>
  </nav>
</body>

<h2 class="h2_text">User overzicht</h2>
<div class="container">
  <div class="searchdiv">
        <form method="GET" action="searchedUser.php">
            <input type="text" placeholder="Zoeken..." class="searchbar" name="search"><button class="btn btn-primary search-btn" name="submit">Zoeken</button>
        </form>
    </div>
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
            <th>User ID:</th>
            <th>Email:</th>
            <th>Voornaam:</th>
            <th>Achternaam:</th>
            <th>Role:</th>
            <th>Aanpassen:</th>
            <th>Verwijderen:</th>
        </tr>
        </thead>
        <tbody>
          <?php 
              foreach ($records as $record) {
                  echo '<tr>';
                  echo '<th scope="row">' . $record["user_id"] . '</th>';
                  echo '<th>' . $record["email"] . '</th>';
                  echo '<th>' . $record["first_name"] . '</th>';
                  echo '<th>' . $record["last_name"] . '</th>';
                  echo '<th>' . $record["role"] . '</th>';
                  echo '<td><button type="button" class="btn btn-info"><a href="edituser.php?user_id=' . $record["user_id"] . '">Aanpassen</a></button></td>';
                  echo '<td><button type="button" class="btn btn-danger"><a href="deleteuser.php?user_id=' . $record["user_id"] . '">Verwijderen</a></button></td>';
                  echo '</tr>';
                }
            ?>
        </tbody>
    </table>

</div>
<?php
} 
?>
