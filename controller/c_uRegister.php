<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

$email = $_REQUEST["emailAddress"];
$password = $_REQUEST["pass1"];

$check_query = mysqli_query($con, "SELECT * FROM account where email = '$email'");
$rowCount = mysqli_num_rows($check_query);

if (!empty($email) && !empty($password)) {
    if ($rowCount > 0) {
        ?>
<script>
//insert modal here
//email already exist!!
</script>
<?php
    } else {
        $result = mysqli_query($con, "INSERT INTO account (email, password, status) VALUES ('$email', '$password', 0)");

        if ($result) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;
            require "/../php/PHPMailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->Username = 'email account';
            $mail->Password = 'email password';

            $mail->setFrom('email account', 'OTP Verification');
            $mail->addAddress($_REQUEST["emailAddress"]);

            $mail->isHTML(true);
            $mail->Subject = "Your verification code";
            $mail->Body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";

            if (!$mail->send()) {
                ?>
<script>
//modal
//Registration Failed. Invalid Email
</script>
<?php
            } else {
                ?>
<script>
//modal here
//Registration Successfully, OTP sent to email
window.location.replace('verification.php');
</script>
<?php
            }
        }
    }
}

?>