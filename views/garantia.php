<?php require_once '../principal/cabezera.php'; ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">

<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body mt-3">
            <h4 class="text-center">Registro de Servicios</h4>
            <hr>
            <button type="button" id="abrir-modal-registro-personas" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-garantia">
              <i class="bi bi-plus-circle"></i> Nuevo
            </button>
            <form action="">
              <table class="table table-striped nowrap" id="tabla-garantia">
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Servicio</th>
                    <th>Tecnico</th>
                    <th>Fecha averia</th>
                    <th>Fecha ejecución</th>
                    <th>Problema detectado</th>
                    <th>Solucion</th>
                    <th>Estado</th>
                    <th>INSITU</th>
                    <th>Operacion</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Aquí se llenará la tabla con los datos -->
                </tbody>
              </table>
            </form>
            <!-- Table with stripped rows -->
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Modal Body -->
<div class="modal fade" id="modal-garantia" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">Nuevo Usuario</h5>
      </div>
      <div class="modal-body">
        <form action="" id="form-garantia">
          <div class="row">

          <div class="input-group flex-nowrap mb-2">
              <span class="input-group-text" id=""><i class="bi bi-search"></i></span>
              <input type="text" class="form-control" id="b-cliente" placeholder="Buscar aqui......." aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off">
            </div>
            <div class="list-group mt-4" id="clientes_buscados">

            </div>
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                <select name="" id="servicio" class="form-select"></select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                <input type="text" class="form-control" id="tecnico" placeholder="Tecnico" maxlength="30">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-vcard"></i></strong></span>
                <input type="date" class="form-control" id="fechaA" placeholder="fechaAveria">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                <input type="text" class="form-control" id="problema" placeholder="Problema detectado" maxlength="50">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone"></i></span>
                <input type="tel" class="form-control" id="solucion" placeholder="Solución" maxlength="9">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                <select name="" id="insitu" class="form-select">
                  <option value="">Seleccionar</option>
                  <option value="Local">Local</option>
                  <option value="A Domicilio">A Domicilio</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success" id="Registrar">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-final1" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modal-registro-header" >
                    <h5 class="modal-title card-title" id="modal-titulo">Finalizar Contrato</h5>
                </div>
                <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Detalles del contrato</h4>
                      <div class="row">
                        <div id="detallesI" class="col-6">
                        <!-- datos asincronos -->                       
                        </div>  
                        <div id="detallesD" class="col-6">
                          <!-- datos asincronos -->
                        </div>                         
                      </div> 
                      <div class="col-6 col-md-6 col-lg-5">
                            <label for="finalizada" class="form-label">Fecha Cierre</label>
                            <input type="date" class="form-control" id="finalizada">
                      </div>               
                  </div>
              </div>          
                <div class="modal-footer">           
                    <button type="button" class="btn btn-primary shadow-lg" id="btnFinalizar">Cerrar contrato</button>
                    <button type="button" class="btn btn-secondary shadow-lg" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/datosg.js"></script>

