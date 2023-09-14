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
              <td>{$registro['idtipoequipo']}</td>
              <td>{$registro['idmarca']}</td>
              <td>{$registro['descripcion']}</td>                    
              <td>
                  <a href='#' class='editar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idequipo ='{$registro['idequipo']}'><i class='bi bi-pencil-square'></i></a>
                  <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idEquipo='{$registro['idequipo']}'><i class='bi bi-trash'></i></a> 
              </td>
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
        "tipoequipo"  => $_POST['tipoequipo'],
        "marca"       => $_POST['marca'],
        "descripcion" => $_POST['descripcion'],     
    ];

    $equipos->equipo_registrar($data);
  }

}

if(isset($_POST['op'])){
    
  $equipos = new Equipos();

  if($_POST['op'] == 'registrar_descbrequipos'){

    $data = [
        "idEquipo"        => $_POST['idequipo'],
        "iddescServicio"  => $_POST['iddescServicio'],
        "numSerie"        => $_POST['numServicio'],  
        "precio"          => $_POST['precio']   
    ];

    $equipos->equipo_registrar($data);
  }

}



?>