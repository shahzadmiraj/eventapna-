<?php

//require_once('../libraries/PHPMailer.php');
//require_once('../libraries/SMTP.php');

function serverSendMessage($SenderAddress,$SenderName,$Subject,$html)
{
   $display='';
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPDebug = false;                               // Enable verbose debug output
    // Set mailer to use SMTP
    $mail->Host = 'ssl://mail.eventapna.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'admin@eventapna.com';                 // SMTP username
    $mail->Password = 'Shahzad@123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;        //465                            // TCP port to connect to
    $mail->XMailer="   ";
    $mail->From = 'admin@eventapna.com';
    $mail->FromName = 'EVENT APNA';

    if(is_array($SenderAddress))
    {
        //if array $SenderAddress
        for($i=0;$i<count($SenderAddress);$i++)
        {
            $mail->addAddress($SenderAddress[$i], $SenderName[$i]);
        }
    }
    else
    {
        $mail->addAddress($SenderAddress, $SenderName);     // Add a recipient
    }
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $Subject;
    $mail->Body = $html;
    $mail->AltBody = ' This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        $display.= 'Message could not be sent.';
        $display.= 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo 'Message has been sent';
    }

    return $display;
}




