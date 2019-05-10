<?php

  $pagina = 'mostrarClientePHP';
  include('conexion.php');
  $mostrarCliente = $conexiones->query("SELECT nombre,cuit,condicionIVA,domicilioComercio,domicilioFiscal FROM clientes WHERE idCliente = $idCliente")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowCliente = $mostrarCliente->fetch(PDO::FETCH_ASSOC);

  $CliNombre = $rowCliente['nombre'];
  $CliCuit = $rowCliente['cuit'];
  $CliCondicionIva = $rowCliente['condicionIVA'];
  $CliDomicilioComercio = $rowCliente['domicilioComercio'];
  $CliDomicilioFiscal = $rowCliente['domicilioFiscal'];

?>
