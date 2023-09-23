<?php require_once '../principal/cabezera.php' ?>
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- DataTable -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Equipos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item"><a href="marcas.php">Marcas</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        

        <div class="col-lg-8">
          <button type="button" id="abrir-modal-registro-marca" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-marca">
            <i class="bi bi-plus-circle"></i> Agregar
          </button>
          

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Marcas</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" id="">
                <table id="tabla-marcas" class="table table-striped nowrap" style="width:100%">
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

  </main><!-- End #main -->



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
            <button type="button" class="btn btn-success" id="guardar">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
      </div>
    </div>
  </div>

  


  <!-- CDN sweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- AJAX = JavaScript asincrónico-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <!-- datatable-->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            mostrarSweetAlert("Operación exitosa", "success");
            $.ajax({
              url: '../controllers/marcas.controller.php',
              type: 'GET',
              data: datosEnviar,
              success: function (result) {
                $("#form-marcas")[0].reset();
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
      $("#guardar").addClass("btn btn-warning");
      $("#guardar").html("Actualizar");

      datosNuevos = false;
      $("#modal-marca").modal("show")
    }

    function abrirmodalregistro() {

      $("#modal-titulo").html("Registro de marca");
      $("#modal-titulo").addClass("text-black");
      $("#modal-registro-header").removeClass("bg-warning-subtle");
      $("#modal-registro-header").addClass("bg-success-subtle");
      $("#guardar").html("Guardar");
      $("#guardar").removeClass("btn btn-warning");
      $("#guardar").addClass("btn btn-success");

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

    $("#abrir-modal-registro-marca").click(abrirmodalregistro);

    $("#guardar").click(registrarmarcas);
    mostrarmarcas();
  })

  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<?php require_once '../principal/footer.php'?>