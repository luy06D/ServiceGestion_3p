<?php require_once '../principal/cabezera.php' ?>
  <!-- DataTable -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">



  <div class="row">
    
    <div class="col-lg-8">
      
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Lista de Marcas</h5>
          
          <button type="button" id="abrir-modal-registro-marca" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modal-marca">
            <i class="bi bi-plus-circle"></i> Agregar
          </button>
          <!-- Multi Columns Form -->
          <form class="row g-3" id="">
            <table id="tabla-marcas" class="table table-hover" style="width:100%">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Marca</th>
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
  </div>





  <!-- Modal-Registrar Marca -->
  <div class="modal fade" id="modal-marca" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header" id="modal-registro-header">
            <h5 class="modal-title" id="modal-titulo"></h5>
          </div>
          <div class="modal-body">
            <form action="" id="form-marcas">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-text"></i></span>
                <input type="text" class="form-control" placeholder="Nueva marca" id="marca" ></input>
              </div>
            </form>    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="guardarmarca">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    let idmarca = 0;

    function mostrarmarcas() {
      $.ajax({
        url: '../controllers/marcas.controller.php',
        type: 'GET',
        data: { 'op': 'listar_marcas' },
        success: function (result) {
          var tabla = $("#tabla-marcas").DataTable();
          tabla.destroy();
          $("#tabla-marcas tbody").html(result);
          $("#tabla-marcas").DataTable({
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

    
    function registrarmarcas() {
      const marca = $("#marca").val().trim();

      let datosEnviar = {
        'op': 'registrar_marcas',
        'marca': marca
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
          if (marca === '') {
            mostrarSweetAlert("Por favor, complete los campos", "warning");
          } else {
            toastFinalizar("Operación exitosa", "success");
            $.ajax({
              url: '../controllers/marcas.controller.php',
              type: 'GET',
              data: datosEnviar,
              success: function (result) {
                $("#form-marcas")[0].reset();
                $("#modal-marca").modal('hide');
                mostrarmarcas();
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

    function eliminarmarca(id) {
      Swal.fire({
        title: '¿Está seguro de eliminar el registro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../controllers/marcas.controller.php',
            type: 'GET',
            data: {
              'op': 'eliminar_marcas',
              'idmarca': id
            },
            success: function () {
              mostrarmarcas();
            }
          });
        }
      });
    }

    function mostrardatos(id) {
      $("#form-marcas")[0].reset();

      $.ajax({
        url: '../controllers/marcas.controller.php',
        type: 'GET',
        data: {
          'op': 'obtener_marcas',
          'idmarca': id
        },
        dataType: 'JSON',
        success: function (result) {
          $("#marca").val(result.marca);
        }
      });

      $("#modal-titulo").html("Actualizar marca");
      $("#modal-titulo").addClass("text-black");
      $("#modal-registro-header").removeClass("bg-success-subtle");
      $("#modal-registro-header").addClass("bg-warning-subtle");
      $("#guardarmarca").addClass("btn btn-warning");
      $("#guardarmarca").html("Actualizar");

      datosNuevos = false;
      $("#modal-marca").modal("show")
    }

    function abrirmodalregistromarcas() {

      $("#modal-titulo").html("Nueva Marca");
      $("#modal-titulo").addClass("text-black");
      $("#modal-registro-header").removeClass("bg-warning-subtle");
      $("#modal-registro-header").addClass("bg-success-subtle");
      $("#guardarmarca").html("Guardar");
      $("#guardarmarca").removeClass("btn btn-warning");
      $("#guardarmarca").addClass("btn btn-success");

      $("#form-marcas")[0].reset();
      datosNuevos = true;
    }

    $("#tabla-marcas tbody").on("click", ".eliminar", function () {
      idmarca = $(this).data("idmarca");
      eliminarmarca(idmarca);
    });

    $("#tabla-marcas tbody").on("click", ".editar", function () {
      idmarca = $(this).data("idmarca");
      mostrardatos(idmarca);
    });

    $("#abrir-modal-registro-marca").click(abrirmodalregistromarcas);

    $("#guardarmarca").click(registrarmarcas);
    mostrarmarcas();
  })

  </script>

  <?php require_once '../principal/footer.php'; ?>

