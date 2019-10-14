<?php

  include('conexion.php');

  $idComprobante = $_REQUEST['idComprobante'];

  //borrar inventario
  $conexiones->exec("DELETE FROM inventario WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  //Preguntar si hay pagos
  $HayPagos = $conexiones->query("SELECT * FROM `pagos` WHERE  idComprobante='$idComprobante'")
  or die ('No se puede traer listado de Caja'.mysqli_error($conexiones));
  $rowHayP = $HayPagos->fetch(PDO::FETCH_ASSOC); {
  $idPago = $rowHayP['idPago'];
  }
  if ($idPago!='') {
    //borrar pago si hay
  $conexiones->exec("DELETE FROM pagos WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));
  }

  //Borrar comprobantes
  $conexiones->exec("DELETE FROM comprobantes WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  $HayComprobante = $conexiones->query("SELECT * FROM `items` WHERE  idComprobante='$idComprobante'")
  or die ('No se puede traer listado de Caja'.mysqli_error($conexiones));

  $rowHay = $HayComprobante->fetch(PDO::FETCH_ASSOC); {

  $Comprobante = $rowHay['idComprobante'];
  }

  if ($Comprobante!='') {
  $conexiones->exec("DELETE FROM items WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));
  }




  header("Location:../pedidosBuscar.php");
?>
