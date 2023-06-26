<?php
require dirname(__FILE__) . '/../PHPMailer/PHPMailerAutoload.php';

class Email
{
    public function sendEmail($name, $email, $subject, $body)
    {
        $from = 'egawa.freelance@gmail.com';
        $password = 'vwfugwytghchiqja';

        date_default_timezone_set('Etc/UTC');
        $mail = new PHPMailer();

        $mail->addAddress($email);
        $mail->setFrom($name);

        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "smtp";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Subject = $subject;
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->FromName = $name;
        $mail->Password = $password;

        $mail->msgHTML($body);
        return $mail->send();
    }
}
?>