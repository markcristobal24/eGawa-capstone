<?php
session_start();

class DbClass
{
    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "egawa";
    public $con;

    function connect()
    {
        try {
            $con = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPassword);
            return $con;
        } catch (PDOException $e) {
            echo "Database Connection Failed: " . $e->getMessage();
        }
    }
}
?>