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
            // $data['address'] = $row['address'];
            $data['barangay'] = $row['barangay'];
            $data['municipality'] = $row['municipality'];
            $data['province'] = $row['province'];
            $data['user_image'] = $row['user_image'];
            $data['profileStatus'] = $row['profileStatus'];
            $data['status'] = $row['status'];
        }
        $_SESSION['account_id'] = $data['account_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['firstName'] = $data['firstName'];
        $_SESSION['middleName'] = $data['middleName'];
        $_SESSION['lastName'] = $data['lastName'];
        $_SESSION['userType'] = $data['userType'];
        $_SESSION['profileStatus'] = $data['profileStatus'];
        $_SESSION['status'] = $data['status'];
        // if ($data['barangay'] != "" && $data['municipality'] != "" && $data['province'] != "") {
        $_SESSION['barangay'] = $data['barangay'];
        $_SESSION['municipality'] = $data['municipality'];
        $_SESSION['province'] = $data['province'];
        // }
        if ($data['user_image'] != "") {
            $_SESSION['user_image'] = $data['user_image'];
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
            // $data['address'] = $row['address'];
            $data['barangay'] = $row['barangay'];
            $data['municipality'] = $row['municipality'];
            $data['province'] = $row['province'];
            // $data['companyName'] = $row['companyName'];
            // $data['workTitle'] = $row['workTitle'];
            // $data['startDate'] = $row['startDate'];
            // $data['endDate'] = $row['endDate'];
        }
        $_SESSION['profileID'] = $data['profileID'];
        $_SESSION['imageProfile'] = $data['imageProfile'];
        $_SESSION['jobRole'] = $data['jobRole'];
        // $_SESSION['address'] = $data['address'];
        if ($data['barangay'] != "" && $data['municipality'] != "" && $data['province'] != "") {
            $_SESSION['barangay'] = $data['barangay'];
            $_SESSION['municipality'] = $data['municipality'];
            $_SESSION['province'] = $data['province'];
        }
        // $_SESSION['companyName'] = $data['companyName'];
        // $_SESSION['workTitle'] = $data['workTitle'];
        // $_SESSION['startDate'] = $data['startDate'];
        // $_SESSION['endDate'] = $data['endDate'];
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
            $query = $this->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
            $query->execute([
                ':account_id' => $_SESSION['account_id'],
                ':event' => 'Deleted Catalog',
                ':user_type' => 'freelancer'
            ]);
        } else {
            $output['error'] = 'Something went wrong! Please try again later.';
        }
        echo json_encode($output);
    }

    public function encrypt_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function apply_email($link, $notice, $button_value)
    {
        return '
        <body style="font-family: Roboto, sans-serif; font-size: 18px; text-align: center; background-image: linear-gradient(to right, #0073aa, #8000aa); margin: 0; padding: 0;">

    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: middle;">
                <table style="margin: 0 auto; padding: 50px 20px 80px 20px;">
                    <tr>
                        <td>
                            <img src="https://res.cloudinary.com/dm6aymlzm/image/upload/v1697954310/egawa/ujfq6udnex6nykzzysah.png" style="height: 150px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table
                                style="background-color: white!important; border-radius: 20px; padding: 100px 20px; width: 500px;">
                                <tr>
                                    <td style="color: black!important;">
                                        ' . $notice . '
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <button type="button" style="width: 100%; margin: 20px 0; font-weight: 600px;  font-size: 18px;padding: 20px 0; border-radius: 10px;border:none;background-image: linear-gradient(to right, #0073aa, #8000aa); color: white;"> <a style ="color: white; text-decoration: none" href="' . $_SERVER['SERVER_NAME'] . dirname(pathinfo($_SERVER['REQUEST_URI'], PATHINFO_DIRNAME), 1) . $link . '">' . $button_value . '</a></button>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 15px; padding-top: 5px; color: white;">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> eGawa. All Rights Reserved.
                        </td>
                    </tr>
                    <tr>
                        <td style="opacity: 0;">
                            <script>
                                document.write(Date.now())
                            </script>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </body>
        ';
    }

    public function deny_email($notice)
    {
        return '
        <body style="font-family: Roboto, sans-serif; font-size: 18px; text-align: center; background-image: linear-gradient(to right, #0073aa, #8000aa); margin: 0; padding: 0;">

    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: middle;">
                <table style="margin: 0 auto; padding: 50px 20px 80px 20px;">
                    <tr>
                        <td>
                            <img src="https://res.cloudinary.com/dm6aymlzm/image/upload/v1697954310/egawa/ujfq6udnex6nykzzysah.png" style="height: 150px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table
                                style="background-color: white!important; border-radius: 20px; padding: 100px 20px; width: 500px;">
                                <tr>
                                    <td style="color: black!important;">
                                        ' . $notice . '
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 15px; padding-top: 5px; color: white;">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> eGawa. All Rights Reserved.
                        </td>
                    </tr>
                    <tr>
                        <td style="opacity: 0;">
                            <script>
                                document.write(Date.now())
                            </script>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </body>
        ';
    }

    public function generateTransactionID()
    {
        $query = $this->connect()->prepare("SELECT MAX(application_id) as max_id FROM job_application");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $maxId = $row['max_id'];

        $nextId = $maxId + 1;
        $transactionId = 'T' . str_pad($nextId, 10, '0', STR_PAD_LEFT);

        return $transactionId;
    }
}
