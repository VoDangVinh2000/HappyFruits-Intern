<?php
require_once 'PHPMailerAutoload.php';

if (!function_exists('debug'))
{
	function debug($msg)
	{
		$fp = fopen('debug.txt', 'a');
		fwrite($fp, $msg . "\n");
		fclose($fp);
	}
}

function SendMail($frommail, $tomail, $subject, $message, $fromfullname="From website", $replyto = '')
{
    if (defined('DOMAIN_NAME'))
        $domain = DOMAIN_NAME;
    else if(!empty($_SERVER["SERVER_NAME"]))
        $domain = str_replace('www.', '', strtolower($_SERVER["SERVER_NAME"]));
    else
        $domain = null;

    $site_name = function_exists('get_setting')?get_setting('site_name'):'';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    //Tell PHPMailer to use SMTP
    $mail->isMail();
    //Set who the message is to be sent from
    $mail->setFrom($frommail, $fromfullname);
    //Set an alternative reply-to address
	if (empty($replyto) && $domain){
		if ($frommail == 'orders@'.$domain)
			$mail->addReplyTo('orders@'.$domain, $site_name);
		else
			$mail->addReplyTo('info@'.$domain, $site_name);
	}else{
		$mail->addReplyTo($replyto);
	}

    //Set who the message is to be sent to
    if (!is_array($tomail))
        $emails = explode(',', $tomail);
    else
        $emails = $tomail;
    foreach($emails as $e){
        $mail->addAddress($e);
    }
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($message, dirname(__FILE__));
    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');
    if (get_server_ip() != "127.0.0.1" && IS_LIVE)
    {
        //send the message, check for errors
        if (!$mail->send()) {
            debug("Mailer Error: " . $mail->ErrorInfo);
            debug("Mail details:\nTo: $tomail \nSubject:$subject \nBody:\n$message \n\n");
            return 0;
        } else {
            return 1;
        }
    }
    else
    {
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.mailtrap.io";
        $mail->Mailer = "smtp";
        $mail->Port = 25;
        $mail->Username = "36246e1e171372";
        $mail->Password = "58ca25c696df2f";

        if (!$mail->send()) {
            debug("Mailer Error: " . $mail->ErrorInfo);
            debug("Mail details:\nTo: $tomail \nSubject:$subject \nBody:\n$message \n\n");
            return 0;
        } else {
            return 1;
        }
        /*
        if (is_array($tomail))
            $tomail = implode(',', $tomail);
        debug("Mail details:\nTo: $tomail \nSubject:$subject \nBody:\n$message \n\n");
        return 1;
        */
    }
}
