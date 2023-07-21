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
            $data['userType'] = $row['userType'];
            $data['username'] = $row['username'];
        }

        $result2 = $query2 = $this->connect()->prepare("SELECT * FROM profile WHERE email = :email");
        $query2->execute([':email' => $email]);
        foreach ($result2 as $row) {
            $data['imageProfile'] = $row['imageProfile'];
        }

        $result3 = $query3 = $this->connect()->prepare("SELECT * FROM catalog WHERE email = :email");
        $query3->execute([':email' => $email]);
        foreach ($result3 as $row) {
            $data['catalog_id'] = $row['catalog_id'];
        }

        $_SESSION['account_id'] = $data['account_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['firstName'] = $data['firstName'];
        $_SESSION['imageProfile'] = $data['imageProfile'];
        $_SESSION['userType'] = $data['userType'];
        $_SESSION['username'] = $data['username'];
        //$_SESSION['catalogId'] = $data['catalog_id'];
        json_encode($data);

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

    public function delete_catalog($catalog_id)
    {
        $query = $this->connect()->prepare("DELETE FROM catalog WHERE catalog_id = :catalog_id");
        $result = $query->execute([':catalog_id' => $catalog_id]);

        if ($result) {
            $output['success'] = "CatalogDeletedSuccessfully";
        } else {
            $output['error'] = 'Something went wrong! Please try again later.';
        }
        echo json_encode($output);
    }
}
?>