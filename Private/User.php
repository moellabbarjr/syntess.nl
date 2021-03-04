<?php

require_once "DB.php";

class User
{
    //Function to register a user
    public function register($email,$firstname,$lastname,$password) {
        try{
            $conn = DB::connect();

            $stmt= $conn->prepare("SELECT * FROM `user` WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();

            if (count($result) == 0) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO user (email, first_name, last_name, `password`,`job_role`, role) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$email, $firstname, $lastname, $hash, 99, 1]);
                header("Location: ../index.php");
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
            $connection = DB::connect();

            $stmt= $connection->prepare("SELECT * FROM `user` WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();
            
            if (count($result) == 1) {
                if (password_verify($password, $result[0][4])) {
                    $_SESSION["sessionid"] = session_id();
                    $_SESSION["loggedin"] = $result[0][0];
                    $_SESSION["role"] = $result[0][5];
                    $_SESSION["job_role"] = $result[0][6];
                    $_SESSION['name'] = $result[0][2];
                    if ($result[0][5] == 1) {
                        header("Location: Private/overzicht.php");
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

    private $conn;

    //contructor
    public function __construct(){
        $database = new DB();
        $db = $database->connect();
        $this->conn = $db;

    }

    //uitvoering sql query
    public function runQuery($sql){
      
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    
    //invoeren van gegevens functie
    public function insert($taak, $uren, $omschrijving){
        try{
            $stmt = $this->conn->prepare("INSERT INTO urenschrijven (taak, uren, omschrijving) VALUES ($taak, $uren, $omschrijving) ");
            $stmt ->bindparam(":taak", $taak);
            $stmt ->bindparam(":uren", $uren);
            $stmt ->bindparam(":omschrijving", $omschrijving);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    //wijzigen van de gegevens
    public function update($taak, $uren, $omschrijving, $user_id){
        try{
            $stmt = $this->conn->prepare("UPDATE urenschrijven SET taak = :taak, email = :email, omschrijving = :omschrijving WHERE 'user_id' = ':user_id' "); 
            $stmt ->bindparam(":taak", $taak);
            $stmt ->bindparam(":uren", $uren);
            $stmt ->bindparam(":omschrijving", $omschrijving);
            $stmt ->bindparam(":user_id", $user_id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    // verwijderen van een unit
    public function delete($user_id){
        try{
            $stmt = $this->conn->prepare("DELETE FROM urenschrijven WHERE user_id = :user_id "); 
            $stmt ->bindparam(":user_id", $user_id);
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function redirect($url){
        header("Location: $url");
    }
}
?>