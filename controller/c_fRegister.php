<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$acc = new Account();

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

    $check_query = mysqli_query($con, "SELECT * FROM account WHERE email = '$email'");
    $rowCount = mysqli_num_rows($check_query);
    $sql = mysqli_query($con, "SELECT * FROM account WHERE username = '$username'");

    if ($firstName === "" || $middleName === "" || $lastName === "" || $username === "" || $email === "" || $password === "") {
        $output['error'] = "Incomplete Details!";
    } else if ($rowCount > 0) {
        $output['error'] = "Email address already exist!";
    } else if ($password !== $password2) {
        $output['error'] = "Password was not matched!";
    } else if ($sql->num_rows > 0) {
        $output['error'] = "Username already exist!";
    } else {
        $result = mysqli_query($con, "INSERT INTO account (firstName, middleName, lastName, username, email, password, userType, status) 
        VALUES ('$firstName', '$middleName', '$lastName', '$username', '$email', '$encypted', '$user_type', 0)");

        if ($result) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;
            require dirname(__FILE__) . "/../php/PHPMailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->Username = 'egawa.freelance@gmail.com';
            $mail->Password = 'vwfugwytghchiqja';

            $mail->setFrom('egawa.freelance@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["email"]);

            $mail->isHTML(true);
            $mail->Subject = "Your verification code";
            $mail->Body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";

            if (!$mail->send()) {
                $output['error'] = "Registration Failed! Invalid Email Address.";
            } else {
                $output['success'] = "Registered Successfully. OTP sent to " . $email;
            }
        }

    }
    echo json_encode($output);
}
?>