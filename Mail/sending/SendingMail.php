<?php

require_once('../libraries/PHPMailer.php');
require_once('../libraries/SMTP.php');

function serverSendMessage($SenderAddress,$SenderName,$Subject,$html,$ReplyAddress)
{
    $display='';
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPDebug = 0; //1 error or success
    // Enable verbose debug output
    // Set mailer to use SMTP
    $mail->Host = 'ssl://mail.eventapna.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username   = 'info@eventapna.com';                     // SMTP username
    $mail->Password   = 'rifxen-wYksid-vyvqi4';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;        //465     ,587                       // TCP port to connect to
    $mail->SMTPKeepAlive = true;
    $mail->XMailer=" ";
    $mail->From = 'info@eventapna.com';
    $mail->FromName = 'Event apna';

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


    if(is_array($ReplyAddress))
    {
        //if array $SenderAddress
        for($i=0;$i<count($ReplyAddress);$i++)
        {
            $mail->addReplyTo($ReplyAddress[$i]);
        }
    }
    else
    {
        $mail->addReplyTo($ReplyAddress);     // Add a recipient
    }

//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

    $mail->WordWrap = 70;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Timeout=600;
    $mail->Subject = $Subject;
   $mail->Body = $html;
    $mail->msgHTML = $html;
    $mail->AltBody = ' This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        $display.= 'Message could not be sent.';
        $display.= 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'sent';
    }
 //   $mail->smtpClose();

    return $display;
}

$emailAdress=array("cryptogelt99@gmail.com","shahzadmirajdin1@gmail.com","mrbfree00@gmail.com");
$emailNames=array("cryptogelt","shahzad miraj","mrbfree");
echo serverSendMessage($emailAdress,$emailNames,"Confirmation of Email",'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style type="text/css">
    a[x-apple-data-detectors] {color: inherit !important;}
  </style>

</head>
<body style="margin: 0; padding: 0;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td style="padding: 20px 0 30px 0;">

<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
  <tr>
    <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
      <img src="https://assets.codepen.io/210284/h1_1.gif" alt="Creating Email Magic." width="300" height="230" style="display: block;" />
    </td>
  </tr>
  <tr>
    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
          <td style="color: #153643; font-family: Arial, sans-serif;">
            <h1 style="font-size: 24px; margin: 0;">Lorem ipsum dolor sit amet!</h1>
          </td>
        </tr>
        <tr>
          <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
            <p style="margin: 0;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat.</p>
          </td>
        </tr>
        <tr>
          <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
              <tr>
                <td width="260" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <tr>
                      <td>
                        <img src="https://assets.codepen.io/210284/left_1.gif" alt="" width="100%" height="140" style="display: block;" />
                      </td>
                    </tr>
                    <tr>
                      <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
                        <p style="margin: 0;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat.</p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                <td width="260" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <tr>
                      <td>
                        <img src="https://assets.codepen.io/210284/right_1.gif" alt="" width="100%" height="140" style="display: block;" />
                      </td>
                    </tr>
                    <tr>
                      <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
                        <p style="margin: 0;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="#ee4c50" style="padding: 30px 30px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
          <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
            <p style="margin: 0;">&reg; Someone, somewhere 2025<br/>
           <a href="#" style="color: #ffffff;">Unsubscribe</a> to this newsletter instantly</p>
          </td>
          <td align="right">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
              <tr>
                <td>
                  <a href="http://www.twitter.com/">
                    <img src="https://assets.codepen.io/210284/tw.gif" alt="Twitter." width="38" height="38" style="display: block;" border="0" />
                  </a>
                </td>
                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                <td>
                  <a href="http://www.twitter.com/">
                    <img src="https://assets.codepen.io/210284/fb.gif" alt="Facebook." width="38" height="38" style="display: block;" border="0" />
                  </a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

      </td>
    </tr>
  </table>
</body>
</html> ','shahzadmirajdin1@gmail.com');
//  $mail->Username   = 'support@eventapna.com';                     // SMTP username
//    $mail->Password   = 'shhazadmirajdin1';                               // SMTP password
//    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 465;        //465     ,587