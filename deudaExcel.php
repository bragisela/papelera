<?php
include("sesion.php");
$pagina='reporteComprasPHP';
include("encabezado.php");
include("sql/conexion.php");
include("seguridad.php");
$fech = Date("Y-m-d");
$Fecha = Date("Y-m-d H:i:s");
$idCliente = $_REQUEST["idCliente"];
include("sql/deudaExcel.php");
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
		$table_columns = array("Fecha Emision","Nro Comprobante", "Total comprado", "Saldo Comp.");
		$column = 0;
    $object->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Apellido y Nombre:");
    $object->getActiveSheet()->getColumnDimension('A')->setWidth("21");
    $object->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Tomas Tenaglia");
    $object->getActiveSheet()->getColumnDimension('B')->setWidth("18");
    $object->getActiveSheet()->setCellValueByColumnAndRow(0, 2, "Domicilio Comercial: ");
    $object->getActiveSheet()->setCellValueByColumnAndRow(1,2, "Rivadavia");
    $object->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "Condicion IVA: ");
    $object->getActiveSheet()->getColumnDimension('C')->setWidth("15");
    $object->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "responsable");
    $object->getActiveSheet()->getColumnDimension('D')->setWidth("15");
    $object->getActiveSheet()->setCellValueByColumnAndRow(2, 2, "Cuit: ");
    $object->getActiveSheet()->setCellValueByColumnAndRow(3, 2, "20-42294806-8");


    $object->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $object->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);

			$column++;
		}

		$query = "
    SELECT co.fecha, co.totalComprado,co.nroComprobante, co.tipo from comprobantes as co
    inner join clientes as cli on cli.idCliente=co.IdCliPro
    where co.fecha BETWEEN CAST('".$_POST["desde"]."' AS DATE) AND CAST('".$_POST["hasta"]."' AS DATE)
    and cli.idCliente = '".$idCliente."' and co.tipo='v' and co.activo=0
		";
		$statement = $conexiones->prepare($query);
		$statement->execute();
		$excel_result = $statement->fetchAll();

    //recorrer array con los datos filtrados por campaña para descargar

    $excel_row = 5;
    $totalImporte=0;
		foreach($excel_result as $sub_row)
		{



			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sub_row["fecha"]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sub_row["nroComprobante"]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $sub_row["totalComprado"]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $sub_row["totalComprado"]);
      $totalImporte=$totalImporte+$sub_row["totalComprado"];
      $totalImporte = bcdiv($totalImporte, '1', 2);
			$excel_row++;
		}
      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row+1, "Saldo acumulado:");
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row+1, $totalImporte);
      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row+2, "Saldo Final:");
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row+2, $totalImporte);

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
<style>

</style>
<body class="hidden-sn mdb-skin">
  <main>
    <div class="container-fluid mt-5">
      <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Descargar estado deuda de <?php echo $nombre; ?></h3>
        <form class=" text-left border border-light p-5" method="post">

          <div class="form-row mb-4">

            <div class="col-md-3 col-sm-6">
              <label>Desde</label>
              <div class="md-form" style="margin-top: -10px;">
                <input type="date" class="form-control" name="desde" value="<?php echo $fech; ?>">
              </div>
            </div>

            <div class="col-md-3 col-sm-6" >
              <label>Hasta</label>
              <div class="md-form" style="margin-top: -10px;">
                <input type="date" class="form-control" name="hasta" value="<?php echo $fech; ?>">
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
    </div>
  </main>
<!--Main Layout-->

<?php
include("pie.php");
?>
<script>

$(document).ready(function() {
  $('.mdb-select').materialSelect();
});
// SideNav Button Initialization
$(".button-collapse").sideNav();
// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);


</script>
</body>
</html>
