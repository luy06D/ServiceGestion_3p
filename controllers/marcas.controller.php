<?php

require_once '../models/Marcas.php';

if(isset($_GET['op'])){

    $marcas = new Marcas();

    if($_GET['op'] == "listar_marcas"){
        $data = $marcas->marcas_listar();

        if($data){
            foreach($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idmarca']}</td>
                        <td>{$registro['marca']}</td>
                        <td>
                            <a href='#' class='editar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-marca' data-idmarca ='{$registro['idmarca']}'><i class='bi bi-pencil-square'></i></a>
                            <a href='#' class='eliminar btn btn-danger btn-sm' data-idmarca='{$registro['idmarca']}'><i class='bi bi-trash'></i></a>  
                        </td>
                    </tr>                
                ";
            }
        }
    }

    if($_GET['op'] == 'registrar_marcas'){
        $datos = [
            "marca"    => $_GET['marca']
        ];
        
        $respuesta = $marcas->marcas_registrar($datos);
        echo json_encode($respuesta);
    }

    if($_GET['op'] == 'actualizar_marcas'){
        $datos =[
            "idmarca"   => $_GET['idmarca'],
            "marca"     => $_GET['marca']
        ];

        $marcas->marcas_actualizar($datos);
    }

    if($_GET['op'] == 'obtener_marcas'){
        $data = $marcas->marcas_obtener($_GET['idmarca']);

        echo json_encode($data);
    }

    if($_GET['op'] == 'eliminar_marcas'){
        $marcas->marcas_eliminar($_GET['idmarca']);
    }
}


?>