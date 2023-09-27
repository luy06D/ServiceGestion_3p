<?php

require_once '../models/Garantia.php';

if(isset($_GET['operacion'])){

    $garantia = new Garantia();

    if($_GET['operacion'] === 'Listar'){
        $data = $garantia->ListarGarantias();
        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                    <td>{$registro['idgarantia']}</td>
                    <td>{$registro['nombreservicio']}</td>
                    <td>{$registro['Tecnico']}</td>
                    <td>{$registro['fechaAveria']}</td>
                    <td>{$registro['fechaEjecucion']}</td>
                    <td>{$registro['problemadetectado']}</td>
                    <td>{$registro['solucion']}</td>
                    <td>{$registro['estadogarantia']}</td>
                    <td>{$registro['inSitu']}</td>
                    
                                          

                    <td>                
                    <a href='#' class='finalizar2 btn btn-outline-primary btn-sm' data-fechaEjecucion ='{$registro['fechaEjecucion']}'
                    data-idgarantia ='{$registro['idgarantia']}'><i class='bi bi-box-arrow-in-left'></i></a>                  
                   </td>
                    
                    
                </tr>
            ";
            }
        }
    }

    if($_GET['operacion'] == 'registrar_garantia'){
        $datos = [
            "iddescServicio"        => $_GET['iddescServicio'],
            "idSoporteTecnico"      => $_GET['idSoporteTecnico'],
            "fechaAveria"           => $_GET['fechaAveria'],
            "fechaEjecucion"        => $_GET['fechaEjecucion'],
            "problemadetectado"     => $_GET['problemadetectado'],
            "solucion"              => $_GET['solucion'],
            "inSitu"                => $_GET['inSitu']
        ];

        $respuesta = $garantia->garantia_registrar($datos);
        echo json_encode($respuesta);
    }

    if($_GET['operacion'] == 'buscar'){
        $data = $garantia->clientes_buscar($_GET['search']);

        echo json_encode($data);
    }

    if($_GET['operacion'] == 'filtroG_cliente'){
        $data = $garantia->filtroG_cliente($_GET['idcliente']);

        if($data){
            foreach($data as $registro){
                echo "
            <tr>
                <td>{$registro['clientes']}</td>
                <td>{$registro['nombreservicio']}</td>
                <td>{$registro['Tecnico']}</td>
                <td>{$registro['fechaAveria']}</td>
                <td>{$registro['fechaEjecucion']}</td>   
                <td>{$registro['problemadetectado']}</td>                    
                <td>{$registro['solucion']}</td>    
                <td>{$registro['inSitu']}</td>                    
        </tr>                
                
            </tr>
                
                ";
            }

        }    
    }
}