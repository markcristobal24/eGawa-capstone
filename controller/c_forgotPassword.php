<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";

$db = new DbClass();
$mail = new Email();

if (isset($_POST["forgot_password"])) {
    $email = $_POST["sendEmail"];

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $email]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() <= 0) {
        $output['error'] = "Sorry, no email address exist.";
    } else {
        $token = bin2hex(random_bytes(50));

        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;

        $subject = "Recover your password";
        $body = "<b>Dear User</b>
        <h3>We received a request to reset your password.</h3>
        <p>Kindly click the link below to reset your password</p>
        http://localhost/eGawa-capstone/freelance/createNewPassword.php?token=.$token
        <br><br>
        <p>With Regards,</p>
        <b>E-Gawa</b>";
        $mail->sendEmail("E-Gawa", $email, $subject, $body);
        if ($mail) {
            $output['success'] = "Link sent to $email!";
        }
        else {
            $output['error'] = "Invalid Email Address!";
        }
    }
    echo json_encode($output);
}
?>