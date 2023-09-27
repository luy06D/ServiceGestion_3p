<?php

require_once '../models/TiposE.php';

if(isset($_GET['op'])){
    $tipose = new TiposE();

    if($_GET['op'] == "listar_tiposE"){
        $data = $tipose->tipos_listar();

        if($data){
            foreach($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idtipoequipo']}</td>
                        <td>{$registro['tipoequipo']}</td>
                        <td>
                            <a href='#' class='editar btn btn-warning btn-sm ' data-bs-toggle='modal' data-bs-target='#modal-Tequipos' data-idtipoequipo ='{$registro['idtipoequipo']}'><i class='bi bi-pencil-square'></i></a>
                            <a href='#' class='eliminar btn btn-danger btn-sm' data-idtipoequipo='{$registro['idtipoequipo']}'><i class='bi bi-trash'></i></a> 
                        </td>
                    </tr>
                ";
            }
        }
    }

    if($_GET['op'] == 'registrar_tiposE'){
        $datos = [
            "tipoequipo"    => $_GET['tipoequipo']
        ];

        $respuesta = $tipose->tipos_registrar($datos);
        echo json_encode($respuesta);
    }

    if($_GET['op'] == 'actualizar_tiposE'){
        $datos = [
            "idtipoequipo" => $_GET['idtipoequipo'],
            "tipoequipo"   => $_GET['tipoequipo']
        ];

        $tipose->tipos_actualizar($datos);
    }

    if($_GET['op'] == 'obtener_tiposE'){
        $data = $tipose->tipos_obtener($_GET['idtipoequipo']);

        echo json_encode($data);
    }

    if($_GET['op'] == 'eliminar_tiposE'){
        $tipose->tipos_eliminar($_GET['idtipoequipo']);
    }

    if($_GET['op'] == 'buscar_tiposE'){
        $data = $tipose->tipos_buscar($_GET['tipoequipo']);
        echo json_encode($data);
    }

    if($_GET['op'] == 'activar_tiposE'){
        $tipose->tipos_activar($_GET['idtipoequipo']);
    }
}

?>