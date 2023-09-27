<?php

require_once '../models/Equipos.php';

if(isset($_GET['op'])){

  $equipos = new Equipos();

  if($_GET['op'] == 'listar_equipos'){
      $data = $equipos->equipos_listar();

    if($data){
      foreach($data as $registro){
        echo "
        <tr>
          <td>{$registro['idequipo']}</td>
          <td>{$registro['tipoequipo']}</td>
          <td>{$registro['marca']}</td>
          <td>{$registro['descripcion']}</td> 
          <td>{$registro['numSerie']}</td>                   
          
        </tr>
        ";


      }
    }
  }

  

}


if(isset($_POST['op'])){
    
  $equipos = new Equipos();

  if($_POST['op'] == 'registrar_equipos'){

    $data = [
      "idtipoequipo"  => $_POST['idtipoequipo'],
      "idmarca"       => $_POST['idmarca'],
      "descripcion"   => $_POST['descripcion'],
      "numSerie"      => $_POST['numSerie']    
    ];

    $response = $equipos->equipo_registrar($data);
    echo json_encode($response);
  }
  

  if($_POST['op'] == 'actualizar_equipos'){

    $data = [
      "idequipo"    => $_POST['idequipo'],
      "idtipoequipo"  => $_POST['idtipoequipo'],
      "idmarca"       => $_POST['idmarca'],
      "descripcion" => $_POST['descripcion']    
    ];

    $equipos->equipo_registrar($data);
  }


  if($_POST['op'] == 'registrar_descbrequipos'){

    $data = [
      "idEquipo"        => $_POST['idequipo'],
      "iddescServicio"  => $_POST['iddescServicio'],
      "numSerie"        => $_POST['numServicio'],  
      "precio"          => $_POST['precio']   
    ];

    $equipos->equipo_registrar($data);
  }

  if($_POST['op'] == 'recuperarTipoEquipo'){
    echo json_encode($equipos->recuperarTipoEquipos());
  }

  if($_POST['op'] == 'recuperarMarca'){
    echo json_encode($equipos->recuperarMarcas());
  }

}



?>