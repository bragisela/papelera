<?php

  include('conexion.php');

  $idComprobante = $_REQUEST['idComprobante'];


  $conexiones->exec("DELETE FROM comprobantes WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  $conexiones->exec("DELETE FROM items WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

//me falta eliminar precio


  header("Location:../pedidosBuscar.php");
?>
