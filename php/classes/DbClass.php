<?php
session_start();

class DbClass
{
    //SQL HOSTING
    public $dbHost = "localhost";

    public $dbUser = "u673355866_egawa";

    public $dbPassword = "FJ88^&(*sdhf&@h8";

    public $dbName = "u673355866_egawa";

    // XAMPP HOSTING
    // public $dbHost = "localhost";
    // public $dbUser = "root";
    // public $dbPassword = "";
    // public $dbName = "egawa";


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