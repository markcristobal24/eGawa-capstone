<?php
session_start();

class DbClass
{
    //SQL HOSTING
    // public $dbHost = "localhost";

    // public $dbUser = "u673355866_egawa";

    // public $dbPassword = "FJ88^&(*sdhf&@h8";

    // public $dbName = "u673355866_egawa";

<<<<<<< HEAD
    // XAMPP HOSTING
    // public $dbHost = "localhost";
    // public $dbUser = "root";
    // public $dbPassword = "";
    // public $dbName = "egawa";
=======
    //XAMPP HOSTING
    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "egawa";
>>>>>>> 6fcab1c05cecc4e8d33584f012e00a017f1dd083


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