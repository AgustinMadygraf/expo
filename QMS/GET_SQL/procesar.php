<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "fsc";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener valores del formulario
$peso = $_GET['peso'];
$tiempo = $_GET['tiempo'];

// Verificar si $_GET['tiempo'] está vacío y asignar time en su lugar
if (empty($tiempo)) {
    $tiempo = time();
}


// Insertar datos en la base de datos
$sql = "INSERT INTO tabla_peso (peso, unixtime) VALUES ('$peso', '$tiempo')";

if ($conn->query($sql) === TRUE) {
    
    echo "Los datos han sido ingresados correctamente en la primera fila del archivo datos.csv<br>";
    echo "peso: " . $peso . "<br>";
    echo "Tiempo: " . $tiempo;
    

    
} else {
    echo "Error al ingresar datos: " . $conn->error;
}

// Cerrar conexión a la base de datos
$conn->close();


?>
<meta http-equiv="refresh" content="1;formulario.php">
