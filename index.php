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
  <link rel="stylesheet" href="./css/login.css">
</head>

<body>

<!-- <h2>Weekly Coding Challenge #1: Sign in/up Form</h2> -->
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#" id="form-usuarios">
			<h1>Crear una cuenta</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<!-- <span>or use your email for registration</span> -->
			<input type="text" placeholder="Nombres" id="nombresU"/>
      <input type="text" placeholder="Apellidos" id="apellidosU"/>
      <input type="text" placeholder="DNI" maxlength="8" id="dniU"/>
      <input type="email" placeholder="Correo" id="correoU" />
      <input type="text" placeholder="Direccion" id="direccionU" value="No registrado" style="display: none;"/>
      <input type="text" placeholder="Teléfono" id="telefonoU" value="000000000" style="display: none;"/>
      <input type="text" placeholder="Usuario" id="usuarioU"/>
			<input type="password" placeholder="Contraseña" id="claveU" />
			<input type="text" placeholder="Nivelacceso" id="nivelaccesoU" value="E" style="display: none;"/>
			<button type="button" id="btnRegistrarUser">Registrarse</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#">
			<!-- <h1>Iniciar sesión</h1> -->
			<div class="social-container">
				<!-- <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> -->
        <img src="./img/3plogo.png" alt="" style="width: 80%;">
			</div>
			<!-- <span>or use your account</span> -->
			<input type="email" placeholder="Usuario" id="usuario"/>
			<input type="password" placeholder="Contraseña" id="password"/>
			<!-- <a href="#">Forgot your password?</a> -->
			<button id="btniniciar">Iniciar</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>¡Bienvenido de nuevo!</h1>
				<p>Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
				<button class="ghost" id="signIn">Iniciar sesión</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>¿No tienes una cuenta?</h1>
				<p>Introduce tus datos personales</p>
				<button class="ghost" id="signUp">Registrarse</button>
			</div>
		</div>
	</div>
</div>

<!-- <footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
		- Read how I created this and how you can join the challenge
		<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
	</p>
</footer> -->

  

  <!-- CDN jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <!-- CDN sweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- JS LOGIN -->
  <script src="./js/login.js"></script>
  <script src="./js/funcionAlertSweet.js"></script>
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

      function registrarusuario(){

        const nombres   = $("#nombresU").val().trim();
        const apellidos = $("#apellidosU").val().trim();
        const dni       = $("#dniU").val().trim();
        const correo    = $("#correoU").val().trim();
        const direccion = $("#direccionU").val()
        const telefono  = $("#telefonoU").val()
        const usuario   = $("#usuarioU").val().trim();
        const clave     = $("#claveU").val().trim();
        const nivelacc  = $("#nivelaccesoU").val()

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
              toastFinalizar("Operación exitosa");
              $.ajax({
                url: './controllers/usuarios.controller.php',
                type: 'POST',
                data: datosEnviar,
                success: function(result){
                  $("#form-usuarios")[0].reset();
                }   
              })
            }
          }
        })
      }

      
      $("#btniniciar").click(login);
      $("#btnRegistrarUser").click(registrarusuario);
      
      $("#password").keypress(function (evt){
        if(evt.keyCode == 13){
          login();
        }
      })

    });
  </script>


</body>

</html>



