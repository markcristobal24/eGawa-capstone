<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require dirname(__FILE__) . "/../php/PHPMailer/PHPMailerAutoload.php";

if (isset($_POST["btnSubmit"])) {
    $email = $_POST["sendEmail"];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email='$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
        ?>
        <script>
            alert("Sorry, no email address exist");
        </script>
        <?php
    } else if ($fetch["status"] == 0) {
        ?>
            <script>
                alert("Sorry, your account must verify first before you recover your password!");
                window.location.replace("../login.php");
            </script>
            <?php
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
        http://localhost/eGawa-capstone/createNewPassword.php
        <br><br>
        <p>With Regards,</p>
        <b>E-Gawa</b>";

        if (!$mail->send()) {
            ?>
                <script>
                    alert("Invalid Email");
                </script>
                <?php
        } else {
            ?>
                <script>
                    window.location.replace("../forgotPassword2.php");
                </script>
                <?php
        }

    }
}
?>