<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


function intCodeRandom($length = 8)
{
    $intMin = (10 ** $length) / 10; // 100...
    $intMax = (10 ** $length) - 1;  // 999...
    $codeRandom = mt_rand($intMin, $intMax);
    return $codeRandom;
}


function isValidEmail($conn, $email, $usercode){
    $stmt = $conn->prepare('SELECT COUNT(*) AS total_num FROM users WHERE email = ? OR usercode = ?');
    $stmt->bind_param('ss', $email, $usercode);
    $stmt->execute();
    $get_result = $stmt->get_result();
    return $get_result->fetch_assoc()['total_num'];
}

function isValid($conn, $email){
    $stmt = $conn->prepare('SELECT COUNT(*) AS total_num FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $get_result = $stmt->get_result();
    return $get_result->fetch_assoc()['total_num'];
}

function sendEmail($email, $password, $fullname){
    $message = '
     Dear '.$fullname.
     '<br>Thank you for joining GSO tracking System! We are thrilled to have you on board.<br>
     To help you get started, please find below your account details:<br>

     Username: '.$email.'<br>
     Temporary Password: '.$password.'<br>';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'gabrielcarpio178@gmail.com';                     //SMTP username
        $mail->Password   = 'bjog yedg mdez luky';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        ); 
        $mail->SMTPSecure = 'ssl';  
        //Recipients
        $mail->setFrom('gsotracking@gmail.com', 'GSO Tracking');
        $mail->addAddress($email, $fullname);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Welcome to GSO tracking System';
        $mail->Body = $message;

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

