<?php
include("sesion.php");
$pagina='reportesCajaPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/consultas.php");
include("sql/listados.php");

//INICIO EXCEL

$total_rows = $getRepCaja->rowCount();

$download_filelink = '<ul class="list-unstyled">';

if(isset($_POST["export"]) && isset($_POST["caja_no"])!="")
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
		$table_columns = array("Fecha","Operacion","Descripcion","Importe");
		$column = 0;
		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$query = "
    SELECT idCajaTotal,fecha, tipoMov, descripcion, importe, nroCaja
    from caja
		WHERE nroCaja=".$_POST["caja_no"]."
    GROUP by idCajaTotal
		";
		$statement = $conexiones->prepare($query);
		$statement->execute();
		$excel_result = $statement->fetchAll();
		$excel_row = 2;

    //recorrer array con los datos filtrados por caja para descargar
		foreach($excel_result as $sub_row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sub_row["fecha"]);
			If($sub_row["tipoMov"]=="I"){
				$tipoMov="Venta";
			} else{
				$tipoMov="Compra";
			}
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $tipoMov);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $sub_row["descripcion"]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $sub_row["importe"]);
			$excel_row++;
		}
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$file_name = 'ReporteCaja-'.($_POST["caja_no"]).'.xls';
		$object_writer->save($file_name);
    // nombre archivo exceñ
		$download_filelink .= '<li><label><a href="download.php?filename='.$file_name.'" target="_blank">Descargar - '.$file_name.'</a></label></li>';
	}
	$download_filelink .= '</ul>';
}
else {
	echo "Seleccione un número de caja";
}
// FIN EXCEL

?>

<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->

<main>
  <div class="container-fluid">
   <section id="margen2">
      <form class=" text-left border border-light p-5" method="post">
         <div class="form-row mb-4">
           <div class="col-md-3 col-sm-6" >
               <select name="caja_no"  class="mdb-select md-form" searchable="Nro de caja..">
                 <option value="" disabled selected>Elija el número de caja</option>
                   <?php //Select de los números de caja.
                     while($rowCaja = $resultadoCajaInd->fetch(PDO::FETCH_ASSOC)) {
                       ?>
                         <option value="<?php echo $rowCaja['nroCaja']; ?>"><?php echo  $rowCaja['nroCaja']; ?></option>
                       <?php
                     }
                   ?>
               </select>
               <label class="mdb-main-label">Caja</label>
           </div>

           <div class="md-form col-lg-3 col-md-4  col-sm-6  margen7 ">
             <input type="submit" name="export" class="btn btn-success" value="Seleccionar" />
           </div>

           <div class="md-form col-lg-3 col-md-4 col-sm-12 margen7" >
             <?php echo $download_filelink; ?>
           </div>

         </div>
      </form>
   </section>

    <section >
    	<table   class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
      	<thead>
        	<tr>
          	<th class="th-sm">Fecha</th>
			<th class="th-sm">Operacion</th>
            <th class="th-sm">Descripcion</th>
            <th class="th-sm">Importe</th>
          </tr>
        </thead>
      	<tbody>
          <?php
					if (isset($_POST["export"]) && isset($_POST["caja_no"])!=""){
          	while($rowCaja = $getRepCaja->fetch(PDO::FETCH_ASSOC)) {
							if(($_POST["caja_no"])==($rowCaja['nroCaja']) ) {
								echo "<tr>";
								echo "<th>" . $rowCaja['fecha'] . "</th>";
							
									If($rowCaja['tipoMov']=="I"){
										$tipoMov="Venta";
										
									} else{
										$tipoMov="Compra";
									}
								echo "<th>" . $tipoMov . "</th>";
								echo "<th>" . $rowCaja['descripcion'] . "</th>";
								echo "<th>" . $rowCaja['importe'] . "</th>";
								 		}
							 		}
						 		}
                 ?>
        </tbody>
      </table>
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
const ps = new PerfectScrollbar(sideNavScrollbar);
//Ps.initialize(sideNavScrollbar);

$(document).ready(function() {
  $('.mdb-select').materialSelect();
});

</script>
</body>
</html>
