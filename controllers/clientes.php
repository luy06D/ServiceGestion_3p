<?php

require_once '../models/Clientes.php';

if(isset($_GET['op'])){

    $cliente = new Clientes();

    if($_GET['op'] == 'listar_clientes'){
        $data = $cliente->clientes_listar();

        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                    <td>{$registro['idcliente']}</td>
                    <td>{$registro['cliente']}</td>
                    <td>{$registro['identidad']}</td>
                    <td>{$registro['direccion']}</td>
                    <td>{$registro['telefono']}</td>                    
                    <td>
                        <a href='#' class='editar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idcliente ='{$registro['idcliente']}'><i class='bi bi-pencil-square'></i></a>
                        <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idcliente='{$registro['idcliente']}'><i class='bi bi-trash'></i></a> 
                    </td>
                </tr>
            ";
      

            }
        }
    }

}


if(isset($_POST['op'])){
    
    $cliente = new Clientes();

    if($_POST['op'] == 'registrar_clientes'){

        $data = [
            "idempresa" => $_POST['idempresa'],
            "idpersona" => $_POST['idpersona'],
            "direccion" => $_POST['direccion'],
            "telefono" => $_POST['telefono']
        ];

        $cliente->clientes_registrar($data);
    }
}


?>