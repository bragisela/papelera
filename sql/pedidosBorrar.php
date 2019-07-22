<?php
  $pagina='pedidosBorrarPHP';
  include('conexion.php');

  $idProducto = $_REQUEST['idProducto'];

  $conexiones->exec("DELETE FROM predidos WHERE idComprobante='$idComprobante'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../pedidosBuscar.php");
?>
