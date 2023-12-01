<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$acc = new Account();
$db = new DbClass();
date_default_timezone_set('Asia/Manila');
$currentDateTime = date("Y-m-d H:i");

if (isset($_POST['change_email'])) {
    $email_identifier = $_SESSION['email'];

    $old_email = $_POST['currentEmail'];
    $new_email = $_POST['newEmail'];

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $email_identifier]);

    if ($old_email === "" && $new_email === "") {
        $output['error'] = "Incomplete Details!";
    } else if ($old_email !== $email_identifier) {
        $output['error'] = "Email address does not match!";
    } else if ($new_email === $email_identifier || $new_email === "") {
        $output['error'] = "Please provide new email address!";
    } else if ($query->rowCount() < 0) {
        $query = $db->connect()->prepare("UPDATE account SET email = :new_email WHERE email = :old_email");
        $result = $query->execute([':new_email' => $new_email, ':old_email' => $old_email]);

        if ($result) {
            $query = $db->connect()->prepare("UPDATE profile SET email = :new_email WHERE email = :old_email");
            $result = $query->execute([':new_email' => $new_email, ':old_email' => $old_email]);

            if ($result) {
                $query = $db->connect()->prepare("UPDATE catalog SET email = :new_email WHERE email = :old_email");
                $result = $query->execute([':new_email' => $new_email, ':old_email' => $old_email]);

                if ($result) {
                    $_SESSION['email'] = $new_email;
                    $output['success'] = "Email address updated successfully";
                    $output['type'] = $_SESSION['userType'];
                    $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, timestamp, event, user_type) VALUES (:account_id, :timestamp, :event, :user_type)");
                    $query->execute([
                        ':account_id' => $_SESSION['account_id'],
                        ':timestamp' => $currentDateTime,
                        ':event' => 'Change email',
                        ':user_type' => $_SESSION['userType']
                    ]);
                }
            }
        }
    } else if ($query->rowCount() > 0) {
        $output['error'] = "Email address already exist.";
    }
    echo json_encode($output);
}

if (isset($_POST['change_password'])) {
    $email_identifier = $_SESSION['email'];

    $old_pass = $_POST['currentPass'];
    $new_pass = $_POST['newPass'];
    $reNew_pass = $_POST['newPass2'];
    $encrypted_password = $acc->encrypt_password($new_pass);

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $email_identifier]);
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
                $query = $db->connect()->prepare("UPDATE account SET password = :password WHERE email = :email");
                $result = $query->execute([':password' => $encrypted_password, ':email' => $email_identifier]);

                if ($result) {
                    $output['success'] = "Password has been changed.";
                    $output['type'] = $_SESSION['userType'];
                    $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, timestamp, event, user_type) VALUES (:account_id, :timestamp, :event, :user_type)");
                    $query->execute([
                        ':account_id' => $_SESSION['account_id'],
                        ':timestamp' => $currentDateTime,
                        ':event' => 'Change password',
                        ':user_type' => $_SESSION['userType']
                    ]);
                }
            }
        }
    }
    echo json_encode($output);
}

if (isset($_POST['resendOtp'])) {
    $_SESSION['mail'] = $_POST['email'];
    $verifyEmail = new Email();
    $otp = $verifyEmail->generate_code();
    $_SESSION['otp'] = $otp;
    $body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";
    $subject = "Your verification code";

    $verifyEmail->sendEmail("E-Gawa", $_SESSION['mail'], $subject, $body);

    $output['success'] = 'OTP sent successfully';

    echo json_encode($output);
}

if (isset($_POST['id_verification'])) {
    $freelance_id = $_SESSION['account_id'];
    $user_type = $_SESSION['userType'];
    $id_type = $_POST['id_type'];
    $front_id = $_FILES['front_id']['tmp_name'];
    $back_id = $_FILES['back_id']['tmp_name'];
    $id_number = $_POST['id_number'];

    if (empty($front_id) || empty($back_id) || empty($id_number) || $id_type == 'none') {
        $output['error'] = "Please provide all the details!";
    } else {
        $front_link = $front_id;
        if (!empty($front_id)) {
            $front_name = $acc->generate_imageName(6);
            $front_directory = '../img/uploads/freelancer/id/' . $front_name . basename($_FILES['front_id']['name']);
            $front_link = $front_name . basename($_FILES['front_id']['name']);
            move_uploaded_file($front_id, $front_directory);
        }
        $back_link = $back_id;
        if (!empty($back_link)) {
            $back_name = $acc->generate_imageName(6);
            $back_directory = '../img/uploads/freelancer/id/' . $back_name . basename($_FILES['back_id']['name']);
            $back_link = $back_name . basename($_FILES['back_id']['name']);
            move_uploaded_file($back_id, $back_directory);
        }

        $query = $db->connect()->prepare("INSERT INTO id_verification (account_id, id_type, front_image, back_image, id_number, verify_status, user_type, timestamp)
        VALUES (:account_id, :id_type, :front_image, :back_image, :id_number, :verify_status, :user_type, :timestamp)");
        $result = $query->execute([
            ':account_id' => $freelance_id,
            ':id_type' => $id_type,
            ':front_image' => $front_link,
            ':back_image' => $back_link,
            ':id_number' => $id_number,
            ':verify_status' => 'PENDING',
            ':user_type' => $user_type,
            ':timestamp' => $currentDateTime
        ]);

        if ($result) {
            $output['success'] = 'Your id verification has been submitted.';
            $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, timestamp, event, user_type) VALUES (:account_id, :timestamp, :event, :user_type)");
            if ($user_type == 'freelancer') {
                $query->execute([
                    ':account_id' => $_SESSION['account_id'],
                    ':timestamp' => $currentDateTime,
                    ':event' => 'Submitted ID Verification',
                    ':user_type' => 'freelancer'
                ]);
            } else {
                $query->execute([
                    ':account_id' => $_SESSION['account_id'],
                    ':timestamp' => $currentDateTime,
                    ':event' => 'Submitted ID Verification',
                    ':user_type' => 'employer'
                ]);
            }
        } else {
            $output['error'] = "Something went wrong. Please try again.";
        }
    }

    echo json_encode($output);
}
