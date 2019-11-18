<?php
include("sesion.php");
$pagina='chequesPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
$idCheque = $_REQUEST['idCheque'];
include('sql/mostrarCheque.php');
include('sql/update.php');
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
        <h3 class="card-header primary-color white-text">Formulario de Cliente</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="banco" value="<?php echo $CheBanco ?>">
                  <label for="form1" class="">Banco</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="numero" value="<?php echo $CheNumero ?>">
                  <label for="form2" class="">Numero</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="number" id="form3" class="form-control" name="importe" value="<?php echo $CheImporte ?>">
                  <label for="form3" class="">Importe</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="plazo" value="<?php echo $ChePlazo ?>">
                  <label for="form3" class="">Plazo</label>
                </div>
              </div>
            </div>
            <input type="submit" name="Guardar" value="Guardar" class="btn btn-success">
            <input type="reset" name="Cancelar" value="Volver" class="btn btn-info" onClick="location.href='cheques.php'">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Guardar'])){
                $sql = updateCheques($idCheque,$_POST['banco'],$_POST['numero'],$_POST['importe'],$_POST['plazo'],$CheActivo);
                $conexiones->exec($sql);
                echo "<script language='javascript'>";
                echo "alert('El Cheque se actualizo');";
                echo "window.location='cheques.php';";
                echo "</script>";
              }
            ?>
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


</script>
</body>
</html>
