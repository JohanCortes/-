<?php
$key = $_GET['key'];
$_post = json_decode(file_get_contents('php://input'), true);
date_default_timezone_set('America/Mexico_City');
$fecha=date('Y-m-d H:i:s.m');
if ($key != '') {
  //$key = $_post['key'];
  if (strlen($key) == 4) {
    $timestamp = $date->getTimestamp();
    $passwordHash = password_hash($key, PASSWORD_DEFAULT);
    $PDO = new PDO('mysql:host=localhost;dbname=Data', 'root', '');
    $result = $PDO->prepare("select val, fecha, duracion from `token`");
    $result->execute();
    $result = $result->fetchAll();
    foreach ($result as $row) {
      $duracion = explode(':', $row['duracion']);
      $t = $duracion [0] * 3600 + $duracion [1] * 60 + $duracion [2];
      $fecha = strtotime($row['fecha']);
      print_r($fecha);
      if (password_verify($key, $row['val'])) {
        echo 'true';
      }
    }
  }
}
