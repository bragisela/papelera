<?php
include_once("../sql/conexion.php");

  if($_REQUEST['idCliente']) {
    $sqlClie = $conexiones->query("SELECT cuit, condicionIVA, domicilioComercio FROM clientes WHERE idCliente='".$_REQUEST['idCliente']."'")
    or die ('No se puede traer listado de este Cliente'.mysqli_error($conexiones));

    $data = array();
    while($rowClie = $sqlClie->fetch(PDO::FETCH_ASSOC)) {
      $data = $rowClie;
    }
    echo json_encode($data);
    } else {
	     echo '';
     }
?>
