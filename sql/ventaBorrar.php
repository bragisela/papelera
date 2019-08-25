<?php

  include('conexion.php');

  $idComprobante = $_REQUEST['idComprobante'];


  $conexiones->exec("DELETE FROM comprobantes WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));



  $HayComprobante = $conexiones->query("SELECT * FROM `items` WHERE  idComprobante='$idComprobante'")
  or die ('No se puede traer listado de Caja'.mysqli_error($conexiones));

  $rowHay = $HayComprobante->fetch(PDO::FETCH_ASSOC); {

  $Comprobante = $rowHay['idComprobante'];
  }

  if ($Comprobante!='') {
  $conexiones->exec("DELETE FROM items WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));
  }

//me falta eliminar precio


  header("Location:../pedidosBuscar.php");
?>
