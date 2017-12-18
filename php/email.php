<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com;';  					  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
    $mail->Username = 'sammoffatautoemail@gmail.com';     // SMTP username
    $mail->Password = '';                        		// SMTP password
    $mail->SMTPSecure = 'TLS';                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                  // TCP port to connect to

    //Recipients
    $mail->setFrom('sammoffatautoemail@gmail.com', 'Mailer');
    $mail->addAddress('sam.moffat@hotmail.com', 'Joe User');     // Add a recipient
    //$mail->addAddress('ellen@example.com');             // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "New Message from " . ($_POST['first_name']) . " " . ($_POST['last_name']) . ": " . ($_POST['title']);
    $mail->Body    = "Name: " . ($_POST['first_name']) . " " . ($_POST['last_name']) . "<p> Email: " . ($_POST['email']) . "<p>Mobile Number: " . ($_POST['telephone']) . "<p>Message: " . ($_POST['message']);
    $mail->AltBody = "Name: " . ($_POST['first_name']) . " " . ($_POST['last_name']) . "<p> Email: " . ($_POST['email']) . "<p>Mobile Number: " . ($_POST['telephone']) . "<p>Message: " . ($_POST['message']);
    
	$mail->send();
	header("Location: ../contact-success.html");
	die();
} catch (Exception $e) {
    header("Location: ../contact-failure.html");
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}