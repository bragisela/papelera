<?php
include('conexion.php');

$resultadoRepCaja= $conexiones->query("SELECT idCajaTotal, fecha, nroCaja, descripcion  FROM caja ORDER BY idCajaTotal ASC")
or die ('No se puede traer listado de campañas'.mysqli_error($conexiones));
 ?>
