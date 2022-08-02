<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-6.6.3/src/Exception.php';
require 'PHPMailer-6.6.3/src/PHPMailer.php';
require 'PHPMailer-6.6.3/src/SMTP.php';
$mail = new PHPMailer(true);
$_post = json_decode(file_get_contents('php://input'), true);
$code = $_post['code'];
$email = $_post['email'];
$user = $_post['user'];
try {
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'asistenteelectronico2@gmail.com';
  $mail->Password = 'rxtinubbqkqaznud';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->setFrom('asistenteelectronico2@gmail.com', 'Verify');
  $mail->isHTML(true);
  $mail->Subject = 'Key';
  $mail->Body    = '<h1>Código de Verificación</h1>
  <p>Hola ' . $user . ' </p>
  <p>Ingrese el siguiente código para registrarse</p>
  <h2 style="text-align: center; padding: .5rem; background-color: #ccc"; border: black solid 1px; border-radius: 5px;>' . $code . '</h2>';
  $mail->addAddress($email);
  $mail->send();
  echo 'Message has been sent';
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
