<?php
$id = $_POST['user'];
$clave = $_POST['clave'];
$fecha = $_POST['fecha'];
$duracion = $_POST['hh'] . ':' . $_POST['mm'] . ':' . $_POST['ss'];
$emails = $_POST['emails'];

try {
  $PDO = new PDO('mysql:host=localhost;dbname=Data', 'root', '');
  $result = $PDO->prepare("insert into `token` (val, fecha, duracion, id_user) values (:clave, :fecha, :duracion, :id)");
  $result->execute(array(':clave' => $clave, ':fecha' => $fecha, ':duracion' => $duracion, ':id' => $id));

  $emails=explode(';', $emails);
  foreach($emails as $email) {
    echo mail($email,'Token','<h1 style="color:red;">'.$clave.'</h1>',"MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\nFrom: <no-reply@gmail.com>");
  }

  echo 'Clave creada correctamente';
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
print_r($emails);