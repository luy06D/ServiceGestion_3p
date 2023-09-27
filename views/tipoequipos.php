<?php require_once '../principal/cabezera.php' ?>
  <!-- DataTable -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">



    <section class="section mt-3">
      <div class="row">
        

        <div class="col-lg-6">
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Tipos</h5>
              <button type="button" id="abrir-modal-registro-Tequipos" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modal-Tequipos">
                <i class="bi bi-plus-circle"></i> Agregar
              </button>
              <button type="button" id="abrir-modal-registro-Tequipos" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modal-RecuperarEquipos">
                <i class="bi bi-plus-circle"></i> Recuperar
              </button>

              <!-- Multi Columns Form -->
              <form class="row g-3" id="">
                <table id="tabla-Tequipos" class="table table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Tipo Equipo</th>
                      <th>Operación</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                  </tbody>
                </table>
              </form><!-- End Multi Columns Form -->

            </div>
        </div>

      </div>
    </section>





  <!-- Modal-Registrar tipo -->
  <div class="modal fade" id="modal-Tequipos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header" id="modal-registro-header1">
            <h5 class="modal-title" id="modal-titulo1"></h5>
          </div>
          <div class="modal-body">
            <form action="" id="form-Tequipos">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-text"></i></span>
                <input type="text" class="form-control" placeholder="Tipo Equipo" id="tipoequipo" ></input>
              </div>
            </form>    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="guardartipo">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
      </div>
    </div>
  </div>

  <!-- Modal-Recuperar tipo -->
  <div class="modal fade" id="modal-RecuperarEquipos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id="modal-registro-header">
          <h5 class="modal-title" id="modal-titulo2">Activar Tipos</h5>
        </div>
        <div class="modal-body">
          <!-- Multi Columns Form -->
          <!-- Horizontal Form -->
          <form id="form-tipoequiposR">
            <div class="row mb-3">
                <label for="buscador" class="col-sm-2 col-form-label">Buscar:</label>
                  <div class="col-sm-6">
                    <input type="search" class="form-control" id="buscartipoequipo" placeholder="nombre " maxlength="50"> 
                  </div>    
            </div>
          
            <div class="row mb-3">
                <label for="buscador" class="col-sm-2 col-form-label">Item:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="idtipoequipo" readonly >
                </div>
            </div>
            <div class="row mb-3">
              <label for="nombres" class="col-sm-2 col-form-label">Tipo: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="tipoE" placeholder="" maxlength="20" readonly>
                </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="activartipo">Activar</button>
              <button type="reset" class="btn btn-secondary">Cancelar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
            
          </form><!-- End Horizontal Form -->
        </div>
        
      </div>
    </div>
  </div>


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

