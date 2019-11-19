<style>
.bla{
  color: #f1f1f1;
  font-size: 16px;
}

table {
	width: 110%;
}

</style>
<?php
include_once("../sql/conexion.php");

  $buscar = $_POST['listado'];


  if(isset($buscar)) {

    $sql2= $conexiones->query("SELECT co.idComprobante from comprobantes as co
    inner join clientes as cli on co.IdCliPro=cli.idCliente
    where cli.idCliente= ".$buscar." AND co.tipo='V' ORDER BY co.idComprobante DESC LIMIT 3 ")
    or die ('No se puede traer listado de este Cliente'.mysqli_error($conexiones));


    echo "<div class='table-wrapper-scroll-y my-custom-scrollbar'>
          <table class'table-bordered table-striped mb-0'>
            <thead>
              <tr>
                <th class='bla'>Producto</th>
                <th class='bla'>Cantidad</th>
                <th class='bla'>Precio</th>
              </tr>
            </thead>";
      echo "<tbody> ";
      while($rowCO = $sql2->fetch()) {
        $pre = $rowCO["idComprobante"];

        $sql= $conexiones->query("SELECT pro.descripcion, pre.importe, i.cant from items as i
        inner join productos as pro on i.idProducto=pro.idProducto
        inner join precios as pre on i.idItems=pre.idPrecio
        inner join comprobantes as co on co.idComprobante=i.idComprobante
        inner join clientes as cli on co.IdCliPro=cli.idCliente
        where cli.idCliente= ".$buscar." AND co.tipo='V' AND co.idComprobante= ".$pre." ")
        or die ('No se puede traer listado de este Cliente'.mysqli_error($conexiones));

        if($sql->execute()) {
            $sql->setFetchMode(PDO::FETCH_ASSOC);
        }
                  while($row = $sql->fetch()) {
                    $pre = $row["importe"];
                    $cant = $row["cant"];
                    $des = $row["descripcion"];
                   echo "<tr>
                    <td class='bla' style='width:33%;'>".$des."</td>
                    <td class='bla' style='width:33%;'>".$cant."</td>
                    <td class='bla' style='width:33%;'>$ ".$pre."</td>
                  </tr>";
                }


    }
    echo "</tbody>
       </table>
       </div>";


    }
  else {
  	echo " <h1> No se han encontrado resultados </h1>";
  }
?>
