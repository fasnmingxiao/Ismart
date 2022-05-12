
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './mvc/lib/PHPMailer/src/Exception.php';
require './mvc/lib/PHPMailer/src/PHPMailer.php';
require './mvc/lib/PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions

function send_mail($send_to_mail,$send_to_fullname,$subject,$content,$option= array()){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'pornhubnt1@gmail.com';                     //SMTP username
        $mail->Password   = '0987376134';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('pornhubnt1@gmail.com', 'Pornhub');
        $mail->addAddress($send_to_mail, $send_to_fullname);     //Add a recipient
       // $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('pornhubnt1@gmail.com', 'Pornhub');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
       // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}