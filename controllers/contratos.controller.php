<?php

require_once '../models/Contratos.php';

if(isset($_POST['op'])){
    
    $contrato = new Contratos();

    if($_POST['op'] == 'registrarPer_clientes'){

        $data = [
            "nombres"   => $_POST['nombres'],
            "apellidos" => $_POST['apellidos'],
            "dni"       => $_POST['dni'],
            "correo"    => $_POST['correo'],
            "direccion" => $_POST['direccion'],
            "telefono"  => $_POST['telefono'],
        ];

        $respuesta = $contrato->clientesPer_registrar($data);
        echo json_encode($respuesta);
    }

    if($_POST['op'] == 'registrarEmp_clientes'){

        $data = [
            "razonsocial"   => $_POST['razonsocial'],
            "ruc"       => $_POST['ruc'],
        ];

        $respuesta = $contrato->clientesEmp_registrar($data);
        echo json_encode($respuesta);
    }


// faltaaaaaaaaaaaaaaaaaaaaaaaaaaa
    if($_POST['op'] == 'registrar_contrato'){

        $data = [
            "idusuario"   => $_POST['idusuario'],
            "idcliente" => $_POST['idcliente'],
            "fechainicio"       => $_POST['fechainicio'],
          
        ];

        $respuesta = $contrato->clientesPer_registrar($data);
        echo json_encode($respuesta);
    }

    
    if($_POST['op'] == 'getCliente'){

        echo json_encode($contrato->getClientes());

    }
}

if(isset($_GET['op'])){
    
    $contrato = new Contratos();


}


?>