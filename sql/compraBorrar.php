<?php

  include('conexion.php');

  $idCompra = $_REQUEST['idCompra'];

  $conexiones->exec("DELETE FROM comprobantes WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM items WHERE idComprobante='$idCompra'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

//me falta eliminar precio


  header("Location:../comprasBuscar.php");
?>
