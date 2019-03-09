<?php

/**
* Zoom
*
* Ninimal but powerful web application framework for PHP
*
* This content is not open source but application built with zoom can be modified by users, but not to be sold
*
* Copyright (c) 2018, Zoom Inc, ZumClouds Nigeria.
*
**/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* EMAIL FUNCTIONS
*
**/

/**
 * PHPMailer
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../../app/PHPMailer/src/Exception.php';
require __DIR__ . '/../../../app/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../../app/PHPMailer/src/SMTP.php';

// ------------------------------------------------------------------------

if ( ! function_exists('valid_email'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('send_email'))
{
	/**
	 * Send an email
	 *
	 * @deprecated	3.0.0	Use PHP's mail() instead
	 * @param	string	$recipient
	 * @param	string	$subject
	 * @param	string	$message
	 * @return	bool
	 */

	function send_email($recipient, $subject, $message)
	{
		return mail($recipient, $subject, $message);
	}
}


// ------------------------------------------------------------------------

if ( ! function_exists('send_html_email'))
{

	/**
	 * Send an html email
	 * @return	bool
	 */

// function send_html_email($recipient, $subject = 'New E-mail', $message, $sender = null)
// {

//   if($sender == null || $sender == ""){
//     $sender = ADMINEMAIL;
//   }

// 	$sent = @mail($recipient,$subject,$message,"From: $sender"."\r\n"."Content-type: text/html; charset=iso-8859-1");
// 	if($sent) return true;
// 	return false;
// }


 function send_html_email($recipient, $subject = 'New E-mail', $message, $sender = NULL){

 	if($sender == NULL){
 		if(ADMINEMAIL != NULL){
 			$sender = ADMINEMAIL;
 		}else{
 			$sender = "account@staketime.com";
 		}
 	}

 	$email_from = 'StakeTime'.'<'.$sender.'>';

    // $headers = "From: " . $email_from . "\r\n";
    // $headers .= "Reply-To: ". $sender . "\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	// $sent = @mail($recipient, $subject, $message, $headers);
	
	//PHPMailer

        $mail = new PHPMailer;
        $mail->setFrom('support@staketime.com', 'Staketime');
        $mail->addAddress($recipient, 'Staketime Customer');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $message;

        if(!$mail->send()) {
            // echo 'Message was not sent.';
            // echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            // echo 'Message has been sent.';
        }

 }


}


// ------------------------------------------------------------------------

if ( ! function_exists('multple_emails'))
{

	/**
	 * Send an html emails to multiple E-mails
	 * @return	bool
	 */

function multple_emails($recipients = array(), $subject = 'New E-mail', $message, $sender = null)
{

if(is_array($recipients)){

  if($sender == null || $sender == ""){
    $sender = ADMINEMAIL;
  }

foreach($recipients as $recipient){
	mail($recipient, $subject,$message,"From: $sender "."\r\n"."Content-type: text/html; charset=iso-8859-1");
}

}
else{

	if($sender == null || $sender == ""){
    $sender = ADMINEMAIL;
  }

foreach($recipients as $recipient){
	$sent = @mail($recipient, $subject,$message,"From: $sender"."\r\n"."Content-type: text/html; charset=iso-8859-1","-fwebmaster@".$_SERVER["SERVER_NAME"]);
	if($sent) return true;
	return false;
}

return true;

}
}
}
