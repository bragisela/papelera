<?php

require('conexion.php');

$getRepCaja = $conexiones->query("SELECT idCajaTotal,fecha, descripcion, importe, nroCaja
from caja
GROUP by idCajaTotal");

$getRepUtil = $conexiones->query("SELECT idUtilidad, comprobante, impUtilidad, fecha, tipo
from utilidad
GROUP by comprobante");


?>
