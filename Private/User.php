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
                $stmt = $conn->prepare("INSERT INTO user (email, first_name, last_name, `password`,`job_role`, role) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$email, $firstname, $lastname, $hash, 99, 1]);
                header("Location: Admindash.php");
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
                    $_SESSION["job_role"] = $result[0][6];
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
    public function insert($user_id, $taak, $uren, $omschrijving, $Datum){
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("INSERT INTO urenschrijven (user_id, datum, taak, uren, omschrijving) VALUES (:user_id, :datum, :taak, :uren, :omschrijving) ");
            $stmt->bindparam(":user_id", $user_id);
            $stmt->bindparam(":taak", $taak);
            $stmt->bindparam(":uren", $uren);
            $stmt->bindparam(":omschrijving", $omschrijving);
            $stmt->bindparam(":datum", $Datum);
            $stmt->execute();       
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

    public function getUserById($id) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("SELECT * FROM user WHERE user_id  = ?");
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
}




?>