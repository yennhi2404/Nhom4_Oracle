<?php
function Send_Mail($to,$subject,$body)
{
   require("PHPMailer/PHPMailer/src/PHPMailer.php");
require("PHPMailer/PHPMailer/src/SMTP.php");
require("PHPMailer/PHPMailer/src/Exception.php");
$mail = new PHPMailer\PHPMailer\PHPMailer();
   $from = "from@jobboard.com";
   $mail->IsSMTP(true);            // use SMTP
   $mail->IsHTML(true);
   $mail->SMTPAuth   = true;  
   $mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';                // enable SMTP authentication
  $mail->Host = 'tls://smtp.gmail.com:587'; // SMTP host
   $mail->Port       =  587;                    // set the SMTP port
   $mail->Username = 'nhuquynh.nqq@gmail.com';
$mail->Password = 'nhuquynh';
$mail->setFrom('nhuquynh.nqq@gmail.com', 'nhuquynh');
   $mail->AddReplyTo($from,'jobboard');
   $mail->Subject    = $subject;
   $mail->MsgHTML($body);
   $address = $to;
   $mail->AddAddress($address, $to);
   
   if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    echo "<a href='index.php'>Trang chủ</a>";

}
}
?>