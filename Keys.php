<?php
session_start();
if (isset($_POST)) {
  if ($_SESSION['login']) {
    echo '<h2 class="info" id="user" data-id="' . $_SESSION['idusuario'] . '" data-email="' . $_SESSION['email'] . '">' . $_SESSION['usuario'] . '</h2>';
  } else {
    header('Location: Login.php');
    exit();
  }
} else {
  header('Location: Login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <form action="NewKey.php" method="post">
    <div class="fila">
      <label for="key">Clave: </label>
      <input type='text' name='key' id='key' pattern="\d*" maxlength="6" required>
      <input type='hidden' name='user' id='user' value="<?php echo $_SESSION['idusuario']?>">
    </div>
    <div class="fila">
      <label for="hh">Duración: </label>
      <div>
        <input type="number" name="hh" id="hh" min="0" max="99" required> :
        <input type="number" name="mm" id="mm" min="0" max="59" required> :
        <input type="number" name="ss" id="ss" min="0" max="59" required>
      </div>
    </div>
    <div class="fila">
      <label for="email">Enviar a: </label>
      <div style="display: flex; align-items: center">
        <input type="text" name="email" id="email" style="width: 80%;">
        <input type="button" value="+" id='btn-add'>
        <input type="hidden" name="emails" id="emails">
        <!-- <input type="hidden" name="clave" id="clave"> -->
      </div>
    </div>

    <input type="submit" id='subkey' value="Aceptar" class='btn'>
  </form>
  <script src="js/Keys.js"></script>
</body>

</html>