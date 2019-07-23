<!DOCTYPE html>
<!--Footer-->
<footer class="page-footer pt-0 mt-5" style="position: fixed;width: 100%; bottom: 0;height:50px;">

  <!--Copyright-->
  <div class="footer-copyright py-3 text-center">
    <div class="container-fluid">
      &copy; 2019 <a href="https://www.natbragroup.com" target="_blank">By NatBra</a> |
      <i class="icon-large icon-envelope"></i><a href="mailto:soporte@natbragroup.com"> soporte@natbragroup.com </a>  |
      <i class="icon-large icon-comments"></i> (02344) 15-400085 |
      <i class="icon-large icon-cogs"></i> <a href="https://soporte.natbragroup.com" target="_blank"> https://soporte.natbragroup.com</a>

    </div>
  </div>
  <!--/.Copyright-->

</footer>


<!--/.Footer-->
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="js/addons/datatables.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.AllDataTables').DataTable({
      language: {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });
    $('.dataTables_length').addClass('bs-select');
  });
</script>
