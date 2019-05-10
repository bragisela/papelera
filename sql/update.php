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

  function updateProductos($codProducto,$descripcion,$material,$unidadEmbalaje,$medidas,$unidadMedida,$idProducto){

    $sqlProductosModificar="UPDATE productos SET
    codProducto = '$codProducto',
    descripcion = '$descripcion',
    material = '$material',
    unidadEmbalaje = '$unidadEmbalaje',
    medidas = '$medidas',
    unidadMedida = '$unidadMedida'

    WHERE idProducto='$idProducto'";

    return $sqlProductosModificar;
  }

  function updateProveedores($nombre,$cuit,$condicionIVA,$domicilio,$idProveedor){

    $sqlProveedoresModificar = "UPDATE proveedores SET
    nombre = '$nombre',
    cuit = '$cuit',
    condicionIVA = '$condicionIVA',
    domicilio = '$domicilio'

    WHERE idProveedor = '$idProveedor' ";

    return $sqlProveedoresModificar;
  }

?>
