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
                    <td>{$registro['duracionE']}</td>
                    <td>{$registro['garantia']}</td>                    

                
                    
                    
                </tr>
            ";
            }
        }
    }
}

if(isset($_POST['operacion'])){

    $servicios = new Servicios();

    if($_POST['operacion'] == 'RegistrarServicio'){

        $saveData = [
            "tiposervicio"        => $_POST['tiposervicio'], 
            "duracionE"        => $_POST['duracionE'],   
            "garantia"      => $_POST['garantia']
        ];

        $respuesta = $servicios->Servicios_Registrar($saveData);
        echo json_encode($respuesta);
    }
}