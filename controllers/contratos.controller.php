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


    if($_POST['op'] == 'registrar_contrato'){

        $data = [
            "idusuario"     => $_POST['idusuario'],
            "idcliente"     => $_POST['idcliente'],
            "fechainicio"   => $_POST['fechainicio'],            
            "observacion"   => $_POST['observacion'],
            "garantia"      => $_POST['garantia'],
            "idservicio"     => $_POST['idservicio'],
            "precioservicio" => $_POST['precioservicio'],
            "cantidad"      => $_POST['cantidad'],
                                
        ];

        $respuesta = $contrato->contrato_registrar($data);
        echo json_encode($respuesta);
    }

    if($_POST['op'] == 'finalizar_contrato'){

        $data = [
            "idcontrato"     => $_POST['idcontrato'],
            "fechacierre"     => $_POST['fechacierre'],                            
        ];

        $respuesta = $contrato->contrato_finalizar($data);
        echo json_encode($respuesta);
    }

    
    if($_POST['op'] == 'getCliente'){

        echo json_encode($contrato->getClientes());
    }

        
        
    if($_POST['op'] == 'getServicios'){

        $data  = $contrato->getServicios($_POST['idtiposervicio']);
        echo json_encode($data);
    }


    
    if($_POST['op'] == 'getTipoServicios'){

        echo json_encode($contrato->getTipoServicios());
    }

}


if(isset($_GET['op'])){
    
    $contrato = new Contratos();

    if($_GET['op'] == 'contratos_listar'){
        $data = $contrato->contratos_listar();

        if($data){
            foreach($data as $registro){
                echo "
            <tr>
                <td>{$registro['idcontrato']}</td>
                <td>{$registro['clientes']}</td>
                <td>{$registro['fechacontrato']}</td>
                <td>{$registro['fechacierre']}</td>
                <td>{$registro['fechainicio']}</td>                    
                <td>{$registro['garantia']}</td>   
                <td>{$registro['estadoservicio']}</td>    
                <td>                
                 <a href='#' class='finalizar2 btn btn-outline-primary btn-sm' data-fechacierre ='{$registro['fechacierre']}'
                 data-idcontrato ='{$registro['idcontrato']}'><i class='bi bi-box-arrow-in-left'></i></a>                  
                </td>
        </tr>                
                
            </tr>
                
                ";
            }

        }    
    }

    if($_GET['op'] == 'filtroC_cliente'){
        $data = $contrato->filtroC_cliente($_GET['idcliente']);

        if($data){
            foreach($data as $registro){
                echo "
            <tr>
                <td>{$registro['clientes']}</td>
                <td>{$registro['estadoservicio']}</td>
                <td>{$registro['fechacontrato']}</td>
                <td>{$registro['fechainicio']}</td>
                <td>{$registro['fechacierre']}</td>
                <td>{$registro['tiposervicio']}</td>                    
                <td>{$registro['nombreservicio']}</td>   
                <td>{$registro['precioservicio']}</td>    
                <td>{$registro['cantidad']}</td>                    
                <td>{$registro['garantia']}</td>                   
        </tr>                
                
            </tr>
                
                ";
            }

        }    
    }

    if($_GET['op'] == 'filtroC_fechas'){
        $data = $contrato->filtroC_fechas($_GET['fechaI'], $_GET['fechaF']);

        if($data){
            foreach($data as $registro){
                echo "
            <tr>                
                <td>{$registro['clientes']}</td>
                <td>{$registro['estadoservicio']}</td>
                <td>{$registro['fechacontrato']}</td>
                <td>{$registro['fechainicio']}</td>
                <td>{$registro['fechacierre']}</td>
                <td>{$registro['tiposervicio']}</td>                    
                <td>{$registro['nombreservicio']}</td>   
                <td>{$registro['precioservicio']}</td>    
                <td>{$registro['cantidad']}</td>                    
                <td>{$registro['garantia']}</td>                             
        </tr>                
                
            </tr>
                
                ";
            }

        }    
    }

    
    if($_GET['op'] == 'filtroC_fechaCliente'){
        $data = $contrato->filtroC_fechaCliente($_GET['idcliente'], $_GET['fechaI'], $_GET['fechaF']);

        if($data){
            foreach($data as $registro){
                echo "
            <tr>                
                <td>{$registro['clientes']}</td>
                <td>{$registro['estadoservicio']}</td>
                <td>{$registro['fechacontrato']}</td>
                <td>{$registro['fechainicio']}</td>
                <td>{$registro['fechacierre']}</td>
                <td>{$registro['tiposervicio']}</td>                    
                <td>{$registro['nombreservicio']}</td>   
                <td>{$registro['precioservicio']}</td>    
                <td>{$registro['cantidad']}</td>                    
                <td>{$registro['garantia']}</td>                        
        </tr>                
                
            </tr>
                
                ";
            }

        }    
    }




    if($_GET['op'] == 'detalleContrato_listar'){
        $data = $contrato->detalleContratos_listar($_GET['idcontrato']);

        echo json_encode($data);
    }

    if($_GET['op'] == 'cliente_buscar'){
        $data = $contrato->clientes_buscar($_GET['search']);

        echo json_encode($data);
    }




}


?>