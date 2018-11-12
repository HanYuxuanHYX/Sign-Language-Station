<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($address,$subject,$body){
	$mail = new PHPMailer(true); 
	$mail -> CharSet = "UTF-8";
	$mail -> Encoding = "base64";                            // Passing `true` enables exceptions
	try {
    //Server settings
    	$mail->SMTPDebug = 1;                                 // Enable verbose debug output
    	$mail->isSMTP();                                      // Set mailer to use SMTP
    	$mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
    	$mail->SMTPAuth = true;                               // Enable SMTP authentication
    	$mail->Username = '1767182376@qq.com';                 // SMTP username
    	$mail->Password = 'bdvbrmraygcgccbe';                           // SMTP password
    	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    	$mail->Port = 587;                                    // TCP port to connect to

    	//Recipients
    	$mail->setFrom('1767182376@qq.com','Wapiti');
    	$mail->addAddress($address);               // Name is optional

    	//Content
    	$mail->isHTML(true);                                  // Set email format to HTML
    	$mail->Subject = $subject;
    	$mail->Body    = $body;
    	$mail->AltBody = 'HTML ';

    	$mail->send();
	} catch (Exception $e) {
    	echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
	}
}
?>