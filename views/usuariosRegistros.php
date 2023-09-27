<?php require_once '../principal/cabezera.php' ?>
  <!-- DataTable -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


    <section class="section">
        <div class="row">

            <div class="col-lg-6">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos</h5>
                            <button type="button" id="abrir-modal-registro-personas" class="btn btn-success btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-register-personas">
                                <i class="bi bi-plus-circle"></i> Nuevo
                            </button>
                            
                            <!-- Horizontal Form -->
                            <form id="form-usuarios">
                                <div class="row mb-3">
                                    <label for="buscador" class="col-sm-2 col-form-label">Buscar:</label>
                                    <div class="col-sm-6">
                                        <input type="search" class="form-control" id="buscador" placeholder="busqueda por DNI" maxlength="8">
                                        <input type="text"  id="idpersona" style="display: none;"> <!---->
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="nombres" class="col-sm-2 col-form-label">Nombres: </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="nombres" placeholder="" maxlength="20" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="apellidos" class="col-sm-2 col-form-label">Apellidos:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="apellidos" placeholder="" maxlength="20" readonly>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="usuario" class="col-sm-2 col-form-label"><strong>Usuario:</strong> </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="usuario" placeholder="escriba usuario" maxlength="30">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="clave" class="col-sm-2 col-form-label"><strong>Contraseña:</strong> </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="clave" placeholder="escriba clave" maxlength="30">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="idservicio" class="col-sm-2 col-form-label"><strong>Nivel acceso:</strong></label>
                                    <div class="col-sm-6">
                                        <select class="form-select" id="nivelacceso">
                                            <option selected>Seleccione</option>
                                            <option value="A">Administrador</option>
                                            <option value="E">Invitado</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                <button type="button" class="btn btn-primary" id="guardarusuario">Guardar</button>
                                <button type="reset" class="btn btn-secondary">Cancelar</button>
                                </div>
                            </form><!-- End Horizontal Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modal-register-personas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Nuevo Usuario</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-usuarios-md">
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="md-nombres" placeholder="Nombres" maxlength="20">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="md-apellidos" placeholder="Apellidos" maxlength="20">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-vcard"></i></strong></span>
                                    <input type="text" class="form-control" id="md-dni" placeholder="DNI" maxlength="8">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                                    <input type="email" class="form-control" id="md-correo" placeholder="Correo" maxlength="30">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" class="form-control" id="md-direccion" placeholder="Dirección" maxlength="50">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" class="form-control" id="md-telefono" placeholder="Teléfono" maxlength="9">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" class="form-control" id="md-usuario" placeholder="Usuario" maxlength="30">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                                    <input type="text" class="form-control" id="md-clave" placeholder="Contraseña" maxlength="30">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres:</strong> </label> -->
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" id="basic-addon1"><strong>Nivel acceso:</strong></span>
                                    <select class="form-select" id="md-nivelacceso">
                                        <option selected>Seleccione</option>
                                        <option value="A">Administrador</option>
                                        <option value="E">Invitado</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="md-guardarid">Guardar</button>
                                <button type="reset" class="btn btn-primary">Cancelar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

<!-- CDN sweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AJAX = JavaScript asincrónico-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="../js/funcionAlertSweet.js"></script>
<script>
    $(document).ready(function(){

        function registrarusuarioID(){
            const idpersona = $("#idpersona").val().trim();
            const usuario   = $("#usuario").val().trim();
            const clave     = $("#clave").val().trim();
            const nivelacc  = $("#nivelacceso").val().trim();

            let datosEnviar= {
                'operation'     : 'UsuariosRegistrarID',
                'idpersona'     :   idpersona,
                'usuario'       :   usuario,
                'claveacceso'   :   clave,
                'nivelacceso'   :   nivelacc
            };

            Swal.fire({
                title: '¿Está seguro de realizar la operación?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#3F974F',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if(result.isConfirmed){
                    if(idpersona === '' || 
                         usuario === '' || clave === '' || nivelacc === ''){
                        mostrarSweetAlert("Por favor, complete los campos","warning");
                    }else{
                       
                        $.ajax({
                            url: '../controllers/usuarios.controller.php',
                            type: 'POST',
                            data: datosEnviar,
                            success: function(result){
                                if(result){
                                    mostrarSweetAlert("Este usuario ya fue registrado", "warning");
                                    $("#form-usuarios")[0].reset();
                                }else{
                                    mostrarSweetAlert("Operación exitosa","success");
                                    $("#form-usuarios")[0].reset();
                                }
                            }   
                        })
                    }
                }
            })
        }


        function registrarusuario(){
            const nombres   = $("#md-nombres").val().trim();
            const apellidos = $("#md-apellidos").val().trim();
            const dni       = $("#md-dni").val().trim();
            const correo    = $("#md-correo").val().trim();
            const direccion = $("#md-direccion").val().trim();
            const telefono  = $("#md-telefono").val().trim();
            const usuario   = $("#md-usuario").val().trim();
            const clave     = $("#md-clave").val().trim();
            const nivelacc  = $("#md-nivelacceso").val().trim();

            let datosEnviar= {
                'operation'     : 'UsuariosRegistrar',
                'nombres'       :   nombres,
                'apellidos'     :   apellidos,
                'dni'           :   dni,
                'correo'        :   correo,
                'direccion'     :   direccion,
                'telefono'      :   telefono,
                'usuario'       :   usuario,
                'claveacceso'   :   clave,
                'nivelacceso'   :   nivelacc
            };

            Swal.fire({
                title: '¿Está seguro de realizar la operación?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#3F974F',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if(result.isConfirmed){
                    if(nombres === '' || apellidos === '' || dni === '' || direccion ==='' || 
                        telefono === '' || usuario === '' || clave === '' || nivelacc === ''){
                        mostrarSweetAlert("Por favor, complete los campos","warning");
                    }else{
                        mostrarSweetAlert("Operación exitosa","success");
                        $.ajax({
                            url: '../controllers/usuarios.controller.php',
                            type: 'POST',
                            data: datosEnviar,
                            success: function(result){
                                $("#form-usuarios-md")[0].reset();
                                $("#modal-register-personas").modal('hide');
                            }   
                        })
                    }
                }
            })
        }

        function buscarpersonas() {
            $.ajax({
                url: '../controllers/personas.controller.php',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    'op': 'buscarpersona', 
                    'dni': $("#buscador").val()
                },
                success: function(result) {
                    if (result.length > 0) {
                        // Supongamos que solo tienes un resultado, toma el primer objeto del array.
                        const persona = result[0];

                        // Establecer los valores en los campos de entrada.
                        $("#nombres").val(persona.nombres);
                        $("#apellidos").val(persona.apellidos);
                        $("#idpersona").val(persona.idpersona);
                    } else {
                        mostrarSweetAlert("No se encontraron resultados para el DNI proporcionado.","warning");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        }


        // el evento keypress en el campo de búsqueda
        $("#buscador").keypress(function(event){
            if(event.keyCode === 13) {
                buscarpersonas();
            }
        });


        $("#guardarusuario").click(registrarusuarioID);
        $("#md-guardarid").click(registrarusuario);

    })
</script>


<?php require_once '../principal/footer.php' ?>