<?php
    include("../layout/header.php");
    include("../Private/User.php");

    $deny = false;
    switch($_SESSION['role']){
        case NULL:
            $deny = true;
            echo("Uw heeft niet de rechten om dit te zien, over 3 seconden word u teruggestuurd naar uw dashboard.");
            header("refresh:3;url=../index.php");
            break;
    }

    if($deny == false){

        $user = (new User)->getUserById($_GET["user_id"]);
        if(isset($_POST['submit'])){
            $email = htmlspecialchars($_POST['email']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $role = htmlspecialchars($_POST['role']);
            if((new User)->updateUser($user['user_id'],$email,$firstname,$lastname,$role)){
            }else{
                echo "Er ging iets fout met het aanpassen van de gebruiker, probeer het later nog eens.";
        }
    }
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
<h2 class="h2_text">User wijzigen</h2>


<div class="container">
    <div class="roles">
        <a href="user_overzicht.php"><button class="btn btn-warning goBack">Ga Terug</button><a>
    </div>
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
            <th>Email adres</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Role</th>
            <th>Opslaan</th>
        </tr>
        </thead>
        <tbody>
        <form method="POST">
            <tr>
                <td><input value="<?= $user['email']?>" name="email" type="text" ></td>
                <td><input value="<?= $user['first_name']?>"name="firstname" type="text" ></td>
                <td><input value="<?= $user['last_name']?>"name="lastname" type="text" ></td>
                <td><input value="<?= $user['role']?>"name="role" type="number" ></td>
                <?php
                    echo'<td><button name="submit" class="btn btn-success"></a>Opslaan</button></td>';
                 ?>
            </tr>
        </form>
        </tbody>
    </table>
</div>
<?php
} 
?>
