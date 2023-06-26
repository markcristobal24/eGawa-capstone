<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

$firstName = $_POST["fName"];
$middleName = $_POST["mName"];
$lastName = $_POST["lName"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$user_type = "freelancer";

$check_query = mysqli_query($con, "SELECT * FROM account WHERE email = '$email'");
$rowCount = mysqli_num_rows($check_query);

if (!empty($email) && !empty($password)) {
    if ($rowCount > 0) {
        ?>
<script>
alert('Email Already Exist!');
</script>
<?php
    } else {
        $result = mysqli_query($con, "INSERT INTO account (firstName, middleName, lastName, username, email, password, userType, status) 
        VALUES ('$firstName', '$middleName', '$lastName', '$username', '$email', '$password', '$user_type', 0)");

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
                ?>
<script>
alert('Registration Failed! Invalid Email Address');
</script>
<?php
            } else {
                ?>
<script>
alert('Registration Successful. OTP sent to <?php echo $email; ?>');
window.location.replace('../verifyAccount.php');
</script>
<?php
            }
        }
    }
}
?>