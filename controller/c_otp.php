<?php

session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";


if (isset($_POST['verify_otp'])) {
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code || $otp_code === "") {
        $output['error'] = "Invalid OTP!";
    }
    else {
        $query = mysqli_query($con, "UPDATE account SET status = 1 WHERE email = '$email'");

        if($query) {
            unset($_SESSION['otp']);
            $output['success'] = "Email verified! Please log in your account.";
        } else {
            $output['error'] = "Something went wrong! Please try again later.";
        }
    }
    echo json_encode($output);
}
?>