<?php
    include("DB.php");

class User
{
    //Function to register a user
    public function register($email,$firstname,$lastname,$password) {
        try{
            $conn = (new DB)->connect();
            $stmt= $conn->prepare("SELECT * FROM `user` WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();
            if (count($result) == 0) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO user (email, first_name, last_name, `password`, role) VALUES (?,?,?,?,?)");
                $stmt->execute([$email, $firstname, $lastname, $hash, 1]);
               
            } else {
                return "false";
                header("sign-up.php");
            } 
        }
        catch(PDOexception $e) {
            echo json_encode([
                'error' => $e->getMessage(), 
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    exit;
    }

    //Function to login a user
    public function login($email,$password){
        try {
            $conn = (new DB)->connect();
            $stmt= $conn->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();
            if (count($result) == 1) {
                if (password_verify($password, $result[0][4])) {
                    $_SESSION["sessionid"] = session_id();
                    $_SESSION["loggedin"] = $result[0][0];
                    $_SESSION["first_name"] = $result[0][2];
                    $_SESSION["role"] = $result[0][5];
                    if ($result[0][5] == 1) {
                        header("Location: Private/overzicht.php");
                    } else if($result[0][5] == 2){
                        header("Location: adminpanel/Admindash.php");
                    }                 
                }
            }
        } catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    exit;
    } 

    //invoeren van gegevens functie
    public function insert($taak, $uren, $omschrijving, $Datum){
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("INSERT INTO urenschrijven (user_id, datum, taak, uren, omschrijving) VALUES (?,?,?,?,?)");
            $stmt->execute([$_SESSION["loggedin"], $Datum, $taak, $uren, $omschrijving]);
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    //functie om alle records weer te geven
    public function getAllrecords() {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->query("SELECT * FROM urenschrijven ORDER BY datum DESC ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;

        }
        catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    public function getAllrecordsbyid() {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->query("SELECT * FROM urenschrijven WHERE user_id ORDER BY datum DESC ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;

        }
        catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

     //Users zoeken functie
    public function searchUser($search) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->query("SELECT * FROM user WHERE email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR role LIKE '%$search%'");
            $result = $stmt->fetchAll();
            $conn = null;
            return $result;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //records zoeken functie
    public function searchRecords($search) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->query("SELECT * FROM urenschrijven WHERE datum LIKE '%$search%' OR omschrijving LIKE '%$search%' OR taak  LIKE '%$search%'");
            $result = $stmt->fetchAll();
            $conn = null;
            return $result;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //functie om alle users op te halen voor de admin
    public function getAllusers() {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->query("SELECT * FROM user");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;
        }
        catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //functie om een records te verwijderen
    public function deleterecords($id){
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("DELETE FROM urenschrijven WHERE uren_id = ? ");
            $stmt->execute([$id]);
            $conn = null;
            return true;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    // functie om een user te verwijderen
    public function deleteuser($id){
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ? ");
            $stmt->execute([$id]);
            $conn = null;
            return true;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //haalt het user_id op van de user
    public function getUserById($id) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            $conn = null;
            return $result;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //Functie om een de user gegevens aan te passen
    public function updateUser($id, $email, $firstName, $lastName, $role) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("UPDATE user SET email=?, first_name=?, last_name=?, role=? WHERE user_id = ? ");
            $stmt->execute([$email, $firstName, $lastName, $role, $id]);
            $conn = null;
            return true;
            header("Location: user_overzicht.php");
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //haalt het uren_id op van de record
    public function getRecordsById($id) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("SELECT * FROM urenschrijven WHERE uren_id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            $conn = null;
            return $result;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    //Functie om een de record gegevens aan te passen
    public function updaterecords($id, $Datum, $taak, $uren, $omschrijving) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("UPDATE urenschrijven SET datum=?, taak=?, uren=?, omschrijving=? WHERE uren_id = ?");
            $stmt->execute([$Datum, $taak, $uren, $omschrijving, $id]);
            $conn = null;
            return true;
            header("Location: overzicht.php");
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),
            ]);
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }
}
?>