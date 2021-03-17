<?php
  include("../layout/header.php");
  include("../Private/User.php");

  $records = (new User)->getAllusers();
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
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
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
                  echo '<th scope="row">' . $record["email"] . '</th>';
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

