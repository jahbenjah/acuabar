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
$mail->Password = "AcuaBajaBar&Mar";
$mail->SetFrom("contacto@acuabar.com");
$mail->Subject = "Reservacion : Desde Mi pagina web";

$name = $_POST['nameBooking'];
$email = $_POST['emailBooking'];
$country_code = $_POST['countryCodeBooking'];
$phone = $_POST['phoneBooking'];
$date = $_POST['dateBooking'];
$time = $_POST['timeBooking'];
$people = $_POST['partyBooking'];
$message = $_POST['messageBooking'];

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

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$result_json = json_decode($result, true);

if ($result_json['success']) {
    $mail->Body = "Nombre: {$name} <br> Email: {$email} <br> Telefono : (+{$country_code}) {$phone} <br> Fecha : {$date} <br> Hora : {$time} <br> Personas : {$people} <br> Mensaje : {$message}";
    $mail->AddAddress("contacto@acuabar.com");
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "OK";
    }
}else{
    error_log("ocurrio un error con el captcha");
    exit;
}


?>
