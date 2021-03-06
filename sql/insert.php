<?php
  $pagina='insertPHP';

  function insertClientes($nombre,$cuit,$condicionIVA,$domicilioComercio,$domicilioFiscal){

    $sqlClientes="INSERT INTO clientes(nombre,cuit,condicionIVA,domicilioComercio,domicilioFiscal)

    VALUES ('$nombre','$cuit','$condicionIVA','$domicilioComercio','$domicilioFiscal')";

    return $sqlClientes;
  }

  function insertProductos($codProducto,$descripcion,$material,$unidadEmbalaje,$medidas,$unidadMedida,$prov){

    $sqlProductos="INSERT INTO productos(codProducto,descripcion,material,unidadEmbalaje,medidas,unidadMedida,idProveedor)

    VALUES('$codProducto','$descripcion','$material','$unidadEmbalaje','$medidas','$unidadMedida','$prov')";

    return $sqlProductos;
  }

  function insertProveedores($nombre,$cuit,$condicionIVA,$domicilio,$rete){

    $sqlProveedores = "INSERT INTO proveedores(nombre,cuit,condicionIVA,domicilio,rete)

    VALUES('$nombre','$cuit','$condicionIVA','$domicilio','$rete')";

    return $sqlProveedores;
  }

  function insertComprobantes($nroComprobante, $IdCliPro, $fecha, $tipo,$justificante, $totalComprado, $activo ,$tempPago){

    $sqlComprobantes = "INSERT INTO comprobantes(nroComprobante, IdCliPro, fecha, tipo, justificante, totalComprado, activo, tempPago)

    VALUES ('$nroComprobante', '$IdCliPro', '$fecha', '$tipo','$justificante','$totalComprado','$activo','$tempPago')";

    return $sqlComprobantes;
  }
  function insertCajaIngreso($fecha,$tipoMov,$tipo, $idComprobante, $descripcion, $importe,$nroCaja){

    $sqlCajaIngreso = "INSERT INTO cajatemporal(fecha,tipoMov, tipo, idComprobante, descripcion, importe, nroCaja)

    VALUES ('$fecha','I', '$tipo', '$idComprobante','$descripcion', '$importe', '0')";

    return $sqlCajaIngreso;
  }
  // no incerta el id del comprobante
  function insertCajaEgreso($fecha,$tipoMov, $tipo, $idComprobante, $descripcion, $importe,$nroCaja){

    $sqlCajaEgreso = "INSERT INTO cajatemporal(fecha,tipoMov, tipo, idComprobante,descripcion, importe, nroCaja)

    VALUES ('$fecha','E', '$tipo','$idComprobante' ,'$descripcion','-' '$importe', '0')";

    return $sqlCajaEgreso;
  }
  function cierreCaja($fecha,$tipoMov,$tipo, $idComprobante,$descripcion, $importe,$nroCaja){

    $sqlCierreCaja = "INSERT INTO cajatemporal(fecha,tipoMov,tipo, idComprobante, descripcion, importe, nroCaja)

    VALUES ('$fecha','E', '$tipo', '$idComprobante','Cierre de Caja','-' '$importe', '0' )";

    return $sqlCierreCaja;
  }

  function temporalaCaja(){ //inserte toda la tabla temporal en la de caja.

    $sqlTemporalaCaja = "INSERT INTO caja SELECT * FROM cajatemporal";

    return $sqlTemporalaCaja;
  }

  function resetCajaTemporal(){//vacía la tabla temporal.

    $sqlResetTemporal = "DELETE FROM cajatemporal";

    return $sqlResetTemporal;
  }

  function incNroCaja(){//incrementa el número de caja antes de migrarlo.

    $sqlincNroCaja = "UPDATE cajatemporal SET nroCaja = ((SELECT MAX(nroCaja) FROM caja )+1)";

    return $sqlincNroCaja;
  }

  function insertPagos($modoPago,$banco,$importe,$numero,$plazo,$idComprobante,$activo){

    $sqlPagos="INSERT INTO pagos(modoPago,banco,importe,numero,plazo,idComprobante,activo)

    VALUES ('$modoPago','$banco','$importe','$numero','$plazo','$idComprobante','$activo')";

    return $sqlPagos;
  }

  function insertcheque($modoPago,$banco,$importe,$numero,$plazo,$activo){

    $sqlPagos="INSERT INTO cheques(modoPago,banco,importe,numero,plazo,activo)

    VALUES ('$modoPago','$banco','$importe','$numero','$plazo','$activo')";

    return $sqlPagos;
  }




?>
