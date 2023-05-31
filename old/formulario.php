<!DOCTYPE html>
<html>
<head>
	<title>Formulario FSC</title>
	<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires'); // Configurar el horario a Argentina (-3)
      // Configuración de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "FSC";
    $peso_ult = 0;

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }
    $sql = "SELECT peso FROM tabla_peso ORDER BY tiempo DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // Obtener valor de peso
      $row = $result->fetch_assoc();
      $peso_ult = intval($row["peso"]); // Convertir a entero
    } else {
      $peso_ult = "0";
  }


    $conn->close();
	?>

  <script type="text/javascript" src="loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],

          ['gramos', <?php 
                 
                                                
                         echo $peso_ult;
                    ?>]
        ]);

        var options = {
          width: 800, height: 800,
          greenFrom:0, greenTo:250,
          redFrom: 900, redTo: 1000,
          yellowFrom:750, yellowTo: 900,
          minorTicks: 5,
          max:1000
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        
      }
    </script>




</head>
<body>
	<h1>Formulario Materia prima - Bobina  </h1>
	<form action="procesar.php" method="get">
    
  <table>
  <tr>
    <th><label for="peso">Peso: [gramos]</label></th>
    <th><input type="number" id="peso" name="peso"></th>
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



  <div id="chart_div" ></div>
  <?php echo "peso_ult:".$peso_ult;  ?>

  <meta http-equiv="refresh" content="10;/mediciones/fsc/formulario.php">
</body>
</html>
