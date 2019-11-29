<?php
include("sesion.php");
$pagina='proveedoresModificarPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
include('sql/update.php');
$idProveedor = $_REQUEST['idProveedor'];
include('sql/mostrarProveedor.php');



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
        <h3 class="card-header primary-color white-text">Modificar Proveedor</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="Nombre" value="<?php echo $ProNombre; ?>">
                  <label for="form1" class="">Nombre</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="Cuit" value="<?php echo $ProCuit; ?>">
                  <label for="form2" class="">CUIT</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="CondicionIVA" value="<?php echo $ProCondicionIva; ?>">
                  <label for="form3" class="">Condicion IVA</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="Domicilio" value="<?php echo $ProDomicilio; ?>">
                  <label for="form3" class="">Domicilio</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <div class="custom-control custom-checkbox">
                    <?php
                    if ($Prete == 1){
                      echo "<input type='checkbox' class='custom-control-input' id='defaultUnchecked' name='rete' checked>
                      <label class='custom-control-label' for='defaultUnchecked'>¿ Es retensor ?</label>";
                     }
                    else {
                      echo "<input type='checkbox' class='custom-control-input' id='defaultUnchecked' name='rete' >
                      <label class='custom-control-label' for='defaultUnchecked'>¿ Es retensor ?</label>";
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="number" id="form3"  step="any"  min="0" class="form-control" name="aumento">
                  <label for="form3" class="">Agregar % de aumento</label>
                </div>
              </div>
            </div>
            <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-success">
            <input type="reset" name="" value="Cancelar" class="btn btn-info" onClick="location.href='proveedores.php'">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Actualizar'])){
                $rete = filter_input(INPUT_POST, 'rete', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                if($rete){
                  $rete = 1;
                } else {
                    $rete = 0;
                  }
                $aumento = $_POST['aumento'];
                while($rowPro= $mostrarProductos->fetch(PDO::FETCH_ASSOC)) {
                  $costoUni = $rowPro['costoUni'];
                  $prod = $rowPro['idProducto'];
                  $costoUni = (($aumento/100)*$costoUni)+$costoUni;
                  $productoAumento = updateProductosAumento($prod,$idProveedor,$costoUni);
                  $conexiones->exec($productoAumento);
                }
                $sqlMProveedor = updateProveedores($_POST['Nombre'],$_POST['Cuit'],$_POST['CondicionIVA'],$_POST['Domicilio'],$idProveedor,$rete);
                $conexiones->exec($sqlMProveedor);
                echo "<script language='javascript'>";
                echo "alert('El Proveedor se actualizo');";
                echo "window.location='proveedores.php';";
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
    window.location.href = "sql/proveedorBorrar.php?idProveedor=" + element.id;
}
</script>
</body>
</html>
