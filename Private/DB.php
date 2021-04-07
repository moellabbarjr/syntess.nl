<?php
class DB
{
    public function connect()
    {
        $dns = 'mysql:host=remotemysql.com;dbname=g7swBLPeOv';
        $user = 'g7swBLPeOv';
        $pass = '47VWYtxMOW';

       try{
           $conn = new PDO ($dns, $user, $pass);
           return $conn;
       }catch (PDOException $e) {
           echo "Er is een fout met de verbinding: " . $e->getMessage();
       }
    }
}
