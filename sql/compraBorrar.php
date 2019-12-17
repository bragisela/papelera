<?php

  include('conexion.php');

  $idCompra = $_REQUEST['idCompra'];

  $conexiones->exec("DELETE FROM items WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja del item'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM inventario WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja del inventario'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM pagos WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja del pagos'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM comprobantes WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja del comprobante'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM utilidad WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja de la utilidad'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM cajaTemporal WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja de la caja'.mysqli_error($conexiones));


//me falta eliminar precio


  header("Location:../comprasBuscar.php");
?>
