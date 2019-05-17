<?php
ob_start();
include('cv.php');
$body = ob_get_contents();
ob_end_clean();

require("PHPMailer/PHPMailer/src/PHPMailer.php");
require("PHPMailer/PHPMailer/src/SMTP.php");
require("PHPMailer/PHPMailer/src/Exception.php");
$mail = new PHPMailer\PHPMailer\PHPMailer();

$email=$_SESSION['mailtd'];
$message = file_get_contents('cv.php'); 
$mail->IsHTML(true);
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Host = 'tls://smtp.gmail.com:587';
$mail->Port = 587;
$mail->CharSet = "UTF-8";
$mail->Username = 'jkookie602@gmail.com';
$mail->Password = 'sontungmtp';
$mail->setFrom('jkookie602@gmail.com', 'Jkookie');
$mail->Subject = 'Gửi CV';
//$mail->Body =;
$mail->Body = $body;
 $mail->addAddress($email, '');
$mail->AllowEmpty = true;
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    echo "<a href='index.php'>Trang chủ</a>";

}
?>