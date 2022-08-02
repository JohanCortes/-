<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-6.6.3/src/Exception.php';
require 'PHPMailer-6.6.3/src/PHPMailer.php';
require 'PHPMailer-6.6.3/src/SMTP.php';
$mail = new PHPMailer(true);
$id = $_POST['user'];
$key = $_POST['key'];
$duracion = $_POST['hh'] . ':' . $_POST['mm'] . ':' . $_POST['ss'];
$email = $_POST['email'];

try {
  date_default_timezone_set('America/Mexico_City');
  $fecha = date('Y-m-d H:i:s.m');
  $clave = password_hash($key, PASSWORD_DEFAULT);

  $PDO = new PDO('mysql:host=localhost;dbname=Data', 'root', '');
  $result = $PDO->prepare("insert into `token` (val, fecha, duracion, id_user) values (:clave, :fecha, :duracion, :id)");
  $result->execute(array(':clave' => $clave, ':fecha' => $fecha, ':duracion' => $duracion, ':id' => $id));
  echo 'Clave creada correctamente';

  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'asistenteelectronico2@gmail.com';                 // SMTP username
  $mail->Password = 'rxtinubbqkqaznud';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to
  $mail->setFrom('asistenteelectronico2@gmail.com', 'Set key');
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Key';
  $mail->Body    = '<h1>Clave de acceso</h1>
  <p>La clave para el acceso a la aplicación es: ' . $key . '</p>
  <p>La clave tendrá validez durante ' . $duracion . '</p>';
  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  $mail->addAddress($email);
  $mail->send();
  echo 'Message has been sent';
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
//print_r($emails);