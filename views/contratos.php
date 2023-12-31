
  <?php include '../principal/cabezera.php' ?>



<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">

<main id="main" class="main">

    

<div class="pagetitle">
      <h1>Módulo contratos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Contratos</li>        
        </ol>
      </nav>
    </div><!-- End Page Title -->

      <!-- Modal-Registrar Cliente  -->
      <div class="modal fade" id="modal-registrar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary" id="modal-registro-header" >
                    <h5 class="modal-title text-white" id="modal-titulo">Nuevo Cliente</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-clientes">
                    <div class="row">
                      
                      <fieldset class="row mb-3 mb-2">
                    <legend class="col-form-label">Entidad Cliente</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="rbPersona" value="option1" checked onchange="cambioInput()">
                        <label class="form-check-label" for="gridRadios1">
                          Persona
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="rbEmpresa" value="option2" onchange="cambioInput()">
                        <label class="form-check-label" for="gridRadios2">
                          Empresa
                        </label>
                      </div>                  
                    </div>
                  </fieldset>
                    <hr>
                    
                      <div class="mb-3 col-lg-6" >
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i id="icon-emp" class='bx bx-user' ></i></span>
                          <input type="text" class="form-control" placeholder="Nombres" maxlength="50" id="nombres">
                          <input type="hidden" class="form-control" placeholder="rsocial" maxlength="50" id="rsocial">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i id="icon-ruc" class='bx bx-user' ></i></span>
                          <input type="text" class="form-control" placeholder="Apellidos" maxlength="50" id="apellidos">
                          <input type="hidden" class="form-control" placeholder="ruc" maxlength="50" id="ruc">                          
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="span-dni"><i class='bx bx-id-card'></i></span>
                          <input type="text" class="form-control" placeholder="Número DNI" maxlength="8" id="dni">
                        </div>  
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="span-correo"><i class="bi bi-envelope"></i></span>
                          <input type="email" class="form-control" placeholder="Correo" maxlength="50" id="correo">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="span-direccion"><i class="bi bi-geo-alt"></i></span>
                          <input type="text" class="form-control" placeholder="Dirección" maxlength="50" id="direccion">
                        </div>
                      </div>
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="span-telefono"><i class='bx bx-phone' ></i></span>
                          <input type="tel" class="form-control" placeholder="900-000-000" maxlength="9" id="telefono">
                        </div>  
                      </div>
                    </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary shadow-lg" id="btcliente">Guardar</button>
                    <button type="button" class="btn btn-secondary shadow-lg" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body mt-4">
              <!-- <h5 class="card-title">Bor</h5> -->

              <!-- Borde -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="tab-cotizacion" data-bs-toggle="tab" data-bs-target="#bordered-cotizacion" type="button" role="tab" aria-controls="coti" aria-selected="false">Cotización</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Contratos</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Filtro</button>
                </li>              
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">   

                <div class="tab-pane fade show active" id="bordered-cotizacion" role="tabpanel" aria-labelledby="tab-cotizacion">
                  <!-- INICIO CONTENIDO COTIZACIÓN  -->
                  <div class="">                    
                    <section class="section">
                            <div class="row">
                                <div class="col-lg-12  col-sm-12"> <!-- Primera columna -->
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Datos generales</h5>
                                            <!-- Formulario Registrar contratos -->
                                            <form class="row g-3" id="form-cotizacion">
                                                <!-- Contenido del formulario -->
                                                <!-- <div class="col-md-6">
                                                <label for="inputState" class="form-label">Cliente</label>
                                                <select id="idcliente" class="form-select">
                                                  <option>Seleccione</option>
                                                  
                                                </select>
                                                </div> -->
                                                <div class="col-md-4">
                                                  <label for="clienteC" class="form-label">Cliente</label>
                                                  <input type="text"  class="form-control" id="clienteC">
                                                </div>
                                                <!-- Campo oculto para almacenar el ID del cliente -->
                                                <input type="hidden" id="cliente-id" name="cliente-id">

                                                <div class="col-md-4">
                                                  <label for="fechaCotizacion" class="form-label">Fecha Cotización</label>
                                                  <input type="date" class="form-control" id="fechaCotizacion">
                                                </div>                                                                                                                                       
                                              
                                                <!-- <h5 class="card-title">Descripción </h5> -->
                                                <div class="col-md-4">
                                                    <label for="lsTipoEquipo" class="form-label">Tipo Equipo</label>
                                                    <select id="lsTipoEquipo" class="form-select">
                                                      <option>Seleccione</option>
                                                      
                                                    </select>
                                                </div> 
                                                <div class="col-md-4">
                                                    <label for="lsEquipos" class="form-label">Equipos</label>
                                                    <select id="lsEquipos" class="form-select">
                                                      <option>Seleccione</option>
                                                      
                                                    </select>
                                                </div>
                                                                                                                                                                                                              
                                                <div class="">
                                                <button id="exportar" class="btn btn-danger" type="button"><i class="bi bi-file-earmark-pdf"></i></button>                                    
                                                  <button type="reset" class="btn btn-secondary shadow-lg">Limpiar</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                            
                            </div>                       
                              
                    </section>            
                  </div>

                  

                  <!-- FIN DE COTIZACION  -->
                </div>

                <div class="tab-pane fade" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  
                  <!-- INICIO DEL CONTENIDO DEL REGISTRO  -->

                      <div class="">
                                      
                        <button type="button" id="abrir-modal-registro" class="btn btn-primary btn-md mb-3 mt-3 shadow-lg" data-bs-toggle="modal" data-bs-target="#modal-registrar">
                            <i class="bi bi-plus-circle"></i>  Nuevo cliente
                        </button>


                        <section class="section">
                          <div class="row">
                              <div class="col-lg-12  col-sm-12"> <!-- Primera columna -->
                                  <div class="card">
                                      <div class="card-body">
                                          <h5 class="card-title">Registro de contrato</h5>
                                          <!-- Formulario Registrar contratos -->
                                          <form class="row g-3" id="form-contratos">
                                              <!-- Contenido del formulario -->
                                              <!-- <div class="col-md-6">
                                              <label for="inputState" class="form-label">Cliente</label>
                                              <select id="idcliente" class="form-select">
                                                <option>Seleccione</option>
                                                
                                              </select>
                                              </div> -->
                                              <div class="col-md-4">
                                                <label for="cliente" class="form-label">Cliente</label>
                                                <input type="text"  class="form-control" id="cliente">
                                              </div>
                                              <!-- Campo oculto para almacenar el ID del cliente -->
                                              <input type="hidden" id="cliente-id" name="cliente-id">

                                              <div class="col-md-4">
                                                <label for="fechainicio" class="form-label">Fecha inicio</label>
                                                <input type="date" class="form-control" id="fechainicio">
                                              </div>
                                              <div class="col-md-4">
                                                <label for="inputPassword5" class="form-label">Garantia</label>
                                                <input type="text" class="form-control" id="garantia">
                                              </div>                                              
                                            
                                            
                                              <h5 class="card-title">Detalles </h5>
                                              <div class="col-md-4">
                                                  <label for="lsTipoService" class="form-label">Tipo Servicio</label>
                                                  <select id="lsTipoService" class="form-select">
                                                    <option>Seleccione</option>
                                                    
                                                  </select>
                                              </div> 
                                              <div class="col-md-4">
                                                  <label for="lsServicios" class="form-label">Servicio</label>
                                                  <select id="lsServicios" class="form-select">
                                                    <option>Seleccione</option>
                                                    
                                                  </select>
                                              </div>
                                              <div class="col-md-4">
                                                <label for="precio" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="precio">
                                              </div>
                                              <div class="col-md-4">
                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad">
                                              </div>                                       
                                              <div class="col-md-6">
                                                <label for="observacion" class="form-label">Observación</label>
                                                <textarea class="form-control" id="observacion" rows="3"></textarea>
                                              </div>
                                        
                                              <div class="">
                                                <button type="button" id="btnContrato" class="btn btn-primary shadow-lg">Registrar</button>
                                                <button type="reset" class="btn btn-secondary shadow-lg">Limpiar</button>
                                              </div>

                                          </form>
                                      </div>
                                  </div>
                              </div>
                                          
                          </div>
                            <!-- Modal buscar cliente -->        
                            <div class="modal fade" id="modal-buscar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" id="" >
                                            <h5 class="modal-title card-title" id="">Buscar cliente</h5>
                                        </div>
                                        <div class="modal-body">
                                        <div class="input-group flex-nowrap mb-2">
                                          <span class="input-group-text" id=""><i class="bi bi-search"></i></span>
                                          <input type="text" class="form-control" id="b-cliente" placeholder="Buscar aqui......." aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off">
                                        </div>
                                        <div class="list-group mt-4" id="clientes_buscados">

                                        </div>
                                        <div class="modal-footer">           
                                            
                                            <button type="button" class="btn btn-secondary shadow-lg" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                      </div>
                                </div>
                            </div>

                        </section>

                                  <div class="col-lg-12 col-sm-12"> <!-- Segunda columna -->
                                      <div class="card">
                                          <div class="card-body">
                                              <h5 class="card-title">Lista de Contratos</h5>
                                              <!-- Tabla contratos -->
                                              <form class="row g-3">
                                                  <!-- Contenido de la tabla -->
                                                  <table id="tabla-contrato" class="table table-hover" style="width:100%">
                                                <thead class="table-light">
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Clientes</th>
                                                    <th>Fecha Contrato</th>
                                                    <th id="cierre_fecha">Fecha Cierre</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Garantia</th> 
                                                    <th>Estado</th>
                                                    <th>Finalizar</th>
                                                  </tr>
                                                </thead>

                                                <tbody>

                                                </tbody>
                                              </table>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                      </div>

                  <!-- FIN DEL CONTENIDO REGISTRO  -->

                </div>

                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                  <!-- INICIO CONTENIDO FILTRO CONTRATOS  -->

                  <div class="row mt-3">
                        <div class="col-lg-12  col-sm-12"> <!-- Primera columna -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Filtro de contratos</h5>
                                    <!-- Formulario filtro contratos -->
                                    <form class="row g-3" id="form-filtroContrato">

                                        <div class=" col-md-4 col-lg-3">                                        
                                                                                                                    
                                            <select class="form-select" id="cliente-ls" aria-label="Default select example">
                                                <option selected>Seleccione</option>                                                                                 
                                            </select>
                                                                   
                                        </div>
                                        <div class=" col-md-4 col-lg-3">                                            
                                            <div class="input-group ">                                                
                                                <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>                                                
                                                <input type="date" class="form-control"  id="fechaI">                                                
                                            </div>
                                        </div>

                                        <div class=" col-md-4 col-lg-3">
                                            <div class="input-group  ">
                                                <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                                <input type="date" class="form-control"  id="fechafin">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                  <div class="">
                                    <button id="btnfiltro" class="btn btn-primary btn-md " type="button"><i class="bi bi-funnel-fill"></i></button>
                                    <button id="exportar" class="btn btn-danger" type="button"><i class="bi bi-file-earmark-pdf"></i></button>                                    
                                  </div>
                                </div>                                   
                                    </form>
                                </div>
                            </div>
                                <div class="row mt-3">
                                  <div class="col-lg-12">
                                      <table class="table table-hover" style="width: 100%;"  id="table-reporteContrato">
                                          <thead class="table-light">
                                              <tr>                                                  
                                                  <th>Cliente</th>
                                                  <th>Estado</th>
                                                  <th>Fecha contrato</th>
                                                  <th>Fecha inicio</th>
                                                  <th>Fecha cierre</th>
                                                  <th>Tipo servicio</th>                                
                                                  <th>Nombre servicio</th>
                                                  <th>Precio</th>
                                                  <th>Cantidad</th>
                                                  <th>Garantia</th>
                                                       

                                              </tr>
                                          </thead>
                                          <tbody>
                                          <!-- DATOS ASINCRONOS  -->
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                        </div>

                  <!-- FIN CONTENIDO FILTRO CONTRATOS  -->
                </div>
          
                
              </div><!-- FIN DEL TABS -->

            </div>
    </div>



