<?php require_once '../principal/cabezera.php' ?>

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

          <button type="button" id="abrir-modal-registro" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-registrar">
            <i class="bi bi-plus-circle"></i>  Nuevo
          </button>

          <!-- Modal-Registrar  -->
          <div class="modal fade" id="modal-registrar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header" id="modal-registro-header">
                          <h5 class="modal-title" id="modal-titulo">Nuevo Equipo</h5>
                      </div>
                      <div class="modal-body">
                          <form action="" id="form-productos">
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-motherboard"></i></span>
                                <input type="text" class="form-control" placeholder="Tipo de equipo" maxlength="50" id="tipoEquipo">
                              </div>
                    
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                                <input type="text" class="form-control" placeholder="Marca" maxlength="50" id="marca">
                              </div>
                    
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-text"></i></span>
                                <textarea type="text" class="form-control" placeholder="Descripción"  id="descripcion" rows="3"></textarea>
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

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detalles</h5>

              <!-- Horizontal Form -->
              <form>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Equipo</label>
                  <div class="col-sm-10">
                    <select class="form-select" id="idequipo">
                      <option selected>Seleccione</option>                 
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Servicio</label>
                  <div class="col-sm-10">
                    <select class="form-select" id="idservicio">
                      <option selected>Seleccione</option>                 
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">N° de serie</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="serie" placeholder="Escriba aquí">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Precio</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="precio" placeholder="S/. " >
                  </div>
                </div>
                <!-- <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                      <label class="form-check-label" for="gridRadios1">
                        First radio
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                      <label class="form-check-label" for="gridRadios2">
                        Second radio
                      </label>
                    </div>
                    <div class="form-check disabled">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                      <label class="form-check-label" for="gridRadios3">
                        Third disabled radio
                      </label>
                    </div>
                  </div>
                </fieldset> -->
                <!-- <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Example checkbox
                      </label>
                    </div>
                  </div>
                </div> -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-secondary">Cancelar</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php require_once '../principal/footer.php'?>