<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$email = $_POST["email"];
$password = $_POST["pass"];

$sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email'");
$query = mysqli_num_rows($sql);
$fetch = mysqli_fetch_assoc($sql);

if ($query <= 0) {
    ?>
    <script>
        alert('Email Address do not exist!');
    </script>
    <?php
} else if ($query > 0) {
    if ($fetch["userType"] == 'super_admin') {
        ?>
            <script>
                window.location.replace("../pages/dashboard.php");
            </script>
            <?php
    } else if ($fetch["userType"] == 'user') {
        if ($fetch["status"] == 0) {
            $verifyEmail = new Email();
            $otp = $verifyEmail->generate_code();
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;
            $_SESSION['email'] = $email;
            $_SESSION['account_id'] = $fetch['account_id'];
            $body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";
            $subject = "Your verification code";

            ?>
                    <script>
                        alert('Verify your email address first');
                        window.location.replace("../verifyAccount.php");
                    </script>
                    <?php

                    $verifyEmail->sendEmail("E-Gawa", $email, $subject, $body);
        } else {
            //rekta login
        }
    } else if ($fetch["userType"] == 'freelancer') {
        if ($fetch["status"] == 0) {
            $verifyEmail = new Email();
            $otp = $verifyEmail->generate_code();
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;
            $_SESSION['email'] = $email;
            $_SESSION['account_id'] = $fetch['account_id'];
            $body = "<p>Dear user, </p> <h3>Your verification code is $otp</h3>
            <br><br>
            <p>With Regards,</p>
            <b>eGawa</b>";
            $subject = "Your verification code";

            ?>
                        <script>
                            alert('Verify your email address first');
                            window.location.replace("../verifyAccount.php");
                        </script>
                        <?php

                        $verifyEmail->sendEmail("E-Gawa", $email, $subject, $body);
        } else if ($fetch["status"] == 1 && $fetch["profileStatus"] == 0) {
            $_SESSION['email'] = $email;
            $_SESSION['account_id'] = $fetch['account_id'];
            header('location: ../createProfile.php');

        } else if ($fetch["status"] == 1 && $fetch["profileStatus"] == 1) {
            //$_SESSION['email'] = $email;
            // $_SESSION['account_id'] = $fetch['account_id'];
            $session = new Account();
            $session->fetch_information($email);
            ?>
                                <script>
                                    window.location.replace("../freelanceHomePage.php");
                                </script>
                                <?php
        }
    }
}
?>