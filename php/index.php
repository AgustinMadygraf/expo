<?php
date_default_timezone_set('America/Argentina/Buenos_Aires'); // Configurar el horario a Argentina (-3)
$vel_ult = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario FSC</title>
    <script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['[RPM]', <?php echo $vel_ult; ?>]
            ]);

            var options = {
                width: 800, height: 800,
                greenFrom:0, greenTo:250,
                redFrom: 900, redTo: 1500,
                yellowFrom:750, yellowTo: 900,
                minorTicks: 5,
                max:1500
            };

            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1> Velocidad máquina</h1>
    <form action="procesar.php" method="post">
        <table>
            <tr>
                <th><label for="velocidad">RPM</label></th>
                <th><input type="number" id="velocidad" name="velocidad"></th>
            </tr> 
            <tr>
                <th><label>Tiempo:</label></th>
                <th><input value="<?php echo date('Y-m-d H:i:s'); ?>" readonly></th>
            </tr> 
            <tr>
                <th></th>
                <th><input type="hidden" id="tiempo" name="tiempo" value="<?php echo time(); ?>"></th>
            </tr>
            <tr>
                <th colspan="2"><input type="submit" name="submit" value="Enviar"></th>
            </tr>
        </table>
    </form>

    <div id="chart_div"></div>
    <?php echo "vel_ult:".$vel_ult; ?>

    <meta http-equiv="refresh" content="60;index.php">
</body>
</html>
