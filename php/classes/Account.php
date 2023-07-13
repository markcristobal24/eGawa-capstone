<?php
session_start();
require_once dirname(__FILE__) . "/DbClass.php";

class Account extends DbClass
{
    /* Saves all information in $_SESSION variable */
    public function fetch_information($email)
    {
        $result1 = $query = $this->connect()->prepare("SELECT * FROM account WHERE email = :email");
        $query->execute([':email' => $email]);
        $data = array();
        foreach ($result1 as $row) {
            $data['account_id'] = $row['account_id'];
            $data['username'] = $row['username'];
            $data['email'] = $row['email'];
            $data['firstName'] = $row['firstName'];
        }

        $result2 = $query2 = $this->connect()->prepare("SELECT * FROM profile WHERE email = :email");
        $query2->execute([':email' => $email]);
        foreach ($result2 as $row) {
            $data['imageProfile'] = $row['imageProfile'];
        }

        $_SESSION['account_id'] = $data['account_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['firstName'] = $data['firstName'];
        $_SESSION['imageProfile'] = $data['imageProfile'];
        echo json_encode($data);

    }

    public function generate_imageName($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
?>