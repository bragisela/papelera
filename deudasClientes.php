<?php
include("sesion.php");
$pagina='deudaClientesSAPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include('sql/deudaClientes.php');


//INICIO EXCEL

$total_rows = 2;

$download_filelink = '<ul class="list-unstyled">';


if(isset($_POST["export"]) && isset($_POST["desde"])!="" && isset($_POST["hasta"])!="")
{
	require_once 'class/PHPExcel.php';


	$last_page = ceil($total_rows/10000);
	$start = 0;
	$file_number = 0;

	for($count = 0; $count < $last_page; $count++)
	{


		$file_number++;
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array("Cliente","Domicilio Comercio","Domicilio Fiscal", "Deuda por cliente");
		$column = 0;
    $object->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $object->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

			$column++;
		}

		$query = "
    SELECT co.fecha, co.nroComprobante, cli.idCliente, cli.nombre, cli.domicilioComercio, cli.domicilioFiscal, SUM(co.totalcomprado) as deuda from clientes as cli
    inner join comprobantes as co on cli.idCliente=co.IdCliPro
    where co.fecha BETWEEN CAST('".$_POST["desde"]."' AS DATE) AND CAST('".$_POST["hasta"]."' AS DATE)
    and co.tipo='v' and co.activo=0 group by cli.idCliente order by deuda ASC
		";
		$statement = $conexiones->prepare($query);
		$statement->execute();
		$excel_result = $statement->fetchAll();

    //recorrer array con los datos filtrados por campaña para descargar

    $excel_row = 2;
    $totalImporte=0;
		foreach($excel_result as $sub_row)
		{


      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sub_row["nombre"]);
      $object->getActiveSheet()->getColumnDimension('A')->setWidth("21");
      $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sub_row["domicilioComercio"]);
      $object->getActiveSheet()->getColumnDimension('B')->setWidth("21");
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $sub_row["domicilioFiscal"]);
      $object->getActiveSheet()->getColumnDimension('C')->setWidth("21");
			$deuda = $sub_row["deuda"];
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "$ $deuda");
      $object->getActiveSheet()->getColumnDimension('D')->setWidth("21");
      $object->getActiveSheet()->getColumnDimension('E')->setWidth("21");
      $totalImporte=$totalImporte+$sub_row["deuda"];
      $totalImporte = bcdiv($totalImporte, '1', 2);
			$excel_row++;
		}
      $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row+1, "Deuda Total:");
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row+1, "$ $totalImporte");


			// FALTA DESC, EXENTOS, NETO GRAVADO

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$file_name = 'Estado deuda '.$_POST["desde"].' a '.$_POST["hasta"].'.xls';
		$object_writer->save($file_name);
    // nombre archivo exceñ
		$download_filelink .= '<li><label><a href="download.php?filename='.$file_name.'" target="_blank">Descargar - '.$file_name.'</a></label></li>';
	}
	$download_filelink .= '</ul>';
}
else {
	echo "Seleccione una campaña";
}
// FIN EXCEL

?>
<!DOCTYPE html>
<html lang="es">
<style type="text/css">

</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Descargar listado de deudas de todos los clientes</h3>
          <form class=" text-left border border-light p-5" method="post">
            <div class="form-row mb-4">
              <div class="col-md-3 col-sm-6">
                <label>Desde</label>
                <div class="md-form" style="margin-top: -10px;">
                  <input type="date" class="form-control" name="desde" value="">
                </div>
              </div>
              <div class="col-md-3 col-sm-6" >
                <label>Hasta</label>
                <div class="md-form" style="margin-top: -10px;">
                  <input type="date" class="form-control" name="hasta" value="">
                </div>
              </div>
              <div class="md-form col-lg-2 col-md-2 col-sm-3" style="margin-top: 8px;">
                <input  type="submit" name="export" class="btn btn-success" value="Seleccionar" />
              </div>
              <div class="md-form col-lg-3 col-md-4 col-sm-12 margen7" style="margin-top: -2px;" >
                <?php echo $download_filelink; ?>
              </div>
            </div>
          </form>
      </div>
    </section>
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Estado de deudas</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Domicilio Comercio</th>
                    <th class="th-sm">Domicilio Fiscal</th>
                    <th class="th-sm">Deuda Total</th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($codRol==1) {
                  while($rowDe= $resultadoDeuda->fetch(PDO::FETCH_ASSOC)) {
                    //$activo = $rowComprobante['activo'];
                    ?>
                    <tr>
                      <td><?php $idCliente = $rowDe['idCliente']; echo $rowDe['nombre']; ?></td>
                      <td><?php echo $rowDe['domicilioComercio']; ?></td>
                      <td><?php echo $rowDe['domicilioFiscal']; ?></td>
                      <td>$ <?php echo $rowDe['deuda']; ?></td>
                      <td><?php
                      echo "
                      <a href='deudaExcel.php?idCliente=$idCliente' title='Imprimir Excel'><i class='fas fa-file-excel'></i></a>
                      " ;
                      ?></td>
                    </tr>
                    <?php
                  }
                  }
                  if ($codRol==2) {
                    while($rowComprobante= $resultadoPedidosAdmin->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php $idComprobante = $rowComprobante['idComprobante']; echo $rowComprobante['nroComprobante']; ?></td>
                      <td><?php $date = new DateTime($rowComprobante['fecha']); echo $date->format('d/m/Y'); ?></td>
                        <td><?php echo $rowComprobante['nombre']; ?></td>
                        <td><?php echo $rowComprobante['domicilioComercio']; ?></td>
                        <td><?php echo "
                        <a href='modificarPedido.php?idPedido=$idComprobante' title='Editar'><i class='far fa-edit fa-lg'></i></a>
                        <a href='detallePedidos.php?idPedido=$idComprobante' title='Ver Detalles'><i class='fas fa-asterisk'></i></a>
                        <a target='_blank' href='imprimir.php?idComprobante=$idComprobante' title='Pedido'><i class='fas fa-print fa-lg'></i></a>
                        <a target='_blank' href='imprimirRemito.php?idComprobante=$idComprobante' title='Remito'><i class='fas fa-sticky-note fa-lg'></i></a>
                        <a onClick='pDelete(this);' id='$idComprobante'><i class='far fa-trash-alt'></i></a>
                        " ; ?></td>

                      </tr>
                      <?php
                    }
                  }
                  ?>

                </tbody>
              </table>

            </div>
          </div>
      </div>
    </section>
  </div>
</main>

<?php
include("pie.php");
?>
<script>
// SideNav Button Initialization
$(".button-collapse").sideNav();
// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);

function pDelete(element) {
  if(confirm('Esta seguro que quiere eliminar la venta?'))
    window.location.href = "sql/VentaBorrar.php?idComprobante=" + element.id;
}
</script>
</body>
</html>
