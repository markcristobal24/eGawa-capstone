<?php
// session_start();
require_once dirname(__FILE__) . "/DbClass.php";
require_once dirname(__FILE__) . "/Email.php";

class Account extends DbClass
{
    /* Saves all information in $_SESSION variable */
    public function fetch_account($email)
    {
        $result1 = $query = $this->connect()->prepare("SELECT * FROM account WHERE email = :email");
        $query->execute([':email' => $email]);
        $data = array();
        foreach ($result1 as $row) {
            $data['account_id'] = $row['account_id'];
            $data['username'] = $row['username'];
            $data['email'] = $row['email'];
            $data['firstName'] = $row['firstName'];
            $data['middleName'] = $row['middleName'];
            $data['lastName'] = $row['lastName'];
            $data['userType'] = $row['userType'];
            $data['address'] = $row['address'];
        }
        $_SESSION['account_id'] = $data['account_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['firstName'] = $data['firstName'];
        $_SESSION['middleName'] = $data['middleName'];
        $_SESSION['lastName'] = $data['lastName'];
        $_SESSION['userType'] = $data['userType'];
        if ($data['address'] != "") {
            $_SESSION['address'] = $data['address'];
        }
        json_encode($data);
    }

    public function fetch_profile($email)
    {
        $result = $query = $this->connect()->prepare("SELECT * FROM profile WHERE email = :email");
        $query->execute([':email' => $email]);
        $data = array();
        foreach ($result as $row) {
            $data['profileID'] = $row['profileID'];
            $data['imageProfile'] = $row['imageProfile'];
            $data['jobRole'] = $row['jobRole'];
            $data['address'] = $row['address'];
            $data['companyName'] = $row['companyName'];
            $data['workTitle'] = $row['workTitle'];
            $data['startDate'] = $row['startDate'];
            $data['endDate'] = $row['endDate'];
        }
        $_SESSION['profileID'] = $data['profileID'];
        $_SESSION['imageProfile'] = $data['imageProfile'];
        $_SESSION['jobRole'] = $data['jobRole'];
        $_SESSION['address'] = $data['address'];
        $_SESSION['companyName'] = $data['companyName'];
        $_SESSION['workTitle'] = $data['workTitle'];
        $_SESSION['startDate'] = $data['startDate'];
        $_SESSION['endDate'] = $data['endDate'];
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
            $output['success'] = "Catalog Deleted Successfully";
        } else {
            $output['error'] = 'Something went wrong! Please try again later.';
        }
        echo json_encode($output);
    }

    public function encrypt_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
?>