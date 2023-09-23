<?php require_once '../principal/cabezera.php'; ?>
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
                <li class="breadcrumb-item">Equipos</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Registrar Equipo</h5>

              <!-- Horizontal Form -->
              <form id="form-equipos">
                <div class="row mb-3">
                  <label for="tipoequipo" class="col-sm-2 col-form-label">Tipo Equipo:</label>
                  <div class="col-sm-10">
                    <select class="form-select" id="tipoequipo">
                      <option selected>Seleccione</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="idmarca" class="col-sm-2 col-form-label">Marca:</label>
                  <div class="col-sm-10">
                    <select class="form-select" id="idmarca">
                      <option selected>Seleccione</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" placeholder="Descripción" id="descripcion" rows="3"></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-primary" id="guardarequipo">Guardar</button>
                  <button type="reset" class="btn btn-secondary">Cancelar</button>
                </div>
              </form><!-- End Horizontal Form -->
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detalles</h5>

              <!-- Horizontal Form -->
              <form>
                <div class="row mb-3">
                  <label for="idequipo" class="col-sm-2 col-form-label">Equipo</label>
                  <div class="col-sm-10">
                      <select class="form-select" id="idequipo">
                        <option selected>Seleccione</option>
                      </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="idservicio" class="col-sm-2 col-form-label">Servicio</label>
                  <div class="col-sm-10">
                      <select class="form-select" id="idservicio">
                        <option selected>Seleccione</option>
                      </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="serie" class="col-sm-2 col-form-label">N° de serie</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="serie" placeholder="Escriba aquí">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="precio" placeholder="S/.">
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-primary" id="guardardetalle">Guardar</button>
                  <button type="reset" class="btn btn-secondary">Cancelar</button>
                </div>
              </form><!-- End Horizontal Form -->
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Equipos</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3">
                <table id="tabla-equipo" class="table table-hover" style="width:100%">
                  <thead class="table-light">
                    <tr>
                      <th>Item</th>
                      <th>Equipo</th>
                      <th>Marca</th>
                      <th>Descripción</th>
                      <!-- <th>Operación</th> -->
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
    </section>

  </main><!-- End #main -->

  <!-- Modal-Registrar Equipo -->
  <div class="modal fade" id="modal-registrar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <!-- Agrega aquí el contenido del modal si es necesario -->
  </div>

  <!-- Modal-Registrar Marca -->
  <div class="modal fade" id="modal-marca" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <!-- Agrega aquí el contenido del modal si es necesario -->
  </div>

  <!-- Modal-Registrar Tipo Equipo -->
  <div class="modal fade" id="modal-tipoeq" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <!-- Agrega aquí el contenido del modal si es necesario -->
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
      $(document).ready(function(){
          let datosNuevos = true;
          let idequipo = 0;

          function mostrardatostabla(){
              $.ajax({
                  url: '../controllers/equipos.controller.php',
                  type: 'GET',
                  data: {'op' : 'listar_equipos'},
                  success: function (result){
                      var tabla = $("#tabla-equipo").DataTable();
                      tabla.destroy();
                      $("#tabla-equipo tbody").html(result);
                      $("#tabla-equipo").DataTable({
                          responsive: true,
                          lengthMenu:[5,10],
                          language:{
                              url: '../js/Spanish.json'
                          },
                          order: [[0, 'desc']] 
                      })
                  }
              })
          }

          function mostrartipos(){
              $.ajax({
                  url: '../controllers/equipos.controller.php',
                  type: 'POST',
                  data: {'op': 'recuperarTipoEquipo'},
                  dataType : 'JSON',
                  success: function (data){
                      const listTipo = $("#tipoequipo");
                      listTipo.empty();
                      listTipo.append($('<option>',{
                          value:'',
                          text: 'Seleccione'
                      }));
                      $.each(data, function(index, element){
                          listTipo.append($('<option>',{
                              value: element.idtipoequipo,
                              text: element.tipoequipo
                          }));
                      })
                  }
              })
          }

          function mostrarmarcas(){
              $.ajax({
                  url: '../controllers/equipos.controller.php',
                  type: 'POST',
                  data: {'op': 'recuperarMarca'},
                  dataType : 'JSON',
                  success: function (data){
                      const listTipo = $("#idmarca");
                      listTipo.empty();
                      listTipo.append($('<option>',{
                          value:'',
                          text: 'Seleccione'
                      }));
                      $.each(data, function(index, element){
                          listTipo.append($('<option>',{
                              value: element.idmarca,
                              text: element.marca
                          }));
                      })
                  }
              })
          }

          function registrarEquipo(){
              const tipoequip = $("#tipoequipo").val().trim();
              const marca = $("#idmarca").val().trim();
              const descripcion = $("#descripcion").val().trim();

              let datosEnviar ={
                  'op'            :   'registrar_equipos',
                  'idtipoequipo'  :   tipoequip,
                  'idmarca'       :   marca,
                  'descripcion'   :   descripcion
              };

              if(!datosNuevos){
                  datosEnviar['op'] = 'actualizar_equipos';
                  datosEnviar['idequipo'] = idequipo;
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
                  if (result.isConfirmed){
                      if(tipoequip === '' || marca ==='' || descripcion===''){
                          mostrarSweetAlert("Por favor, complete los campos","warning");
                      }else{
                          mostrarSweetAlert("Operación exitosa","success");
                          $.ajax({
                              url: '../controllers/equipos.controller.php',
                              type: 'POST',
                              data: datosEnviar,
                              success: function(result){
                                  $("#form-equipos")[0].reset();
                                  datosNuevos = true;
                                  idequipo = 0;
                                  mostrardatostabla();
                              }
                          })
                      }
                  }
              })
          }

          $("#guardarequipo").click(registrarEquipo);

          mostrardatostabla();
          mostrartipos();
          mostrarmarcas();
      })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<?php require_once '../principal/footer.php'; ?>
