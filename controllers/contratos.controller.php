<?php

require_once '../models/Clientes.php';

if(isset($_POST['op'])){
    
    $cliente = new Clientes();

    if($_POST['op'] == 'registrarPer_clientes'){

        $data = [
            "nombres"   => $_POST['nombres'],
            "apellidos" => $_POST['apellidos'],
            "dni"       => $_POST['dni'],
            "correo"    => $_POST['correo'],
            "genero"    => $_POST['genero'],
            "direccion" => $_POST['direccion'],
            "telefono"  => $_POST['telefono'],
        ];

        $cliente->clientesPer_registrar($data);
    }

    if($_POST['op'] == 'registrarEmp_clientes'){

        $data = [
            "nombre"   => $_POST['nombre'],
            "ruc"       => $_POST['ruc'],
            "direccion" => $_POST['direccion'],
            "telefono"  => $_POST['telefono']
        ];

        $cliente->clientesEmp_registrar($data);
    }
}


?>