</main>

<section>
        <!-- seccion modales contratos   -->
      <!-- Modal para contrato ir a garantia -->        
    <div class="modal fade" id="modal-final2" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="" >
                    <h5 class="modal-title card-title" id="">Contrato finalizado</h5>
                </div>
                <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Detalles del contrato</h4>
                      <div class="row">
                        <div id="detallesIfinal" class="col-6">
                                          
                        </div>  
                        <div id="detallesDfinal" class="col-6">
                          
                        </div>                         
                      </div>                           
                  </div>
              </div>

         
                <div class="modal-footer">           
                    <button type="button" class="btn btn-primary shadow-lg" id="">Iniciar garantia</button>
                    <button type="button" class="btn btn-secondary shadow-lg" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
        </div>
    </div>

</section>

       <!-- Modal para finalizar contrato -->        
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

<script src="../js/getSelects.js"></script>
<script src="../js/funcionAlertSweet.js"></script>
<script src="../js/cambioInput.js"></script>


<script>
  $(document).ready(function (){

    let idcontrato = 0;
    let searchTimer;
    let selecCliente = "";

    // Obtener la fecha actual en formato YYYY-MM-DD
    function obtenerFechaActual() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); 
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Establecer la fecha actual al input
    $(document).ready(function() {
        const fechaActual = obtenerFechaActual();
        $("#finalizada").val(fechaActual);
    });


    function detalleContrato(id){
      
      $.ajax({
        url: '../controllers/contratos.controller.php',
        type: 'GET',
        data: {
          'op'          : 'detalleContrato_listar',
          'idcontrato'  : id
        },
        dataType: 'JSON',
        success: function (result){                  
            var contrato = result[0];      
                  var detalleC = "<p><strong style='color: #263E7C;'>Cliente:</strong> " + contrato.clientes + "</p>" +
                         "<p><strong style='color: #263E7C;'>Tipo Servicio:</strong> " + contrato.tiposervicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Nombre Servicio:</strong> " + contrato.nombreservicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Observacion:</strong> " + contrato.observacion + "</p>"; 
                    
                       

                  var detalleC2 = "<p><strong style='color: #263E7C;'>Fecha Contrato:</strong> " + contrato.fechacontrato + "</p>" +
                         "<p><strong style='color: #263E7C;'>Fecha Inicio:</strong> " + contrato.fechainicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Precio:</strong> " + contrato.precioservicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Garantia:</strong> " + contrato.garantia + "</p>" ;       
          $("#detallesI").html(detalleC);
          $("#detallesD").html(detalleC2);

        }
      });
    }

    function detalleContratoFinal(id){

      $.ajax({
        url: '../controllers/contratos.controller.php',
        type: 'GET',
        data: {
          'op'          : 'detalleContrato_listar',
          'idcontrato'  : id
        },
        dataType: 'JSON',
        success: function (result){                  
            var contrato = result[0];      
                  var detalleCfinal = "<p><strong style='color: #263E7C;'>Cliente:</strong> " + contrato.clientes + "</p>" +
                         "<p><strong style='color: #263E7C;'>Tipo Servicio:</strong> " + contrato.tiposervicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Nombre Servicio:</strong> " + contrato.nombreservicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Observacion:</strong> " + contrato.observacion + "</p>"; 
                    
                       

                  var detalleC2final = "<p><strong style='color: #263E7C;'>Fecha Contrato:</strong> " + contrato.fechacontrato + "</p>" +
                         "<p><strong style='color: #263E7C;'>Fecha Inicio:</strong> " + contrato.fechainicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Precio:</strong> " + contrato.precioservicio + "</p>" +
                         "<p><strong style='color: #263E7C;'>Garantia:</strong> " + contrato.garantia + "</p>" ;       
          $("#detallesIfinal").html(detalleCfinal);
          $("#detallesDfinal").html(detalleC2final);

        }
      });
    }

    function contratosListar(){
      $.ajax({
        url: '../controllers/contratos.controller.php',
        type: 'GET',
        data: {'op': 'contratos_listar'},
        success: function (result){
          var table = $("#tabla-contrato").DataTable();
          table.destroy();
          $("#tabla-contrato tbody").html(result);
          $("#tabla-contrato").DataTable({
            responsive: true,
            searching: false,
            lengthMenu: [5,10],
            order: [[0, 'desc']],
            language:{
              url: '../js/Spanish.json'
            },
            columnDefs:[
                {
                  responsivePriority: 1, // Ajusta la prioridad según tus necesidades
                  targets: [6], // Índice de la columna estado
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


    function filtroC_cliente(){
      $.ajax({
        url: '../controllers/contratos.controller.php',
        type: 'GET',
        data: {
          'op': 'filtroC_cliente',
          'idcliente' : $("#cliente-ls").val()
        },
        success: function (result){
          if(result === ""){
            errorRegistrado("No hay datos")
          }
          var table = $("#table-reporteContrato").DataTable();
          table.destroy();
          $("#table-reporteContrato tbody").html(result);
          $("#table-reporteContrato").DataTable({
            responsive: true,
            searching: false,
            lengthMenu: [10,15,20], // Oculta el menú de longitud
            order: [[0, 'desc']],
            language:{
              url: '../js/Spanish.json'
            },   
            columnDefs:[
                {                  
                  targets: [1], // Índice de la columna estado
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

    function filtroC_fechas(){
      $.ajax({
        url: '../controllers/contratos.controller.php',
        type: 'GET',
        data: {
          'op': 'filtroC_fechas',
          'fechaI' : $("#fechaI").val(),
          'fechaF' : $("#fechafin").val(),
        },
        success: function (result){
          if(result === ""){
            errorRegistrado("No hay datos")
          }
          var table = $("#table-reporteContrato").DataTable();
          table.destroy();        
          $("#table-reporteContrato tbody").html(result);
          $("#table-reporteContrato").DataTable({
            responsive: true,
            searching: false,
            lengthMenu: [10,15,20],
            order: [[0, 'desc']],
            language:{
              url: '../js/Spanish.json'
            },
            columnDefs:[
                {                  
                  targets: [1], // Índice de la columna estado
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
      });
    }



    function filtroC_fechaCliente(){
          $.ajax({
            url: '../controllers/contratos.controller.php',
            type: 'GET',
            data: {
              'op': 'filtroC_fechaCliente',
              'idcliente' : $("#cliente-ls").val(),
              'fechaI' : $("#fechaI").val(),
              'fechaF' : $("#fechafin").val(),
            },
            success: function (result){
              if(result === ""){
                errorRegistrado("No hay datos")
              }

              var table = $("#table-reporteContrato").DataTable();
              table.destroy();        
              $("#table-reporteContrato tbody").html(result);
              $("#table-reporteContrato").DataTable({
                responsive: true,
                searching: false,
                lengthMenu: [10,15,20],
                order: [[0, 'desc']],
                language:{
                  url: '../js/Spanish.json'
                },
                columnDefs:[
                    {                  
                      targets: [1], // Índice de la columna estado
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
          });
    }



    function registrarPerCliente(){

      const nombres = $("#nombres").val().trim();
      const apellidos = $("#apellidos").val().trim();
      const dni = $("#dni").val().trim();
      const correo = $("#correo").val().trim();
      const direccion = $("#direccion").val().trim();
      const telefono = $("#telefono").val().trim();

      let sendData = {

        'op'        : 'registrarPer_clientes',
        'nombres'   : $("#nombres").val(),
        'apellidos' : $("#apellidos").val(),
        'dni'       : $("#dni").val(),
        'correo'    : $("#correo").val(),
        'direccion' : $("#direccion").val(),
        'telefono'  : $("#telefono").val()
      };

      mostrarPregunta('Contratos','¿Está seguro de realizar la operación?')
      .then((result) => {
      if(result.isConfirmed){
        if(nombres === '' || apellidos === '' || dni === ''||
           correo === ''|| direccion === '' || telefono === ''){

            completeCampos();


           }else{
            toastFinalizar("Registrado correctamente");
              $.ajax({
                url:'../controllers/contratos.controller.php',
                type: 'POST',
                data: sendData,
                success: function(result){

                  $("#form-clientes")[0].reset();

                  $("#modal-registrar").modal('hide');
                  // Recargar la página actual
                    // window.location.reload();

                }
              });

           }
      }
      
     });
    }


    function registrarEmpCliente(){

      const rsocial = $("#rsocial").val().trim();
      const ruc = $("#ruc").val().trim();
    

      let sendData = {

        'op'            : 'registrarEmp_clientes',
        'razonsocial'   : $("#rsocial").val(),
        'ruc'           : $("#ruc").val()
      };

      mostrarPregunta('Contratos','¿Está seguro de realizar la operación?')
      .then((result) => {
      if(result.isConfirmed){
        if(rsocial === '' || ruc === '' ){

            
          completeCampos();

          }else{
            
            toastFinalizar("Registrado correctamente");
              $.ajax({
                url:'../controllers/contratos.controller.php',
                type: 'POST',
                data: sendData,
                success: function(result){

                  $("#form-clientes")[0].reset();

                  $("#modal-registrar").modal('hide');
                  // Recargar la página actual
                  // window.location.reload();

                }
              });

          }
      }

      });
}

    function registrarContrato(){

        const cliente = $("#cliente-id").val().trim();
        const fechaI = $("#fechainicio").val().trim();
        // const fechaC = $("#fechacierre").val().trim();
        const observacion = $("#observacion").val().trim();
        const garantia = $("#garantia").val().trim();
        const servicio = $("#lsServicios").val().trim();
        const precio = $("#precio").val().trim();
        const cantidad = $("#cantidad").val().trim();
        let idUsuario = <?php echo json_encode($idusuario)?>              


        let sendData = {
          'op'              : 'registrar_contrato',
          'idusuario'       : idUsuario,
          'idcliente'       : $("#cliente-id").val(),
          'fechainicio'     : $("#fechainicio").val(),
          // 'fechacierre'     : $("#fechacierre").val(),
          'observacion'     : $("#observacion").val(),
          'garantia'        : $("#garantia").val(),
          'idservicio'      : $("#lsServicios").val(),
          'precioservicio'  : $("#precio").val(),
          'cantidad'        : $("#cantidad").val(),          

        };

        mostrarPregunta('Contratos','¿Está seguro de realizar la operación?')
        .then((result) => {
        if(result.isConfirmed){
          if(cliente === '' || fechaI === '' || observacion === ''
          || garantia === '' || servicio === '' || precio === '' || cantidad === '' ){

            completeCampos();

            }else{
              toastFinalizar("Contrato registrado correctamente");

                $.ajax({
                  url:'../controllers/contratos.controller.php',
                  type: 'POST',
                  data: sendData,
                  success: function(result){

                    $("#form-contratos")[0].reset();
                    contratosListar();
                    $("#modal-registrar").modal('hide');


                  }
                });

            }
        }

        });
    }

    function finalizarContrato(){

      console.log(idcontrato)
      let sendData = {
        'op'  : 'finalizar_contrato',
        'idcontrato' : idcontrato,
        'fechacierre' : $("#finalizada").val(),
      };



      toastFinalizar("Contrato finalizado");
      
      $.ajax({
        url:'../controllers/contratos.controller.php',
        type: 'POST',
        data: sendData,
        success: function(result){
          contratosListar();
          $("#modal-final1").modal('hide');

        }
      });

    }

    

    function cliente_buscar(){
      //cronometrar 
      clearTimeout(searchTimer);

      searchTimer = setTimeout(function (){
        const searchTerm = $("#b-cliente").val();

        if(searchTerm.trim() === ""){

          $("#clientes_buscados").empty();
          return;

        }

        $.ajax({
        url:'../controllers/contratos.controller.php',
        type: 'GET',
        dataType: 'JSON',
        data: {
          'op': 'cliente_buscar',
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

      }, 100);
  
    }


    $("#tabla-contrato tbody").on("click", ".finalizar2", function(){            
        
        fechaC = $(this).data("fechacierre");

        if(fechaC === ''){
          idcontrato = $(this).data("idcontrato");
          $("#modal-final1").modal('show');
          detalleContrato(idcontrato);

        }else{
          idcontrato = $(this).data("idcontrato");
          $("#modal-final2").modal('show');
          detalleContratoFinal(idcontrato);
        }
        


    });

   $("#cliente").click(function(){
    $("#modal-buscar").modal('show');

   });

    $("#btcliente").click(function(){

      const rbPersona = document.querySelector("#rbPersona");
      const rbEmpresa = document.querySelector("#rbEmpresa");

      if(rbPersona.checked){
        registrarPerCliente();
      }else{
        registrarEmpCliente();
      }


    });


    



    $("#btnFinalizar").click(finalizarContrato);
    $("#btnContrato").click(registrarContrato);

    $("#b-cliente").keyup(cliente_buscar);
    

    contratosListar();

    $("#btnfiltro").click(function (){
      const idcliente = document.querySelector("#cliente-ls").value;
      const fechaI = document.querySelector("#fechaI").value;
      const fechaF = document.querySelector("#fechafin").value;

      if(idcliente && fechaI && fechaF){      
        filtroC_fechaCliente(idcliente, fechaI, fechaF);

      }else if(fechaI && fechaF){
        filtroC_fechas(fechaI, fechaF);

      }else if(idcliente){
        filtroC_cliente(idcliente);
      }

    });

  });



</script>



<?php include '../principal/footer.php' ?>