<script src="../js/funcionAlertSweet.js"></script>

  <script>
  $(document).ready(function () {
    let datosNuevos = true;
    let idtipoequipo = 0;

    function mostrartiposE() {
      $.ajax({
        url: '../controllers/tipose.controller.php',
        type: 'GET',
        data: { 'op': 'listar_tiposE' },
        success: function (result) {
          var tabla = $("#tabla-Tequipos").DataTable();
          tabla.destroy();
          $("#tabla-Tequipos tbody").html(result);
          $("#tabla-Tequipos").DataTable({
            responsive: true,
            lengthMenu: [15, 10],
            language: {
              url: '../js/Spanish.json'
            },
            order: [[0, 'desc']]
          })
        }
      })
    }


    function registrartiposE() {
      const tipoEquip = $("#tipoequipo").val().trim();

      let datosEnviar = {
        'op': 'registrar_tiposE',
        'tipoequipo': tipoEquip
      };

      if (!datosNuevos) {
        datosEnviar['op'] = 'actualizar_tiposE';
        datosEnviar['idtipoequipo'] = idtipoequipo;
      }

      mostrarPregunta('Equipos','¿Está seguro de realizar la operación?')
      .then((result) => {
        if (result.isConfirmed) {
          if (tipoEquip === '') {
            toastFinalizar("Operación exitosa");
          } else {
            mostrarSweetAlert("Operación exitosa", "success");
            $.ajax({
              url: '../controllers/tipose.controller.php',
              type: 'GET',
              data: datosEnviar,
              success: function (result) {
                $("#form-Tequipos")[0].reset();
                mostrartiposE();
                $("#modal-Tequipos").modal('hide');
                let resultado = JSON.parse(result);
                if(resultado.status === false){
                  errorRegistrado("Está marca ya fue registrado!");
                }
              }
            })
          }
        }
      })
    }

    function buscartiposE(){
      $.ajax({
        url: '../controllers/tipose.controller.php',
        type: 'GET',
        dataType : 'JSON',
        data: {
          'op' : 'buscar_tiposE',
          'tipoequipo' : $("#buscartipoequipo").val()
        },
        success: function(result){
          console.log(result);
          if(result.length > 0){
            const tipoequipos = result[0];
            
            $("#idtipoequipo").val(tipoequipos.idtipoequipo);
            $("#tipoE").val(tipoequipos.tipoequipo);

          }else{
            errorRegistrado("No se encontró el dato requerido, vuelva intentarlo");
            $("#form-tipoequiposR")[0].reset();
          }
        },
        error: function(xhr, status, error) {
          console.error("Error en la solicitud AJAX:", error);
        }
      });
    }

    function activar_tipo(){

      mostrarPreguntaActivar()
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../controllers/tipose.controller.php',
            type: 'GET',
            data: {
              'op': 'activar_tiposE',
              'idtipoequipo': $("#idtipoequipo").val()
            },
            success: function () {
              $("#form-tipoequiposR")[0].reset();
              mostrartiposE();
              $("#modal-RecuperarEquipos").modal('hide');
            }
          });
        }
      });
    }

    function eliminartiposE(id) {
      mostrarPreguntaEliminar()
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../controllers/tipose.controller.php',
            type: 'GET',
            data: {
              'op': 'eliminar_tiposE',
              'idtipoequipo': id
            },
            success: function () {
              mostrartiposE();
            }
          });
        }
      });
    }

    function mostrardatostipos(id) {
      $("#form-Tequipos")[0].reset();

      $.ajax({
        url: '../controllers/tipose.controller.php',
        type: 'GET',
        data: {
          'op': 'obtener_tiposE',
          'idtipoequipo': id
        },
        dataType: 'JSON',
        success: function (result) {
          $("#tipoequipo").val(result.tipoequipo);
        }
      });

      $("#modal-titulo1").html("Actualizar tipo");
      $("#modal-titulo1").addClass("text-black");
      $("#modal-registro-header1").removeClass("bg-success-subtle");
      $("#modal-registro-header1").addClass("bg-warning-subtle");
      $("#guardartipo").addClass("btn btn-warning");
      $("#guardartipo").html("Actualizar");

      datosNuevos = false;
      $("#modal-Tequipos").modal("show")
    }

    function abrirmodalregistrotipos() {

      $("#modal-titulo1").html("Nuevo Tipo");
      $("#modal-titulo1").addClass("text-black");
      $("#modal-registro-header1").removeClass("bg-warning-subtle");
      $("#modal-registro-header1").addClass("bg-success-subtle");
      $("#guardar").html("Guardar");
      $("#guardartipo").removeClass("btn btn-warning");
      $("#guardartipo").addClass("btn btn-success");

      $("#form-Tequipos")[0].reset();
      datosNuevos = true;
    }

    $("#tabla-Tequipos tbody").on("click", ".eliminar", function () {
      idtipoequipo = $(this).data("idtipoequipo");
      eliminartiposE(idtipoequipo);
    });

    $("#tabla-Tequipos tbody").on("click", ".editar", function () {
      idtipoequipo = $(this).data("idtipoequipo");
      mostrardatostipos(idtipoequipo);
    });

    $("#buscartipoequipo").keypress(function(event){
      if(event.keyCode === 13) {
        buscartiposE();
      }
    });

    $("#abrir-modal-registro-Tequipos").click(abrirmodalregistrotipos);

    $("#guardartipo").click(registrartiposE);
    $("#activartipo").click(activar_tipo);
    mostrartiposE();
  })

  </script>

  <?php require_once '../principal/footer.php' ?>
