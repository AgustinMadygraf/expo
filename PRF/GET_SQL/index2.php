<?php
    
    date_default_timezone_set('America/Argentina/Buenos_Aires'); // Configurar el horario a Argentina (-3)
    // Configuración de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "expo";
    $vel_ult = 0;

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
      die("Error de conexión a la base de datos: " . $conn->connect_error);
    }
    $sql = "SELECT RPM FROM velocidad ORDER BY unixtime DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // Obtener valor de velocidad
      $row = $result->fetch_assoc();
      $vel_ult = intval($row["RPM"]); // Convertir a entero
    } else {
      $vel_ult = "0";
    }

    $conn->close();
    //echo "vel_ult:".$vel_ult;
    function conectarBD(){  $server = "localhost";
      $usuario = "root";
      $pass = "12345678";
      $BD = "expo";
       //variable que guarda la conexi�n de la base de datos
      $conexion = mysqli_connect($server, $usuario, $pass, $BD);
      //Comprobamos si la conexi�n ha tenido exito
      if(!$conexion){ echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>'; }
      //devolvemos el objeto de conexi�n para usarlo en las consultas
      return $conexion;
    }

function desconectarBD($conexion){ //Cierra la conexi�n y guarda el estado de la operaci�n en una variable
                  $close = mysqli_close($conexion);
                  //Comprobamos si se ha cerrado la conexi�n correctamente
                  if(!$close){ echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>'; }
                  //devuelve el estado del cierre de conexi�n
                  return $close;
                }
function getArraySQL($sql){
          //Creamos la conexi�n
          $conexion = conectarBD();
          //generamos la consulta
          if(!$result = mysqli_query($conexion, $sql)) die();
          $rawdata = array();
          //guardamos en un array multidimensional todos los datos de la consulta
          $i=0;
          while($row = mysqli_fetch_array($result)){ //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
                                                      $rawdata[$i] = $row;
                                                      $i++;
                                                    }
          //Cerramos la base de datossssss
          desconectarBD($conexion);
          //devolvemos rawdata
          return $rawdata;
      }


      $sql = "SELECT `unixtime`, `RPM` from `velocidad` ORDER BY `velocidad`.`unixtime` DESC";
      //Array Multidimensional
      //echo "sql = ".$sql."<br.>";
      $rawdata = getArraySQL($sql);


?>
