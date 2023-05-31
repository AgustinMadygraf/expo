<?php
// Obtener valores del formulario
$vel = $_POST['velocidad'];
$tiempo = $_POST['tiempo'];

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
