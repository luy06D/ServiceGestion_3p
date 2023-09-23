<?php include '../principal/cabezera.php' ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- DataTable -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

<main id="main" class="main">
  <section class="section">
    <div class="row">
<<<<<<< HEAD
      <div class="col-lg-8">
=======
      <div class="col-lg-12">
>>>>>>> fe233f570b2983049fb6150ee77ed1e607cd37b4
        <div class="card">
          <div class="card-body mt-3">
            <h4 class="text-center">Registro de Servicios</h4>
            <hr>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success mt-4 mb-4" data-bs-toggle="modal" data-bs-target="#modal-registrar">
              <i class="bi bi-plus-circle"></i> Nuevo
            </button>
<<<<<<< HEAD
            <form action="">
              <table class="table table-striped nowrap" id="tabla-servicio">
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Tipo de servicio</th>
                    <th>Nombre de Servicio</th>
                    <th>Precio Estimado</th>
                    <th>operacion</th>
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

=======
            <!-- Table with stripped rows -->
            <table class="table datatable" id="tabla-servicio">
              <thead>
                <tr>
                  <th scope="col">Codigo</th>
                  <th scope="col">Tipo de servicio</th>
                  <th scope="col">Nombre de Servicio</th>
                  <th scope="col">Precio Estimado</th>
                  <th scope="col">operacion</th>
                </tr>
              </thead>
              <tbody>
                <!-- Aquí se llenará la tabla con los datos -->
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

>>>>>>> fe233f570b2983049fb6150ee77ed1e607cd37b4
<!-- Modal -->
<div class="modal fade" id="modal-registrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Servicios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-servicios">
          <div class="col-lg-12">
            <div class="input-group mt-4">
              <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add'></i></label>
              <input type="text" placeholder="Tipo de Servicio" class="form-control" id="tipos">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="input-group mt-4">
              <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add'></i></label>
              <input type="text" placeholder="Nombre de Servicio" class="form-control" id="nombres">
            </div>
          </div>
          <div class="col-lg-12 d-grid ">
            <div class="input-group mt-4">
              <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add'></i></label>
              <input type="text" placeholder="Precio Estimado" class="form-control" id="precioe">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="Registrar" class="btn btn-success">Registrar</button>
      </div>
    </div>
  </div>
</div>

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

<<<<<<< HEAD
<script src="../js/funcionAlertSweet.js"></script>
=======
>>>>>>> fe233f570b2983049fb6150ee77ed1e607cd37b4
<script>
  $(document).ready(function () {
    let datosNuevos = true;
    let idservicio = 0;

    const btnAgregar = document.querySelector('#Registrar');

    function ListarServicio() {
      $.ajax({
        url: '../controllers/servicios.controller.php',
        type: 'GET',
        data: { 'operacion': 'ListarServicios' },
        success: function (result) {
          var table = $("#tabla-servicio").DataTable();
          table.destroy();
          $("#tabla-servicio tbody").html(result);
          $("#tabla-servicio").DataTable({
            responsive: true,
            lengthMenu: [10, 5],
            language: {
              url: '../js/Spanish.json'
            },
            order: [[0, 'desc']]
          });
        }
      })
    }

    function registrarServicios() {
  const TipoS = document.querySelector("#tipos").value.trim();
  const NombreS = document.querySelector("#nombres").value.trim();
  const PrecioE = document.querySelector("#precioe").value.trim();

  let datosEnviar = {
    'tiposervicio': $("#tipos").val(),
    'nombreservicio': $("#nombres").val(),
    'precioestimado': $("#precioe").val(),
  };

  if (!datosNuevos) {
    datosEnviar['operacion'] = "Update";
    datosEnviar['idservicio'] = idservicio;
  } else {
    datosEnviar['operacion'] = 'RegistrarServicio';
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
      if (TipoS === '' || NombreS === '' || PrecioE === '') {
<<<<<<< HEAD
        mostrarSweetAlert("Complete los campos por favor", "warning");
      } else {
        mostrarSweetAlert("Servicio registrado correctamente", "success");

        $.ajax({
          url: '../controllers/servicios.controller.php',
          type: 'GET',
          data: datosEnviar,
          success: function (result) {
            $("#form-servicios")[0].reset();
            ListarServicio();
            $("#modal-registrar").modal('hide');
            datosNuevos = true; // Restablecer datosNuevos a true después de una operación exitosa
            let resultados = JSON.parse(result);

            if(resultados.status === false){
              mostrarSweetAlert("Este servicio ya a sido registrado", "warning");
            }
          }
        });
=======
        Swal.fire({
          title: "Por favor, complete los campos",
          icon: "warning",
          confirmButtonColor: "#E43D2C",
        });
      } else {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Operación exitosa',
          showConfirmButton: false,
          timer: 1500
        })

        $.ajax({
          url: '../controllers/servicios.controller.php',
          type: 'GET',
          data: datosEnviar,
          success: function (result) {
            $("#form-servicios")[0].reset();
            ListarServicio();
            $("#modal-registrar").modal('hide');
            datosNuevos = true; // Restablecer datosNuevos a true después de una operación exitosa
          }
        });
>>>>>>> fe233f570b2983049fb6150ee77ed1e607cd37b4
      }
    }
  });
}


  function mostrarDatos(id) {
  $("#form-servicios")[0].reset();
  idservicio = id;

  $.ajax({
    url: '../controllers/servicios.controller.php',
    type: 'GET',
    data: {
      'operacion': 'Obtener',
      'idservicio': id
    },
    dataType: 'JSON',
    success: function (result) {
      $("#tipos").val(result.tiposervicio);
      $("#nombres").val(result.nombreservicio);
      $("#precioe").val(result.precioestimado);
      datosNuevos = false; // Cambiar a false para habilitar la edición
    }
  });
}

    function eliminar(id) {
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
            url: '../controllers/servicios.controller.php',
            type: 'GET',
            data: {
              'operacion': 'eliminar',
              'idservicio': id
            },
            success: function () {
              ListarServicio();
            }
          });
        }
      });
    }

    $("#tabla-servicio tbody").on("click", ".editar", function () {
      idservicio = $(this).data("idservicio");
      mostrarDatos(idservicio);
    });

    $("#tabla-servicio tbody").on("click", ".eliminar", function () {
      idservicio = $(this).data("idservicio");
      eliminar(idservicio);
    });

    ListarServicio();
    $("#Registrar").click(registrarServicios);
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> fe233f570b2983049fb6150ee77ed1e607cd37b4
