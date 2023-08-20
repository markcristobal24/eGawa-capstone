<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();

if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $email]);
    if ($query->rowCount() > 0) {
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $fetch_password = $fetch['password'];
    }
    

    if ($email == "" && $password == "") {
        $output['error'] = "Incomplete Details!";
    } else if ($email == "") {
        $output['error'] = "Please enter your email address!";
    } else if ($password == "") {
        $output['error'] = "Please enter your password!";
    } else if ($query->rowCount() == 0) {
        $output['error'] = "Email Address do not exist!";
    } else if (!password_verify($password, $fetch_password) || $email !== $fetch['email']) {
        $output['error'] = "Email address and password are not matched!";
    } else if (password_verify($password, $fetch_password)) {
        if ($fetch["userType"] == 'super_admin') {
            $output['success'] = "super_admin";
            $output['message'] = "Logging in as Super Admin";
        } else if ($fetch["userType"] == 'user') {
            $output['success'] = "user";
            if ($fetch["status"] == 0) {
                $verifyEmail = new Email();
                $otp = $verifyEmail->generate_code();
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                $_SESSION['email'] = $email;
                $_SESSION['userType'] = $fetch["userType"];
                $_SESSION['account_id'] = $fetch['account_id'];
                $body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";
                $subject = "Your verification code";
                $verifyEmail->sendEmail("E-Gawa", $email, $subject, $body);
                $output['status'] = "0";
                $output['message'] = "Please verify your email address first. Redirecting...";
            } else if ($fetch['status'] == 1) {
                //rekta login
                // $session = new Account();
                // $session->fetch_information($email);
                $session = new Account();
                $session->fetch_account($email);
                $output['status'] = "1";
                $output['message'] = "Logging in as " . $fetch['firstName'];

            }
        } else if ($fetch["userType"] == 'freelancer') {
            $output['success'] = "freelancer";
            if ($fetch["status"] == 0) {
                $verifyEmail = new Email();
                $otp = $verifyEmail->generate_code();
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                $_SESSION['email'] = $email;
                $_SESSION['account_id'] = $fetch['account_id'];
                $body = "<p>Dear user, </p>
<h3>Your verification code is $otp</h3>
<br><br>
<p>With Regards,</p>
<b>eGawa</b>";
                $subject = "Your verification code";
                $verifyEmail->sendEmail("E-Gawa", $email, $subject, $body);
                $output['status'] = "0";
                $output['message'] = "Please verify your email address first. Redirecting...";
            } else if ($fetch["status"] == 1 && $fetch["profileStatus"] == 0) {
                $_SESSION['email'] = $email;
                // $session = new Account();
                // $session->fetch_information($email);
                $output['status'] = "10";
                $output['message'] = "Please create your profile first. Redirecting...";

            } else if ($fetch["status"] == 1 && $fetch["profileStatus"] == 1) {
                //$_SESSION['email'] = $email;
                // $_SESSION['account_id'] = $fetch['account_id'];
                $session = new Account();
                $session->fetch_account($email);
                $session->fetch_profile($email);
                $output['status'] = "11";
                $output['message'] = "Logging in as " . $fetch['firstName'];
            }
        }
    }

    echo json_encode($output);
}
?>