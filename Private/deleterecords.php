<?php 
   include("../layout/header.php");
   include("Private/Functions.php");


switch($_SESSION['role']){
    case NULL:
        break;
    case "1":
    case "2":
    case "3":
        $user = (new User)->deleterecords($_GET['uren_id']);
        header("location:overzicht.php");
}