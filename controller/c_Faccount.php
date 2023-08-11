<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$acc = new Account();

if (isset($_POST['change_email'])) {
    $email_identifier = $_SESSION['email'];

    $old_email = $_POST['currentEmail'];
    $new_email = $_POST['newEmail'];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email_identifier'");

    if ($old_email === "" && $new_email === "") {
        $output['error'] = "Incomplete Details!";
    } else if ($old_email !== $email_identifier) {
        $output['error'] = "Email address does not match!";
    } else if ($new_email === $email_identifier || $new_email === "") {
        $output['error'] = "Please provide new email address!";
    } else if ($sql->num_rows > 0) {
        $stmt = $con->prepare("UPDATE account SET email = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_email, $old_email);
        $stmt->execute();

        if ($stmt) {
            $stmt1 = $con->prepare("UPDATE profile SET email = ? WHERE email = ?");
            $stmt1->bind_param("ss", $new_email, $old_email);
            $stmt1->execute();

            if ($stmt1) {
                $stmt2 = $con->prepare("UPDATE catalog SET email = ? WHERE email = ?");
                $stmt2->bind_param("ss", $new_email, $old_email);
                $stmt2->execute();

                if ($stmt2) {
                    $_SESSION['email'] = $new_email;
                    $output['success'] = "Email address updated successfully";
                }
            }
        }
    } else if ($sql->num_rows < 0) {
        $output['error'] = "Email address does not match!";
    }
    echo json_encode($output);
}

if (isset($_POST['change_password'])) {
    $email_identifier = $_SESSION['email'];

    $old_pass = $_POST['currentPass'];
    $new_pass = $_POST['newPass'];
    $reNew_pass = $_POST['newPass2'];
    $encrypted_password = $acc->encrypt_password($new_pass);

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email_identifier'");
    $row = mysqli_fetch_assoc($sql);
    $old_hash = $row['password'];
    if ($sql->num_rows > 0) {
        if ($new_pass !== $reNew_pass) {
            $output['error'] = "Password was not matched!";
        } else if ($old_pass === "" && $new_pass === "" && $reNew_pass === "") {
            $output['error'] = "Incomplete Details!";
        } else {
            if (!password_verify($old_pass, $old_hash)) {
                $output['error'] = "Incorrect password! Please try again.";
            } else if (password_verify($old_pass, $old_hash)) {
                $stmt = $con->prepare("UPDATE account SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $encrypted_password, $email_identifier);
                $stmt->execute();

                if ($stmt) {
                    $output['success'] = "Password has been changed.";
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
?>