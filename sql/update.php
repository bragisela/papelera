<?php
  $pagina='updatePHP';

  function updateClientes($nombre,$cuit,$condicionIVA,$domicilioComercio,$domicilioFiscal,$idCliente){

    $sqlClientesModificar="UPDATE clientes SET
    nombre = '$nombre',
    cuit = '$cuit',
    condicionIVA = '$condicionIVA',
    domicilioComercio = '$domicilioComercio',
    domicilioFiscal = '$domicilioFiscal'

    WHERE idCliente = '$idCliente'";

    return $sqlClientesModificar;
  }

  function updateProductos($codProducto,$descripcion,$material,$unidadEmbalaje,$medidas,$unidadMedida,$idProducto,$prov){

    $sqlProductosModificar="UPDATE productos SET
    codProducto = '$codProducto',
    descripcion = '$descripcion',
    material = '$material',
    unidadEmbalaje = '$unidadEmbalaje',
    medidas = '$medidas',
    unidadMedida = '$unidadMedida',
    idProveedor = '$prov'
    WHERE idProducto='$idProducto'";

    return $sqlProductosModificar;
  }
  //update aumento

  function updateProductosAumento($producto,$prov,$aumento){

    $sqlProductosModificar="UPDATE productos SET
    costoV = '$aumento'
    WHERE idProveedor='$prov' AND idProducto='$producto'";

    return $sqlProductosModificar;
  }

  function updateProductosAumento2($producto,$aumento){

    $sqlProductosModificar2="UPDATE productos SET
    costoV = '$aumento'
    WHERE  idProducto='$producto'";

    return $sqlProductosModificar2;
  }

  function updateProveedores($nombre,$cuit,$condicionIVA,$domicilio,$idProveedor,$rete){

    $sqlProveedoresModificar = "UPDATE proveedores SET
    nombre = '$nombre',
    cuit = '$cuit',
    condicionIVA = '$condicionIVA',
    domicilio = '$domicilio',
    rete = '$rete'

    WHERE idProveedor = '$idProveedor' ";

    return $sqlProveedoresModificar;
  }

  function updatePrecios($porcUtil,$idComprobante){

    $sqlPrecioAct="UPDATE precios as pre
    inner join items as i on i.idItems=pre.idPrecio
    SET pre.porcUtil='$porcUtil' where i.idComprobante='$idComprobante'";



    return $sqlPrecioAct;
  }

  function updatePreciosInd($idPrecio,$porcUtil){

    $sqlPrecioInd="UPDATE precios SET
    porcUtil = '$porcUtil'


    WHERE idPrecio='$idPrecio'";

    return $sqlPrecioInd;
  }



  function updateCajaIngreso($idCaja,$descripcion,$importe){

    $sqlCajaModificar="UPDATE cajatemporal SET
    descripcion = '$descripcion',
    importe = '$importe'

    WHERE idCaja='$idCaja'";

    return $sqlCajaModificar;
  }

  function updateCajaEgreso($idCaja,$descripcion,$importe){

    $sqlCajaModificar="UPDATE cajatemporal SET
    descripcion = '$descripcion',
    importe = '$importe'

    WHERE idCaja='$idCaja'";

    return $sqlCajaModificar;
  }

  function updateCheques($idCheque,$banco,$numero,$importe,$plazo,$activo){

    $sqlChequesModificar="UPDATE cheques SET
    banco = '$banco',
    numero = '$numero',
    importe = '$importe',
    plazo = '$plazo'
    WHERE idCheque= '$idCheque'";

    return $sqlChequesModificar;
  }

?>
