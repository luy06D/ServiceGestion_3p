<?php require_once '../principal/cabezera.php'; ?>
  <!-- DataTable -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">



    <section class="section mt-3">
      <div class="row"> <!-- row justify-content-center align-items-center --> 
        <div class="col-lg-6">
          <div class="card"> <!-- card mx-auto -->
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
                <div class="row mb-3">
                  <label for="serie" class="col-sm-2 col-form-label">N° de serie</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="serie" placeholder="Escriba aquí">
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

        <div class="col-lg-12">
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
                      <th>N° serie</th>
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
        const marcaid = $("#idmarca").val().trim();
        const descripcion = $("#descripcion").val().trim();
        const numSerie = $("#serie").val().trim();

        let datosEnviar ={
          'op'            :   'registrar_equipos',
          'idtipoequipo'  :   tipoequip,
          'idmarca'       :   marcaid,
          'descripcion'   :   descripcion,
          'numSerie'      :   numSerie
        };

        if(!datosNuevos){
          datosEnviar['op'] = 'actualizar_equipos';
          datosEnviar['idequipo'] = idequipo;
        }
        mostrarPregunta('Equipos','¿Está seguro de realizar la operación?')
       .then((result) => {
          if (result.isConfirmed){
            if(tipoequip === '' || marcaid ==='' || descripcion==='' || numSerie === ''){
              completeCampos();
            }else{
              toastFinalizar("Operación exitosa");
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


<?php require_once '../principal/footer.php'; ?>
