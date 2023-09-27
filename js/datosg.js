$("#tabla-garantia tbody").on("click", ".finalizar2", function() {
  idcliente = $(this).data("idcliente");
  $("#modal-final1").modal('show');

  // Realiza una solicitud AJAX para obtener los datos del cliente
  $.ajax({
      url: '../controllers/garantia.controller.php',
      type: 'GET',
      data: {
          'operacion': 'filtroG_cliente',
          'idcliente': idcliente
      },
      success: function(result) {
          // Agrega una línea para verificar los datos recibidos
          console.log(result);

          // Parsea los datos JSON recibidos
          var data = JSON.parse(result);

          // Agrega líneas para verificar los datos después del parseo
          console.log(data);

          // Rellena los campos del segundo modal con los datos
          $("#detallesI").html("<p>Nombre del cliente: " + data.clientes + "</p>");
          $("#detallesI").append("<p>Servicio: " + data.nombreservicio + "</p>");
          $("#detallesI").append("<p>Técnico: " + data.Tecnico + "</p>");
          $("#detallesI").append("<p>Fecha Avería: " + data.fechaAveria + "</p>");
          $("#detallesI").append("<p>Fecha Ejecución: " + data.fechaEjecucion + "</p>");

          // Puedes continuar agregando más campos según tus necesidades

      }
  });
});