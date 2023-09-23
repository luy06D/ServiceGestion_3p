<?php

require_once '../models/Servicios.php';

if(isset($_GET['operacion'])){

    $servicios = new Servicios();

    if($_GET['operacion'] === 'ListarServicios'){
        $data = $servicios->ListarServicios();
        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                    <td>{$registro['idservicio']}</td>
                    <td>{$registro['tiposervicio']}</td>
                    <td>{$registro['nombreservicio']}</td>
                    <td>{$registro['precioestimado']}</td>                    

                    <td>
                    <a href='#' class='editar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idservicio ='{$registro['idservicio']}'><i class='bi bi-pencil-square'></i></a>
                    <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idservicio='{$registro['idservicio']}'><i class='bi bi-trash'></i></a> 
                </td>
                    
                    
                </tr>
            ";
            }
        }
    }
    if($_GET['operacion'] == 'Obtener'){

        $data = $servicios->ObtenerServicio($_GET['idservicio']);

        echo json_encode($data);
    }

    if($_GET['operacion'] == 'RegistrarServicio'){

        $datos = [
            "tiposervicio"        => $_GET['tiposervicio'], 
            "nombreservicio"        => $_GET['nombreservicio'],   
            "precioestimado"      => $_GET['precioestimado']
        ];

            $respuesta = $servicios->Servicios_Registrar($datos);
            echo json_encode($respuesta);

    }

    if($_GET['operacion'] == 'Update'){
        $datos = [
            "idservicio"  => $_GET['idservicio'],
            "tiposervicio"  => $_GET['tiposervicio'],
            "nombreservicio"  => $_GET['nombreservicio'],
            "precioestimado"  => $_GET['precioestimado']

        ];
        $servicios->ActualizarServicio($datos);
    }

    if ($_GET['operacion'] == 'eliminar'){
        $servicios->EliminarServicio($_GET['idservicio']);
    }


}