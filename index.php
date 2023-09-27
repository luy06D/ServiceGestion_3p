<?php
session_start();

//Si el usuario ya tiene una sesión activa ... entonces NO DEBE ESTAR AQUI 
if(isset($_SESSION['segurity']) && $_SESSION['segurity']['login']){
   header('Location:views/index.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Iniciar sesión</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./img/3p.png" rel="icon">
  <!-- <link href="./img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="./vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="./vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Aug 30 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"> </span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">3P Ingeniería y Técnologia</h5>
                    <p class="text-center small">Inicia Sesión</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Usuario</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control" id="usuario" required>
                        <div class="invalid-feedback">Por favor, ingrese su nombre de usuario.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key"></i></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">¡Por favor, introduzca su contraseña!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <!-- <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe"> -->
                        <!-- <label class="form-check-label" for="rememberMe">Remember me</label> -->
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="button" id="btniniciar" >Iniciar</button>
                    </div>
                    <div class="col-12">
                      <!-- <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p> -->
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="./vendor/apexcharts/apexcharts.min.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./vendor/chart.js/chart.umd.js"></script>
  <script src="./vendor/echarts/echarts.min.js"></script>
  <script src="./vendor/quill/quill.min.js"></script>
  <script src="./vendor/simple-datatables/simple-datatables.js"></script>
  <script src="./vendor/tinymce/tinymce.min.js"></script>
  <script src="./vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="./js/main.js"></script>

  <!-- CDN jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <!-- CDN sweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      $(document).ready(function(){

         function login(){
            const data = {
               "operation" : "log_in",
               "usuario"   : $("#usuario").val(),
               "claveacceso"     : $("#password").val(),
            };

            $.ajax({
               url:'./controllers/usuarios.controller.php',
               type: 'GET',
               data: data,
               dataType: 'JSON',
               success: function(result){
                  if(result.login){
                     Swal.fire({
                        title: 'Inicio correctamente',
                        text: 'Bienvenido: ' + `${result.apellidos} ${result.nombres}`,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200

                     }).then((result) => {
                        if(result){
                           window.location.href = `./views/index.php`;
                        }
                     })
                  }
                  else if(result.mensaje == "Contraseña"){
                     Swal.fire({
                        title: 'Contraseña incorrecta',
                        icon: 'error',
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#E43D2C'

                     })
                  }else{
                     Swal.fire({
                        title: 'El usuario ingresado es incorrecto',
                        icon: 'error',
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#E43D2C'
                      })
                  }                  
               }
            });


         }


         $("#btniniciar").click(login);

         $("#password").keypress(function (evt){
            if(evt.keyCode == 13){
               login();
            }
         })

      });
   </script>

  


</body>

</html>

