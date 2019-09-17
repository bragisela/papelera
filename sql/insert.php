<?php
  $pagina='insertPHP';

  function insertClientes($nombre,$cuit,$condicionIVA,$domicilioComercio,$domicilioFiscal){

    $sqlClientes="INSERT INTO clientes(nombre,cuit,condicionIVA,domicilioComercio,domicilioFiscal)

    VALUES ('$nombre','$cuit','$condicionIVA','$domicilioComercio','$domicilioFiscal')";

    return $sqlClientes;
  }

  function insertProductos($codProducto,$descripcion,$material,$unidadEmbalaje,$medidas,$unidadMedida){

    $sqlProductos="INSERT INTO productos(codProducto,descripcion,material,unidadEmbalaje,medidas,unidadMedida)

    VALUES('$codProducto','$descripcion','$material','$unidadEmbalaje','$medidas','$unidadMedida')";

    return $sqlProductos;
  }

  function insertProveedores($nombre,$cuit,$condicionIVA,$domicilio){

    $sqlProveedores = "INSERT INTO proveedores(nombre,cuit,condicionIVA,domicilio)

    VALUES('$nombre','$cuit','$condicionIVA','$domicilio')";

    return $sqlProveedores;
  }

  function insertComprobantes($nroComprobante, $IdCliPro, $fecha, $tipo,$justificante, $totalComprado){

    $sqlComprobantes = "INSERT INTO comprobantes(nroComprobante, IdCliPro, fecha, tipo, justificante, totalComprado)

    VALUES ('$nroComprobante', '$IdCliPro', '$fecha', '$tipo','$justificante','$totalComprado')";

    return $sqlComprobantes;
  }
  function insertCajaIngreso($fecha,$tipoMov,$tipo, $descripcion, $importe,$nroCaja){

    $sqlCajaIngreso = "INSERT INTO cajatemporal(fecha,tipoMov, tipo, descripcion, importe, nroCaja)

    VALUES ('$fecha','I', '$descripcion', '$tipo', '$importe', '0')";

    return $sqlCajaIngreso;
  }
  function insertCajaEgreso($fecha,$tipoMov, $descripcion, $importe,$nroCaja){

    $sqlCajaEgreso = "INSERT INTO cajatemporal(fecha,tipoMov, descripcion, importe, nroCaja)

    VALUES ('$fecha','E', '$descripcion','-' '$importe', '0')";

    return $sqlCajaEgreso;
  }
  function cierreCaja($fecha,$tipoMov, $descripcion, $importe,$nroCaja){

    $sqlCierreCaja = "INSERT INTO cajatemporal(fecha,tipoMov, descripcion, importe, nroCaja)

    VALUES ('$fecha','E', 'Cierre de Caja','-' '$importe', '0')";

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


?>
