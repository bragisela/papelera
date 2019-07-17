<?php
include("sesion.php");
$pagina='clientesModificarPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
$idCliente = $_REQUEST['idCliente'];
include('sql/mostrarCliente.php');
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
                  <input type="text" id="form1" class="form-control" name="Nombre" value="<?php echo $CliNombre ?>">
                  <label for="form1" class="">Nombre</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="Cuit" value="<?php echo $CliCuit ?>">
                  <label for="form2" class="">CUIT</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="CondicionIVA" value="<?php echo $CliCondicionIva ?>">
                  <label for="form3" class="">Condicion IVA</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="DomicilioComercio" value="<?php echo $CliDomicilioComercio ?>">
                  <label for="form3" class="">Domicilio Comercio</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="DomicilioFiscal" value="<?php echo $CliDomicilioFiscal ?>">
                  <label for="form3" class="">Domicilio Fiscal</label>
                </div>
              </div>
            </div>
            <input type="submit" name="Guardar" value="Guardar" class="btn btn-success">
            <input type="reset" name="Guardar" value="Cancelar" class="btn btn-info">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Guardar'])){
                $sql = updateClientes($_POST['Nombre'],$_POST['Cuit'],$_POST['CondicionIVA'],$_POST['DomicilioComercio'],$_POST['DomicilioFiscal'],$idCliente);
                $conexiones->exec($sql);
                echo "<script language='javascript'>";
                echo "alert('El Cliente se actualizo');";
                echo "window.location='clientes.php';";
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

function pDelete(element) {
  if(confirm('Esta seguro que quiere eliminar el producto?'))
    window.location.href = "sql/clientesBorrar.php?idCliente=" + element.id;
}
</script>
</body>
</html>
