$(document).ready(function(){
	// code to get all records from table via select box
	$("#proveedor").change(function() {
		var id = $(this).find(":selected").val();
		var dataString = 'idProveedor='+ id;
		$.ajax({
			url: 'scripts/getProveedores.php',
			dataType: "json",
			data: dataString,
			cache: false,
			success: function(dataProveedores) {
			   if(dataProveedores) {
          var cuit = dataProveedores.cuit;
          var condi = dataProveedores.condicionIVA;
          var domi = dataProveedores.domicilio;
					var retee = dataProveedores.rete;


          document.getElementById('cuit').value = cuit ;
          document.getElementById('domicilio').value = domi ;
          document.getElementById('condiIVA').value = condi ;
					document.getElementById('rete2').value = retee ;
          // $("#cuit").text(dataProveedores.cuit);
					// $("#condicionIVA").text(dataProveedores.condicionIVA);
					// $("#domicilio").text(dataProveedores.domicilio).val();
					// $("#records").show();
				}
			}
		});
 	})
});
