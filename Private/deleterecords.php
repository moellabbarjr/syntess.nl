<?php 
   include("../layout/header.php");
   include("Functions.php");
   
   $user = (new User)->deleterecords($_GET['uren_id']);
   header("location:overzicht.php");
?>