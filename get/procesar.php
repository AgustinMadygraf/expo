<?php
date_default_timezone_set('America/Argentina/Buenos_Aires'); // Configurar el horario a Argentina (-3)
$vel_ult = 0;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Eliminar registros existentes en datos.csv
    file_put_contents("datos.csv", "");

    // Obtener los datos enviados por el formulario
    $vel = $_POST['velocidad'];
    $tiempo = $_POST['tiempo'];

    // Guardar los datos en datos.csv
    $file = fopen("datos.csv", "a");
    fputcsv($file, [$vel, $tiempo]);
    fclose($file);

    // Actualizar el valor de $vel_ult con la ultima velocidad registrado
    $vel_ult = intval($vel);
}
else {
    // Obtener el velocidad de datos.csv si existe
    if (file_exists("datos.csv")) {
        $file = fopen("datos.csv", "r");
        $data = fgetcsv($file);
        $vel_ult = intval($data[0]); // Convertir a entero
        fclose($file);
    }
}

$vel_ult =123;
?>



<?php
// Obtener valores del formulario
$vel = $_GET['velocidad'];
$tiempo = $_GET['tiempo'];

// Obtener el contenido actual del archivo
$fileContent = file_get_contents("datos.csv");

// Crear un array con los nuevos datos
$newData = [$vel, $tiempo];

// Abrir el archivo en modo de escritura
$file = fopen("datos.csv", "w");

// Escribir los nuevos datos en la primera fila
fputcsv($file, $newData);

// Escribir el contenido anterior después de la primera fila
fwrite($file, $fileContent);

// Cerrar el archivo
fclose($file);

echo "Los datos han sido ingresados correctamente en la primera fila del archivo datos.csv<br>";
echo "Velocidad: " . $vel . "<br>";
echo "Tiempo: " . $tiempo;
?>

<meta http-equiv="refresh" content="1;index.php">
