<?php
/*/*
1 convert row into colum array
$hallOneD = array_column($SqlArray, Colume name or number);
 $hallOneD = array_column($AllHalls, 0);


2:convert 1 d array into seperator
        $List = implode(',', $hallOneD);

3 string to array
$str= "foo,bar,baz,bat";
$arr= explode(",", $str);
print_r ($arr) ;

3: array unique
$a=array("a"=>"red","b"=>"green","c"=>"red");
print_r(array_unique($a));


4:array differ intercession
$diff=array_diff(array1,array2)

5:foreach loop

foreach ($array as $key => $value) {

}

$array1 = array(1,2,3,4,5,6,7,8);
$array2 = array(1,2,3,4);
remove duplication in array equals (5,6,7,8)
$clean1 = array_diff($array1, $array2);
$clean2 = array_diff($array2, $array1);
$final_output = array_merge($clean1, $clean2);












*/
?><!--



--><?php




// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.eventapna.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'support@eventapna.com';                     // SMTP username
    $mail->Password   = 'shhazadmirajdin1';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('support@eventapna.com', 'EVENT APNA');
    $mail->addAddress('shahzadmirajdin1@gmail.com', 'shahzad miraj');     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);// Set email format to HTML
   $mail->Timeout=6000;
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This kjb jbkbfbefef jkb';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";



}


require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('mail.eventapna.com', 465))
    ->setUsername('support@eventapna.com')
    ->setPassword('shhazadmirajdin1')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['support@eventapna.com' => 'John Doe'])
    ->setTo(['shahzadmirajdin1@gmail.com', 'other@domain.org' => 'A name'])
    ->setBody('Here is the message itself')
;

// Send the message
$result = $mailer->send($message);
?>

