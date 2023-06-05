<?php
function conectarBD(){
  $servername = "localhost";
  $username = "root";
  $password = "12345678";
  $dbname = "expo";

  // Crear conexión
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Verificar conexión
  if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
  }

  return $conn;
}

function desconectarBD($conn){
  mysqli_close($conn);
}
?>
