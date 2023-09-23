<?php

session_start();

require_once '../models/Usuarios.php';

if(isset($_GET['operation'])){

    $user = new Usuarios();


    if($_GET['operation'] == 'destroy'){
        session_destroy();
        session_unset();
        header('Location:../login.php');
    }


    if($_GET['operation'] == 'log_in'){

        $access = [
            "login"         => false,
            "apellidos"     => "",
            "nombres"       => "",
            "usuario"       => "",
            "idusuario"     => "", 
            "idpersona"     => "",  
            "mensaje"       => ""
        ];

        $data = $user->login($_GET['usuario']);
        $keyIngresada = $_GET['claveacceso'];

        if($data){

            if(password_verify($keyIngresada, $data['claveacceso'])){

                $access["login"] = true;
                $access["nombres"] = $data["nombres"];
                $access["apellidos"] = $data["apellidos"];
                $access["usuario"] = $data["usuario"];
                $access["idusuario"] = $data["idusuario"];
                $access["correo"] = $data["correo"];
                $access["dni"] = $data["dni"];
                $access["direccion"] = $data["direccion"];
                $access["telefono"] = $data["telefono"];
                $access["idpersona"] = $data["idpersona"];
            }else{
                $access["mensaje"] = "Contraseña";
            }
        }else{
            $access["mensaje"] = "Usuario";
        }
      

        $_SESSION['segurity'] = $access;

        echo json_encode($access);
    }

    

}

if(isset($_POST['operation'])){
    $user = new Usuarios();
    if($_POST['operation'] == 'UsuariosRegistrar'){

        $dataSave = [
            "nombres"       => $_POST['nombres'],
            "apellidos"     => $_POST['apellidos'],
            "dni"           => $_POST['dni'],
            "correo"        => $_POST['correo'],
            "direccion"     => $_POST['direccion'],
            "telefono"      => $_POST['telefono'],
            "usuario"       => $_POST['usuario'],
            "claveacceso"   => password_hash($_POST['claveacceso'], PASSWORD_BCRYPT),
            "nivelacceso"   => $_POST['nivelacceso']
        ];

        $response = $user->usuarios_registrar($dataSave);
        echo json_encode($response);
    }

    if($_POST['operation'] == 'UsuariosRegistrarID'){

        $dataSave = [
            "idpersona"       => $_POST['idpersona'],
            "usuario"       => $_POST['usuario'],
            "claveacceso"   => password_hash($_POST['claveacceso'], PASSWORD_BCRYPT),
            "nivelacceso"   => $_POST['nivelacceso']
        ];

        $response = $user->usuariosID_registrar($dataSave);
        echo json_encode($response);
    }

}



?>
