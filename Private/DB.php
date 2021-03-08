<?php
class DB
{
    public function connect()
    {
        $dns = 'mysql:host=127.0.0.1;dbname=syntess.nl';
        $user = 'root';
        $pass = '';

       try{
           $conn = new PDO ($dns, $user, $pass);
           return $conn;
       }catch (PDOException $e) {
           echo "Er is een fout met de verbinding: " . $e->getMessage();
       }
    }
}
