<?php
  include('conexion.php');

$numPedido = $conexiones->query("SELECT nroComprobante as numero from comprobantes
where tipo='V' and justificante='R'
order by idComprobante DESC limit 1")
or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

$rowpe= $numPedido->fetch(PDO::FETCH_ASSOC);

$numero = $rowpe['numero'];



?>
