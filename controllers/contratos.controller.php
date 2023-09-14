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

        $contrato->clientesPer_registrar($data);
    }

    if($_POST['op'] == 'registrarEmp_clientes'){

        $data = [
            "razonsocial"   => $_POST['razonsocial'],
            "ruc"       => $_POST['ruc'],
        ];

        $contrato->clientesEmp_registrar($data);
    }
}


?>