<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require dirname(__FILE__) . "/../php/PHPMailer/PHPMailerAutoload.php";

if (isset($_POST["forgot_password"])) {
    $email = $_POST["sendEmail"];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email='$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
        $output['error'] = "Sorry, no email address exist.";
    } else {
        $token = bin2hex(random_bytes(50));

        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'egawa.freelance@gmail.com';
        $mail->Password = 'vwfugwytghchiqja';

        $mail->setFrom('egawa.freelance@gmail.com', 'Password Reset');
        $mail->addAddress($_POST["sendEmail"]);

        $mail->isHTML(true);
        $mail->Subject = "Recover your password";
        $mail->Body = "<b>Dear User</b>
        <h3>We received a request to reset your password.</h3>
        <p>Kindly click the link below to reset your password</p>
        http://localhost/eGawa-capstone/freelance/createNewPassword.php
        <br><br>
        <p>With Regards,</p>
        <b>E-Gawa</b>";

        if (!$mail->send()) {
            $output['error'] = "Invalid Email Address!";
        } else {
            $output['success'] = "Link sent successfully!";
        }
    }
    echo json_encode($output);
}
?>