<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";


$acc = new Account();
$sendEmail = new Email();

if (isset($_POST['user_register'])) {
    $firstName = $_POST["fName"];
    $middleName = $_POST["mName"];
    $lastName = $_POST["lName"];
    $address = $_POST["address"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST['password2'];
    $usertype = "user";
    $encrypted = $acc->encrypt_password($password);
    $check_query = mysqli_query($con, "SELECT * FROM account where email = '$email'");
    $sql = mysqli_query($con, "SELECT * FROM account WHERE username = '$username'");

    if (
        $firstName === "" || $middleName === "" || $lastName === "" || $address === "" || $username === ""
        || $email === "" || $password === "" || $password2 === ""
    ) {
        $output['error'] = "Incomplete Details!";
    } else if ($password !== $password2) {
        $output['error'] = "Password are not matched!";
    } else if ($check_query->num_rows > 0) {
        $output['error'] = "Email address already exist!";
    } else if ($sql->num_rows > 0) {
        $output['error'] = "Username already exist!";
    } else {
        $result = mysqli_query($con, "INSERT INTO account (firstName, middleName, lastName, address, username, email, password, userType, status) VALUES ('$firstName', '$middleName', '$lastName', '$address', '$username', '$email', '$encrypted', '$usertype', 0)");

        if ($result) {
            $_SESSION['mail'] = $email;
            $otp = $sendEmail->generate_code();
            $body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";
            $subject = "Your verification code";
            $sendEmail->sendEmail("E-Gawa", $_SESSION['mail'], $subject, $body);

            if (!$sendEmail) {
                $output['error'] = "Registration Failed! Invalid Email Address.";
            } else {
                $output['success'] = "Registered Successfully. OTP sent to " . $email;
            }
        }
    }
    echo json_encode($output);
}

?>