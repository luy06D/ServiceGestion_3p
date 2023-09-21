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
          <li class="breadcrumb-item"><a href="tipoequipos.php">Tipos</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        

        <div class="col-lg-8">
          <button type="button" id="abrir-modal-registro-Tequipos" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-Tequipos">
            <i class="bi bi-plus-circle"></i> Agregar
          </button>
          

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Marcas</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" id="">
                <table id="tabla-Tequipos" class="table table-striped nowrap" style="width:100%">
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

  </main><!-- End #main -->



  <!-- Modal-Registrar Marca -->
  <div class="modal fade" id="modal-Tequipos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header" id="modal-registro-header">
            <h5 class="modal-title" id="modal-titulo"></h5>
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

    function mostrarSweetAlert(title, icon, text, timer = 1500) {
      Swal.fire({
        title: title,
        icon: icon,
        text: text,
        showConfirmButton: false,
        timer: timer
      });
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
          if (tipoEquip === '') {
            mostrarSweetAlert("Por favor, complete los campos", "warning");
          } else {
            mostrarSweetAlert("Operación exitosa", "success");
            $.ajax({
              url: '../controllers/tipose.controller.php',
              type: 'GET',
              data: datosEnviar,
              success: function (result) {
                $("#form-Tequipos")[0].reset();
                mostrartiposE();
                let resultado = JSON.parse(result);
                if(resultado.status === false){
                  mostrarSweetAlert("Este tipo ya esta registrado!","warning");
                }
              }
            })
          }
        }
      })
    }

    function eliminartiposE(id) {
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

    function mostrardatos(id) {
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

      $("#modal-titulo").html("Actualizar tipo");
      $("#modal-titulo").addClass("text-black");
      $("#modal-registro-header").removeClass("bg-success-subtle");
      $("#modal-registro-header").addClass("bg-warning-subtle");
      $("#guardar").addClass("btn btn-warning");
      $("#guardar").html("Actualizar");

      datosNuevos = false;
      $("#modal-Tequipos").modal("show")
    }

    function abrirmodalregistro() {

      $("#modal-titulo").html("Registro de tipo");
      $("#modal-titulo").addClass("text-black");
      $("#modal-registro-header").removeClass("bg-warning-subtle");
      $("#modal-registro-header").addClass("bg-success-subtle");
      $("#guardar").html("Guardar");
      $("#guardar").removeClass("btn btn-warning");
      $("#guardar").addClass("btn btn-success");

      $("#form-Tequipos")[0].reset();
      datosNuevos = true;
    }

    $("#tabla-Tequipos tbody").on("click", ".eliminar", function () {
      idtipoequipo = $(this).data("idtipoequipo");
      eliminartiposE(idtipoequipo);
    });

    $("#tabla-Tequipos tbody").on("click", ".editar", function () {
      idtipoequipo = $(this).data("idtipoequipo");
      mostrardatos(idtipoequipo);
    });

    $("#abrir-modal-registro-Tequipos").click(abrirmodalregistro);

    $("#guardar").click(registrartiposE);
    mostrartiposE();
  })

  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<?php require_once '../principal/footer.php'?>