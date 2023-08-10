<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$acc = new Account();

$firstName = $_POST["fName"];
$middleName = $_POST["mName"];
$lastName = $_POST["lName"];
$address = $_POST["address"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$usertype = "user";
$encrypted = $acc->encrypt_password($password);

$check_query = mysqli_query($con, "SELECT * FROM account where email = '$email'");
$rowCount = mysqli_num_rows($check_query);

if (!empty($email) && !empty($password)) {
    if ($rowCount > 0) {
        ?>
<script>
//insert modal here
//email already exist!!
alert('email already exist');
window.location.replace('../user/userRegistration.php');
</script>
<?php
    } else {
        $result = mysqli_query($con, "INSERT INTO account (firstName, middleName, lastName, address, username, email, password, userType, status) VALUES ('$firstName', '$middleName', '$lastName', '$address', '$username', '$email', '$encrypted', '$usertype', 0)");

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
//modal
//Registration Failed. Invalid Email
</script>
<?php
            } else {

                ?>
<script>
//modal here    
//Registration Successfully, OTP sent to email
alert('Success');
window.location.replace('../freelance/verifyAccount.php');
</script>
<?php
            }
        }
    }
}

?>