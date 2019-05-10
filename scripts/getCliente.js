$(document).ready(function(){

	$("#cliente").change(function() {
		var id = $(this).find(":selected").val();
		var dataString = 'idCliente='+ id;
		$.ajax({
			url: 'scripts/getCliente.php',
			dataType: "json",
			data: dataString,
			cache: false,
			success: function(dataCliente) {
			   if(dataCliente) {
          var cuit = dataCliente.cuit;
          var condi = dataCliente.condicionIVA;
          var domi = dataCliente.domicilioComercio;

          document.getElementById('cuit').value = cuit ;
          document.getElementById('domicilio').value = domi ;
          document.getElementById('condiIVA').value = condi;
				}
			}
		});
 	})
});
