<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";

$acc = new Account();
$sendEmail = new Email();
$db = new DbClass();

if (isset($_POST['registerFreelance'])) {
    $firstName = $_POST["fName"];
    $middleName = $_POST["mName"];
    $lastName = $_POST["lName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $user_type = "freelancer";
    $encrypted = $acc->encrypt_password($password);

    $query = $db->connect()->prepare("SELECT * FROM account");
    $query->execute();
    $fetch = $query->fetch(PDO::FETCH_ASSOC);    

    if ($firstName === "" || $middleName === "" || $lastName === "" || $username === "" || $email === "" || $password === "") {
        $output['error'] = "Incomplete Details!";
    } else if ($email == $fetch['email']) {
        $output['error'] = "Email address already exist!";
    } else if ($password !== $password2) {
        $output['error'] = "Password was not matched!";
    } else if ($username == $fetch['username']) {
        $output['error'] = "Username already exist!";
    } else {
        $query = $db->connect()->prepare("INSERT INTO account (firstName, middleName, lastName, username, email, password, userType, status) VALUES (:firstName, :middleName, :lastName, :username, :email, :password, :userType, :status)");
        $result = $query->execute([':firstName' => $firstName, ':middleName' => $middleName, ':lastName' => $lastName, ':username' => $username, ':email' => $email, ':password' => $password, ':userType' => $user_type, ':status' => 0]);
        
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
?>