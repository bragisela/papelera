<?php
include("sesion.php");
$pagina='clientesPHP';
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
        <h3 class="card-header primary-color white-text">Formulario de Cliente</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="Nombre">
                  <label for="form1" class="">Nombre</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="Cuit">
                  <label for="form2" class="">CUIT</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="CondicionIVA">
                  <label for="form3" class="">Condicion IVA</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="DomicilioComercio">
                  <label for="form3" class="">Domicilio Comercio</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="DomicilioFiscal">
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
                $sql = insertClientes($_POST['Nombre'],$_POST['Cuit'],$_POST['CondicionIVA'],$_POST['DomicilioComercio'],$_POST['DomicilioFiscal']);
                $conexiones->exec($sql);
                echo "<script language='javascript'>";
                echo "alert('El Cliente se ingreso correctamente');";
                echo "window.location='clientes.php';";
                echo "</script>";
              }
            ?>
        </div>
      </div>
      <br>
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Busqueda de Clientes</h3>
        <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Nombre</th>
                <th class="th-sm">Domicilio Comercio</th>
                <th class="th-sm">Domicilio Fiscal</th>
                <th class="th-sm">CUIT</th>
                <th class="th-sm">Condicion IVA</th>
                <th class="th-sm">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($rowClientes = $resultadoClientes->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <td><?php echo $rowClientes['nombre']; $idCliente = $rowClientes['idCliente']; ?></td>
                <td><?php echo $rowClientes['domicilioComercio']; ?></td>
                <td><?php echo $rowClientes['domicilioFiscal']; ?></td>
                <td><?php echo $rowClientes['cuit']; ?></td>
                <td><?php echo $rowClientes['condicionIVA']; ?></td>
                <td><?php echo "
                <a href='clientesModificar.php?idCliente=$idCliente'><i class='far fa-edit'></i></i></a>
                <a onClick='pDelete(this);' id='$idCliente'><i class='far fa-trash-alt'></i></a>"; ?></td>
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
    window.location.href = "sql/clientesBorrar.php?idCliente=" + element.id;
}

</script>
</body>
</html>
