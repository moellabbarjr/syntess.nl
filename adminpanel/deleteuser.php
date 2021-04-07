<?php 
  include("../layout/header.php");
  include("../Private/Functions.php");


switch($_SESSION['role']){
    case NULL:
        break;
    case "1":
    case "2":
    case "3":
        $user = (new User)->deleteuser($_GET['user_id']);
        
        header("location: user_overzicht.php");
}