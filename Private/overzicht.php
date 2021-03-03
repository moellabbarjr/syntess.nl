<?php
  include("../layout/header.php");
  if (!isset($_SESSION)) {
    session_start();
}

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


<div class="container container-center">
    <div class="loginCard">
    <div class="title">
          <p>Overzicht uren</p>
        </div>
       
        </div>
    </div>