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
 
 $name = $_POST['name'];
 $email = $_POST['email'];
 $phone = $_POST['phone'];
 $date = $_POST['date'];
 $time = $_POST['time'];
 $people = $_POST['people'];
 $message = $_POST['message'];
 
 $mail->Body = "Nombre: {$name} <br> Email: {$email} <br> Telefono : {$phone} <br> Fecha : {$date} <br> Hora : {$time} <br> Personas : {$people} <br> Mensaje : {$message}";
 $mail->AddAddress("contacto@acuabar.com");
 if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
 echo "OK";
 }

 ?>
