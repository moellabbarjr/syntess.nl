<?php
session_start();
    unset($_SESSION["sessionid"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["role"]);
    unset($_SESSION["job_role"]);
    unset($_SESSION["name"]);
    echo"<script>alert('15 Minutes over!');</script>";
    header("location: ../index.php");
    
    die();
?>