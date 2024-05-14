<?php

require("../lib/PHPMailer/src/PHPMailer.php");
require("../lib/PHPMailer/src/SMTP.php");

 $mail = new PHPMailer\PHPMailer\PHPMailer();
 $mail->IsSMTP(); // enable SMTP
 $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true; // authentication enabled
 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
 $mail->Host = "mail.acuabar.com";
 $mail->Port = 465; //465  or 587
 $mail->IsHTML(true);
 $mail->Username = "contacto@acuabar.com";
 $mail->Password = "Acu@B@j@B@r&M@r";
 $mail->SetFrom("contacto@acuabar.com");
 $mail->Subject = "Contacto Desde : Mi pagina web";
 
 $name = $_POST['name'];
 $email = $_POST['email'];
 $subject = $_POST['subject'];
 $message = $_POST['message'];
 
 $mail->Body = "Nombre: {$name} <br> Email: {$email} <br> Asunto : {$subject} <br> Mensaje : {$message}";
 $mail->AddAddress("contacto@acuabar.com");
 if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
 echo "OK";
 }

$recaptcha_secret = '6LefNqAmAAAAAJmeBNJ02cGiudKn9A9nTQP9iEL6';
$recaptcha_response = $_POST['token'];

if(!$recaptcha_response){
    error_log("ocurrio un error al obtener el token de captcha");
}

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
];

 ?>
