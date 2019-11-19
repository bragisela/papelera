<?php
include_once("../sql/conexion.php");

  if($_REQUEST['idCliente']) {
    $sqlCompro = $conexiones->query(" SELECT co.idComprobante from comprobantes as co
    inner join clientes as cli on cli.idCliente=co.IdCliPro
    where cli.idCliente='".$_REQUEST['idCliente']."' AND co.tipo='V' ")
    or die ('No se puede traer listado de este Cliente'.mysqli_error($conexiones));

    $data = array();
    while($rowClie = $sqlCompro->fetch(PDO::FETCH_ASSOC)) {
      $data = $rowClie;
    }
    echo json_encode($data);
    } else {
	     echo '';
     }
?>
