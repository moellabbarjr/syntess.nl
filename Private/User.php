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
            $conn = (new DB)->connect();
            $stmt= $conn->prepare("SELECT * FROM user WHERE email = ?");
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


    //uitvoering sql query
    public function runQuery($sql){
      
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    
    //invoeren van gegevens functie
    public function insert($user_id, $taak, $uren, $omschrijving){
        try{
            $stmt = $this->conn->prepare("INSERT INTO urenschrijven (user_id, taak, uren, omschrijving) VALUES (:user_id ,:taak, :uren, :omschrijving) ");
            $stmt->bindparam(":user_id", $user_id);
            $stmt->bindparam(":taak", $taak);
            $stmt->bindparam(":uren", $uren);
            $stmt->bindparam(":omschrijving", $omschrijving);
            $stmt->execute();
            // var_dump($user_id);
            // exit('gaat iets fout');
         
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getrecordsbyid($id) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("SELECT * FROM urenschrijven WHERE user_id = ?");
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


    public function getAllrecords() {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->query("SELECT * FROM urenschrijven");
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
}



?>