<!-- sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AJAX = JavaScript asincrónico-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- datatable-->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<!-- opcional-->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function () {

    const btGuardar = $("#Registrar");


    function ListarGarantia(){
      $.ajax({
        url: '../controllers/garantia.controller.php',
        type: 'GET',
        data: { 'operacion': 'Listar' },
        success: function (result) {
          var table = $("#tabla-garantia").DataTable();
          table.destroy();
          $("#tabla-garantia tbody").html(result);
          $("#tabla-garantia").DataTable({
            responsive: true,
            lengthMenu: [10, 5],
            order: [[0, 'desc']],
            language: {
              url: '../js/Spanish.json'
            },
            columnDefs:[
                {
                  responsivePriority: 1, // Ajusta la prioridad según tus necesidades
                  targets: [7], // Índice de la columna estado
                  render: function (data, type, row) {
                    if (type === 'display') {
                      if (data === "N") {
                        return '<span class="badge bg-danger text-white">No iniciado</span>';
                      } else if (data === "P") {
                        return '<span class="badge bg-warning text-white">En proceso</span>';
                      } else {
                        return '<span class="badge bg-success text-white">Finalizado</span>';
                      }
                    }
                    return data;
                  }
                }
            ]
          });
        }
      })
    }



    function registrargarantia() {
      const servicio = document.querySelector("#servicio").value.trim();
      const tecnico = document.querySelector("#Tecnico").value.trim();
      const fecha = document.querySelector("#fechaA").value.trim();
      const problema = document.querySelector("#problema").value.trim();
      const solucion = document.querySelector("#solucion").value.trim();
      const insitu = document.querySelector("#insitu").value.trim();
      

      let datosEnviar = {
        'operacion'         : 'registrar_garantia',
        'iddescServicio'    : $("#servicio").val(),
        'idSoporteTecnico'  : $("#Tecnico").val(),
        'fechaA'            : $("#fechaA").val(),
        'problema'          : $("#problema").val(),
        'solucion'          : $("#solucion").val(),
        'insitu'            : $("#insitu").val(),
      };

      if (!datosNuevos) {
        datosEnviar['op'] = 'actualizar_marcas';
        datosEnviar['idmarca'] = idmarca;
      }

      Swal.fire({
        title: '¿Está seguro de realizar la operación?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3F974F',
        cancelButtonColor: '#3085d6',
      }).then((result) => {
        if (result.isConfirmed) {
          if (servicio === '' || tecnico === '' || fecha === '' || problema === '' || solucion === '' || insitu === '' ) {
            mostrarSweetAlert("Por favor, complete los campos", "warning");
          } else {
            toastFinalizar("Operación exitosa", "success");
            $.ajax({
              url: '../controllers/garantia.controller.php',
              type: 'GET',
              data: datosEnviar,
              success: function (result) {
                $("#form-garantia")[0].reset();
                $("#modal-garantia").modal('hide');
                ListarGarantia();
                let resultado = JSON.parse(result);
                if(resultado.status === false){
                  mostrarSweetAlert("Esta marca ya esta registrada!","warning");
                }
              }
            })
          }
        }
      })
    }

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



    function cliente_buscar(){

          clearTimeout(searchTimer);

          searchTimer = setTimeout(function (){
            const searchTerm = $("#b-cliente").val();

            if(searchTerm.trim() === ""){

              $("#clientes_buscados").empty();
              return;

            }

            $.ajax({
            url:'../controllers/garantia.controller.php',
            type: 'GET',
            dataType: 'JSON',
            data: {
              'operacion': 'buscar',
              'search': $("#b-cliente").val()
            },
            success: function(result){

              $("#clientes_buscados").empty();

              if(result.length > 0){

                for(let i=0 ; i < result.length; i++){
                  const cliente = result[i];
                  const listaClientes = `
                  <button type="button" value="${cliente.idcliente}" 
                  class="list-group-item list-group-item-action cliente-btn">${cliente.clientes}</button>            
                  `;

                  $("#clientes_buscados").append(listaClientes);
                }
              }else {
                $("#clientes_buscados").html("<p>No se encontro el cliente </p>");
              }

              $(".cliente-btn").dblclick(function(){    
                idcliente = $(this).val();        
                selecCliente = $(this).text();

                console.log(idcliente);

                $("#cliente").val(selecCliente);
                $("#cliente-id").val(idcliente);
                

                $("#modal-buscar").modal('hide');

                $("#b-cliente").val(""); 
                $("#clientes_buscados").empty();
                
                
              })

            }

          })

          }, 500);

          }





    $("#tabla-garantia tbody").on("click", ".finalizar2", function(){            
        
        fechaC = $(this).data("fechaEjecucion");

        // if(fechaC === ''){
          idgarantia = $(this).data("idgarantia");
          $("#modal-final1").modal('show');
          //ListarGarantia(idgarantia);

        // }else{
        //   idgarantia = $(this).data("idgarantia");
        //   $("#modal-final2").modal('show');
        //   // detalleContratoFinal(idgarantia);
        // }
        


    });


    $("#Registrar").click(registrargarantia);
    
    $("#b-cliente").keyup(cliente_buscar);


    ListarGarantia();
  });


</script>
</body>

</html>

<?php include '../principal/footer.php' ?>
