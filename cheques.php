<?php
include("sesion.php");
$pagina='chequesPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');


?>
<!DOCTYPE html>
<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Formulario de Cheques</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-3 mb-3">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="banco">
                  <label for="form1" class="">Banco</label>
                </div>
              </div>

                            <div class="col-md-3 mb-3">
                              <div class="md-form">
                                <input type="text" id="form3" class="form-control" name="numero">
                                <label for="form3" class="">Numero</label>
                              </div>
                            </div>
              <div class="col-md-3 mb-3">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="importe">
                  <label for="form2" class="">Importe</label>
                </div>
              </div>


              <div class="col-md-3 mb-3">
                <div class="md-form">
                  <input type="date" id="form3" class="form-control" name="plazo">
                  <label for="form3" class="">Plazo</label>
                </div>
              </div>
            </div>
            <input type="submit" name="Guardar" value="Guardar" class="btn btn-success">
            <input type="reset" name="Guardar" value="Cancelar" class="btn btn-info">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Guardar'])){
                $sql = insertCheque("Propio",$_POST['banco'],$_POST['importe'],$_POST['numero'],$_POST['plazo'],0);
                $conexiones->exec($sql);
                echo "<script language='javascript'>";
                echo "alert('El cheque se ingreso correctamente');";
                echo "window.location='cheques.php';";
                echo "</script>";
              }
            ?>
        </div>
      </div>
      <br>
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Busqueda de cheques</h3>
        <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Banco</th>
                <th class="th-sm">Numero</th>
                <th class="th-sm">Importe</th>
                <th class="th-sm">Fecha</th>
                <th class="th-sm">Disponible</th>
                <th class="th-sm">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($rowChe = $resultadoCheques->fetch(PDO::FETCH_ASSOC)) {
            
                	$pplazo=date("d/m/Y", strtotime($rowChe['plazo']));
                $activo = $rowChe['activo'];
              ?>
              <tr>
                <td><?php echo $rowChe['banco']; $idCheque = $rowChe['idCheque']; ?></td>
                <td><?php echo $rowChe['numero']; ?></td>
                <td><?php echo $rowChe['importe']; ?></td>
                <td><?php echo $pplazo; ?></td>
                <td><?php if ($activo == 1) {
                  echo "Ya se realizo un pago";
                } else {
                  echo "Si";
                } ?></td>
                <td><?php echo "
                <a  href='modificarCheque.php?idCheque=$idCheque'><i class='far fa-edit'></i></a>
                <a  onClick='pDelete(this);' id='$idCheque'><i class='fas fa-trash-alt'></i></a>"; ?></td>
              </tr>
              <?php
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
  if(confirm('Esta seguro que quiere eliminar el producto?'))
    window.location.href = "sql/ChequeBorrar.php?idCheque=" + element.id;
}

</script>
</body>
</html>
