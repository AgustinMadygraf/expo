<h1>Peso</h1>
<form id="myForm" action="procesar.php" method="get">
  <table>
    <tr>
      <td><label for="Peso">Peso: [RPM]</label></td>
      <td><input type="number" id="Peso" name="Peso"></td>
    </tr>
    <tr>
      <td><label>Tiempo:</label></td>
      <td><input value="<?= date('Y-m-d H:i:s') ?>" readonly></td>
    </tr>
    <tr>
      <td></td>
      <td><button onclick="submitForm()">Enviar</button></td>
    </tr>
  </table>
  <a href="index.php">Ir a gráfico</a>

</form>
