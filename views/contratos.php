
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
                        <input class="form-check-input" type="radio" name="gridRadios" id="rbPersona" value="option1" checked>
                        <label class="form-check-label" for="gridRadios1">
                          Persona
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="rbEmpresa" value="option2">
                        <label class="form-check-label" for="gridRadios2">
                          Empresa
                        </label>
                      </div>                  
                    </div>
                  </fieldset>
                    <hr>
                    
                      <div class="mb-3 col-lg-6 mt-3" >
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                          <input type="text" class="form-control" placeholder="Nombres" maxlength="50" id="nombres">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                          <input type="text" class="form-control" placeholder="Apellidos" maxlength="50" id="apellidos">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-id-card'></i></span>
                          <input type="text" class="form-control" placeholder="Número DNI" maxlength="8" id="dni">
                        </div>  
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                          <input type="email" class="form-control" placeholder="Correo" maxlength="50" id="correo">
                        </div>
                      </div>

                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                          <input type="text" class="form-control" placeholder="Dirección" maxlength="50" id="direccion">
                        </div>
                      </div>
                      <div class="mb-3 col-lg-6">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone' ></i></span>
                          <input type="tel" class="form-control" placeholder="900-000-000" maxlength="9" id="telefono">
                        </div>  
                      </div>
                    </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary shadow-lg" id="guardar">Guardar</button>
                    <button type="button" class="btn btn-secondary shadow-lg" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <button type="button" id="abrir-modal-registro" class="btn btn-primary btn-md mb-3 shadow-lg" data-bs-toggle="modal" data-bs-target="#modal-registrar">
        <i class="bi bi-plus-circle"></i>  Nuevo cliente
    </button>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"  >Registro de contrato</h5>

              <!-- Formlario Registrar contratos -->
              <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Cliente</label>
                    <select id="inputState" class="form-select">
                      <option>Seleccione</option>
                      
                    </select>
                </div>            
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Fecha inicio</label>
                  <input type="date" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Fecha Cierre</label>
                  <input type="date" class="form-control" id="inputPassword5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Observación</label>
                  <input type="text" class="form-control" id="inputPassword5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Garantia</label>
                  <input type="number" class="form-control" id="inputPassword5">
                </div>
                <h5 class="card-title">Detalles </h5>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Servicio</label>
                    <select id="inputState" class="form-select">
                      <option>Seleccione</option>
                      
                    </select>
                </div> 
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Precio</label>
                  <input type="number" class="form-control" id="inputPassword5">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Cantidad</label>
                  <input type="number" class="form-control" id="inputPassword5">
                </div>
                <div class="">
                  <button type="submit" class="btn btn-primary shadow-lg">Registrar</button>
                  <button type="reset" class="btn btn-secondary shadow-lg">Limpiar</button>
                </div>
              </form>

            </div>
          </div>

        </div>


</main>
 




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



<?php include '../principal/footer.php' ?>

