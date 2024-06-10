<?php

namespace tours;
use PDO;

class DatabaseConnection
{
    private $connection;

    public function __construct($host = "localhost", $port = 3306, $username = "root", $pass = "", $db = "testovanie")
    {
        try {
            $this->connection = new PDO('mysql:charset=utf8;host=' . $host . ';dbname=' . $db . ";port=" . $port, $username, $pass);
        } catch (PDOException $exception) {
            echo "Chyba! Podrobnejsie: " . $exception->getMessage();
            die();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>
