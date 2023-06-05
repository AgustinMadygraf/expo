<!DOCTYPE html>
<html>
<head>
  <title>Formulario velocidad</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php require 'index2.php' ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/series-label.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var vel_ult = <?php echo $vel_ult; ?>;
      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['RPM', vel_ult]
      ]);


      var options = {
    width: 500, height: 500,
    yellowColor: ['#FFFF00', '#FFFF00'],
    yellowFrom: 800, yellowTo: 900,  // Primera franja de amarillo
    greenFrom: 900, greenTo: 1000,
    yellowFrom: 1000, yellowTo: 1100,  // Primera franja de amarillo
    redFrom: 1100, redTo: 1800,
    minorTicks: 5,
    max: 1800
  };

      var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    // Función para enviar el formulario sin el parámetro "submit"
    function submitForm() {
      document.getElementById("myForm").submit();
    }
  </script>
  <script type='text/javascript'>
    $(function () {
      Highcharts.setOptions({
        global: {
          useUTC: false
        },
        lang: {
          thousandsSep: "",
          months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
        }
      });

      $('#container').highcharts({
        title: {
          text: (function() {
            return Highcharts.dateFormat("%A, %d %B %Y - %H:%M:%S", 1684431900000);
          })()
        },
        xAxis: {
          type: 'datetime',
          tickPixelInterval: 1
        },
        yAxis: {
          title: {
            text: '[RPM]'
          },
          plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
          }]
        },
        tooltip: {
          formatter: function() {
            return '<b>'+ this.series.name +'</b><br/>'+
              Highcharts.dateFormat("%A, %d %B %Y - %H:%M:%S", this.x) +'<br/>'+
              Highcharts.numberFormat(this.y, 1)+' RPM';
          }
        },
        legend: {
          enabled: true
        },
        exporting: {
          enabled: true
        },
        series: [{
          name: 'Velocidad motor ',
          animation: false,
          data: (function() {
            var data = [];
            <?php for ($i = 0; $i < count($rawdata); $i++) { 
              $unixtime_v2 = $rawdata[$i]["unixtime"] * 1000;
              echo "data.push([".$unixtime_v2.",".$rawdata[$i]["RPM"]."]);";
            } ?>
            return data;
          })()
        }]
      });
    });
  </script>
 
</head>
<body>
  <h1>Velocidad</h1>
  <div class="container">
    <div class="boxL">
      <div id="chart_div"></div>
    </div>
    <br>
    <div class="boxR">
      <div id="container" class="graf"></div>
    </div>
  </div>

  <meta http-equiv="refresh" content="60;index.php">
  <br>
  <br>
  <br>
  <a href="formulario.php">Ir a formulario</a>
</body>
</html>
