<!DOCTYPE html>

<?php
        if (file_exists("datos.csv")) {
            $file = fopen("datos.csv", "r");
            $data = fgetcsv($file);
            fclose($file);
            $vel_ult = intval($data[0]);
        }
        echo "vel_ult:".$vel_ult;
    ?>

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
                greenFrom:1200, greenTo:1500,
                redFrom: 1500, redTo: 1800,
                yellowFrom:500, yellowTo: 1200,
                minorTicks: 5,
                max:1800
            };

            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1>Velocidad máquina</h1>
    <form action="procesar.php" method="get">
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
   

    <meta http-equiv="refresh" content="60;index.php">
</body>
</html>
