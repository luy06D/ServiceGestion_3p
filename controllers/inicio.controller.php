<?php

require_once '../models/Inicio.php';

if(isset($_POST['op'])){
    
    $inicio = new Inicio();

    if($_POST['op'] == 'getSolicitado'){      
      $data = $inicio->getSolicitado();

      if($data){

        foreach($data as $registro){
            echo "
            <h6>{$registro['cliente']}</h6>          
            ";
            
        }

    }   

  }

}


?>