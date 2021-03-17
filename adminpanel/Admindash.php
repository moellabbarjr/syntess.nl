<?php
  include("../layout/header.php");
  include("../Private/User.php");
  if (!isset($_SESSION)) {
   
  }


 
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
<div class="welkomadmin">
  <?php echo "Welkom terug " . $_SESSION['first_name'];?> <br>
</div>
