<?php


    if (!isset($_SESSION)) {
        session_start();
    }

    // spl_autoload_register(function ($class) {
    //   require $_SERVER['DOCUMENT_ROOT'] . '/Classes/' . $class . '.php';
    // });
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!-- Bootstrap core CSS -->
<link href="style/bootstrap.css" rel="stylesheet">

  <title>Syntess portaal</title>

</head>
<body>
  <nav>
    <div class="links">
      <p class="home_text_nav">Syntess Portaal</p>
    </div>
  </nav>
</body>
  