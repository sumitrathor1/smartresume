<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../package/PHPMailer/src/Exception.php';
require_once '../../package/PHPMailer/src/PHPMailer.php';
require_once '../../package/PHPMailer/src/SMTP.php';

function sendVerificationEmail($toEmail, $toName, $verificationLink) {
    $mail = new PHPMailer(true);

    try {

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'YOUR_EMAIL';
        $mail->Password = 'YOUR_API_KEY';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
      
        $mail->setFrom("YOUR_EMAIL");

        // Recipients
        $mail->setFrom('YOUR_MAIL', 'SmartResume (No Reply)');
        $mail->addAddress($toEmail, $toName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your SmartResume Email';
        $mail->Body    = "
            <h2>Hello, $toName</h2>
            <p>Thank you for signing up at <strong>SmartResume</strong>.</p>
            <p>Please verify your email address by clicking the link below:</p>
            <a href='$verificationLink'>Verify Email</a>
            <br><br>
            <small>If you didn’t request this, please ignore this email.</small>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
