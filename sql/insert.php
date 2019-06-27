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

  function insertComprobantes($nroComprobante, $IdCliPro, $fecha, $tipo,$totalComprado){

    $sqlComprobantes = "INSERT INTO comprobantes(nroComprobante, IdCliPro, fecha, tipo,totalComprado)

    VALUES ('$nroComprobante', '$IdCliPro', '$fecha', '$tipo','$totalComprado')";

    return $sqlComprobantes;
  }
  function insertCajaIngreso($fecha,$tipoMov, $descripcion, $importe){

    $sqlCajaIngreso = "INSERT INTO cajaTemporal(fecha,tipoMov, descripcion, importe)

    VALUES ('$fecha','I', '$descripcion', '$importe')";

    return $sqlCajaIngreso;
  }
  function insertCajaEgreso($fecha,$tipoMov, $descripcion, $importe){

    $sqlCajaEgreso = "INSERT INTO cajaTemporal(fecha,tipoMov, descripcion, importe)

    VALUES ('$fecha','E', '$descripcion','-' '$importe')";

    return $sqlCajaEgreso;
  }
  function cierreCaja($fecha,$tipoMov, $descripcion, $importe){

    $sqlCierreCaja = "INSERT INTO cajaTemporal(fecha,tipoMov, descripcion, importe)

    VALUES ('$fecha','E', 'Cierre de Caja','-' '$importe')";

    return $sqlCierreCaja;
  }
?>
