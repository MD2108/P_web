<?php
include_once '..\Model\User.php';
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

//Include required PHPMailer files
	require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "3allemni.contact@gmail.com";
//Set gmail password
	$mail->Password = "abcd1234@";
//Email subject
	$mail->Subject = "Confirm your 3allemni.tn account";
//Set sender email
	$mail->setFrom('3allemni.contact@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('img/attachment.png');
//Email body


	$mail->Body =

	"http://localhost/Module_User/Views/INCLUDE/confirm.php?id=$user_id&token=$token";
	
//Add recipient
	$mail->addAddress($uemail);
//Finally send email
	if ( $mail->send() ) {
		echo "Email Sent..!";
	}else{
		die("Message could not be sent. Mailer Error: ");
	}
//Closing smtp connection
	$mail->smtpClose();
