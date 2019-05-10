<?php
include_once("../sql/conexion.php");

  if($_REQUEST['idProveedor']) {
    $sqlProve = $conexiones->query("SELECT cuit,condicionIVA,domicilio FROM proveedores WHERE idProveedor='".$_REQUEST['idProveedor']."'")
    or die ('No se puede traer listado de este Proveedor'.mysqli_error($conexiones));

    $data = array();
    while($rowProv = $sqlProve->fetch(PDO::FETCH_ASSOC)) {
      $data = $rowProv;
    }
    echo json_encode($data);
    } else {
	     echo '';
     }
?>
