<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/Image.php";

$db = new DbClass();
$acc = new Account();

if (isset($_POST['change_email'])) {
    $user_id = $_SESSION['account_id'];
    $email_identifier = $_SESSION['email'];

    $old_email = $_POST['currentEmail'];
    $new_email = $_POST['newEmail'];

    $query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
    $query->execute([':account_id' => $user_id]);

    if ($old_email === "" && $new_email === "") {
        $output['error'] = "Incomplete Details!";
    } else if ($old_email !== $email_identifier) {
        $output['error'] = "Email address does not match!";
    } else if ($new_email === $email_identifier || $new_email === "") {
        $output['error'] = "Please provide new email address!";
    } else if ($query->rowCount() > 0) {
        $query = $db->connect()->prepare("UPDATE account SET email = :email WHERE account_id = :account_id");
        $result = $query->execute([':email' => $new_email, ':account_id' => $user_id]);

        if ($result) {
            $_SESSION['email'] = $new_email;
            $output['success'] = "Email address updated successfully";
        }
    } else if ($query->rowCount() < 0) {
        $output['error'] = "Email address does not match!";
    }

    echo json_encode($output);
}

if (isset($_POST['change_pass'])) {
    $user_id = $_SESSION['account_id'];

    $old_pass = $_POST['currentPass'];
    $new_pass = $_POST['newPass'];
    $reNew_pass = $_POST['newPass2'];
    $encrypted_password = $acc->encrypt_password($new_pass);

    $query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
    $query->execute([':account_id' => $user_id]);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $old_hash = $row['password'];

    if ($query->rowCount() > 0) {
        if ($new_pass !== $reNew_pass) {
            $output['error'] = "Password was not matched!";
        } else if ($old_pass === "" && $new_pass === "" && $reNew_pass === "") {
            $output['error'] = "Incomplete Details!";
        } else {
            if (!password_verify($old_pass, $old_hash)) {
                $output['error'] = "Incorrect password! Please try again.";
            } else if (password_verify($old_pass, $old_hash)) {
                $query = $db->connect()->prepare("UPDATE account SET password = :password WHERE account_id = :account_id");
                $result = $query->execute([':password' => $encrypted_password, ':account_id' => $user_id]);

                if ($result) {
                    $output['success'] = "Password has been changed.";
                }
            }
        }
    }
    echo json_encode($output);
}

if (isset($_POST['fetch_user'])) {
    $user_id = $_SESSION['account_id'];

    $query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
    $query->execute([':account_id' => $user_id]);
    $data = array();

    //  if ($query) {
    //     $row = mysqli_fetch_assoc($query);
        
    //     // Check if the row was fetched successfully
    //     if ($row) {
    //         $data['username'] = $row['username'];
    //         $data['address'] = $row['address'];
    //         $data['imageProfile'] = $row['imageProfile'];

    //         $_SESSION['username'] = $data['username'];
    //         $_SESSION['address'] = $data['address'];
    //         $_SESSION['imageProfile'] = $data['imageProfile'];
    //     }
    // }

    foreach ($query as $row) {
        $data['username'] = $row['username'];
        $data['address'] = $row['address'];
        $data['user_image'] = $row['user_image'];
    }
    $_SESSION['username'] = $data['username'];
    $_SESSION['address'] = $data['address'];
    $_SESSION['user_image'] = $data['user_image'];
    if ($data['user_image'] != "") {
        $_SESSION['user_image'] = $data['user_image']; 
    }
    
  
    echo json_encode($data);
}

if (isset($_POST['update_profile'])) {
    $user_id = $_SESSION['account_id'];
    $type = $_POST['type'];
    
    if ($type == "username") {
        $new_username = $_POST['new_username'];
        $query = $db->connect()->prepare("SELECT * FROM account WHERE username = :username");
        $query->execute([':username' => $new_username]);

        if ($query->rowCount() > 0) {
            $output['error'] = "Username already exist!";
        }
        else if ($_SESSION['username'] != $new_username) {
            $query = $db->connect()->prepare("UPDATE account SET username = :username WHERE account_id = :user_id");
            $result = $query->execute([':username' => $new_username, ':user_id' => $user_id]);

            if ($result) {
                $_SESSION['username'] = $new_username;
                $output['success'] = "Username updated successfully!";
            } else {
                $output['error'] = "Something went wrong! Please try again later.";
            }
        } else if ($new_username == "") {
            $output['error'] = "Please input some details!";
        } else {
            $output['error'] = "No changes have been made";
        }
    } else {
        $new_profile = $_FILES['new_profile']['tmp_name'];
        $new_address = $_POST['new_address'];

        if ($_SESSION['user_image'] != $new_profile || $_SESSION['address'] != $new_address) {
            $image_link = $new_profile;
            if ($new_profile != $_SESSION['user_image']) {
            $upload_image = new Image();
            $data = $upload_image->upload_image($new_profile, $user_id, "egawa/user/");
            $image_link = "v" . $data['version'] . "/" . $data['public_id'];
            }

            $query = $db->connect()->prepare("UPDATE account SET user_image = :new_profile, address = :new_address WHERE account_id = :user_id");
            $result = $query->execute([':new_profile' => $image_link, ':new_address' => $new_address, ':user_id' => $user_id]);
            if($result) {
                $_SESSION['user_image'] = $image_link;
                $_SESSION['address'] = $new_address;
                $output['success'] = "Your profile has been updated";
            } else {
                $output['error'] = "Something went wrong! Please try again later.";
            }
        } else if ($new_address == "") {
            $output['error'] = "Please input some details!";
        } else {
            $output['error'] = "No changes have been made";
        }
    }
    echo json_encode($output);
}
?>