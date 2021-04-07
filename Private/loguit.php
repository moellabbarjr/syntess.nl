<?php
$logged_out = FALSE;

if ($logged_out = TRUE){ 
    session_start();
    unset($_SESSION["sessionid"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["role"]);
    unset($_SESSION["job_role"]);
    unset($_SESSION["first_name"]);
  
    echo "<p style= 'padding-top: 25px ; width:100%; font-size: 25px; text-align: center;'> U bent succesvol uitgelogd. <br> Fijne dag " . "</p>";
    header("refresh:1.3;url=../index.php");
    die();
    
}else{
    echo 'Er is wat fout gegaan, probeer het later opnieuw!';
}
?>


    