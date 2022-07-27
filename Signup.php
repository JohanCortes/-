<?php
session_start();
session_destroy();
if ($_POST) {
  print_r($_POST);
  $username = $_POST['user'];
  $email = $_POST['email'];
  $password = $_POST['q'];

  try {
    $PDO = new PDO('mysql:host=localhost;dbname=Data', 'root', '');
    $result = $PDO->prepare("insert into `users` (`username`, `email`, `pass`) values (:username, :email, :password)");
    $result->execute(array(':username' => $username, ':email' => $email, ':password' => $password));
    header('Location: Login.php');
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
</head>

<body>
  <form action="Signup.php" method="post">
    <div class="fila">
      <label for="usuario">Nombre de usuario: </label>
      <input type="text" name="user" id="usuario">
    </div>
    <div class="fila">
      <label for="email">Email: </label>
      <div style="display: flex; align-items: center">
        <input type="text" name="email" id="email">
        <input type="button" value="Verificar" id="btn-ver">
      </div>
    </div>
    <div class="fila">
      <label for="pass">Contraseña: </label>
      <input type="password" name="pass" id="pass">
    </div>
    <div class="fila">
      <label for="conf">Confirmar contraseña: </label>
      <input type="password" name="conf" id="conf">
      <input type="hidden" name="q">
    </div>
    <div class="fila">
      <label for="verify">Verificación: </label>
      <input type="text" name="verify" id="verify" maxlength="5">
    </div>
    <input type="submit" class='btn' value="Aceptar">
  </form>
  <script src="js/Signup.js"></script>
</body>

</html>