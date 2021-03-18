<?php
  include("../layout/header.php");
  include("../Private/User.php");
  if (!isset($_SESSION)) {
    session_start();
  }

  $deny = false;
switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Uw heeft niet de rechten om dit te zien, over 3 seconden word u teruggestuurd naar uw dashboard.");
        header("refresh:3;url=../index.php");
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
<div class="welkomadmin">
  <?php echo "Welkom terug " . $_SESSION['first_name'];?> <br>
</div>
<?php
} 
?>
