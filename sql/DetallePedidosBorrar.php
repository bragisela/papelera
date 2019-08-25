<?php
  $pagina='pedidosBorrarPHP';
  include('conexion.php');

  $idItems = $_REQUEST['idItems'];

  $Pedido = $conexiones->query("SELECT * FROM `items` WHERE  idItems='$idItems'")
  or die ('No se puede traer listado de Caja'.mysqli_error($conexiones));

  $rowPedido= $Pedido->fetch(PDO::FETCH_ASSOC);
  $idPedido = $rowPedido['idComprobante'];


  $conexiones->exec("DELETE FROM items WHERE idItems='$idItems'")or die ('Problemas en la Baja'.mysqli_error($conexiones));
  $conexiones->exec("DELETE FROM precios WHERE idPrecio='$idItems'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  echo "<script language='javascript'>";
  echo "alert('El pedido fue modificado exitosamente');";
  echo "window.location='../modificarPedido.php?idPedido=$idPedido';";
 echo "</script>";
?>
