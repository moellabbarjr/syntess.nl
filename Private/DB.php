<?php
class DB
{
    public function connect()
    {
        $dns = 'mysql:host=127.0.0.1;dbname=syntess.nl';
        $user = 'root';
        $pass = '';

        return new PDO($dns, $user, $pass);
    }
}
