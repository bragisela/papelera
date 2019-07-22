<?php
  $pagina='pedidosBorrarPHP';
  include('conexion.php');

  $idComprobante = $_REQUEST['idComprobante'];

  $conexiones->exec("DELETE FROM comprobantes WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../pedidosBuscar.php");
?>
