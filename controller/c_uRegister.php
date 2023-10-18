<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";

$db = new DbClass();
$acc = new Account();
$sendEmail = new Email();

if (isset($_POST['user_register'])) {
    $firstName = $_POST["fName"];
    $middleName = $_POST["mName"];
    $lastName = $_POST["lName"];
    $barangay = $_POST["barangay"];
    $municipality = $_POST["municipality"];
    $province = $_POST["province"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST['password2'];
    $usertype = "user";
    $encrypted = $acc->encrypt_password($password);

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $email]);

    $query2 = $db->connect()->prepare("SELECT * FROM account WHERE username = :username");
    $query2->execute([':username' => $username]);

    if (
        $firstName === "" || $middleName === "" || $lastName === "" || $barangay === "" || $municipality === "" || $province === "" || $username === ""
        || $email === "" || $password === "" || $password2 === ""
    ) {
        $output['error'] = "Incomplete Details!";
    } else if ($password !== $password2) {
        $output['error'] = "Password are not matched!";
    } else if ($query->rowCount() > 0) {
        $output['error'] = "Email address already exist!";
    } else if ($query2->rowCount() > 0) {
        $output['error'] = "Username already exist!";
    } else {
        $query = $db->connect()->prepare("INSERT INTO account (firstName, middleName, lastName, barangay, municipality, province, username, email, password, userType, status)
        VALUES (:firstName, :middleName, :lastName, :barangay, :municipality, :province, :username, :email, :password, :userType, :status)");
        $result = $query->execute([':firstName' => $firstName, ':middleName' => $middleName, ':lastName' => $lastName, ':barangay' => $barangay, ':municipality' => $municipality, ':province' => $province, ':username' => $username, ':email' => $email, ':password' => $encrypted, ':userType' => $usertype, ':status' => 0]);

        if ($result) {
            $_SESSION['mail'] = $email;
            $otp = $sendEmail->generate_code();
            $_SESSION['otp'] = $otp;
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
