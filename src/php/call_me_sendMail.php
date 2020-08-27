<?PHP
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require "vendor/autoload.php";

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	$mail->CharSet='UTF-8';
	$mail->Encoding = 'base64';
    //Server settings
    #$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.nziv.ru';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'admin@nziv.ru';                     // SMTP username
    $mail->Password   = 'Lg1257DHm5';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('admin@nziv.ru');
    $mail->addAddress('sale@nziv.ru');     // Add a recipient            
    $mail->addAddress('go@nziv.ru');     // Add a recipient            

    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Просьба перезвонить';
    $mail->Body    = 'ФИО: '.$_POST['recipient-name'].', Телефон: '.$_POST['recipient_phone'];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header('location:/call_me_sended.html');
} catch (Exception $e) {
    header('location:/call_me_send_error.html');
}

?>