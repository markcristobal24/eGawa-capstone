<?php
session_start();

class DbClass
{
    public $dbHost = "sql6.freemysqlhosting.net";

    public $dbUser = "sql6641111";

    public $dbPassword = "mVxhuxRvXd";
    public $dbName = "sql6641111";


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