<?php

require_once '../models/Personas.php';

if(isset($_GET['op'])){
    $persona = new Personas();

    if($_GET['op'] == 'buscarpersona'){
        $data = $persona->buscarpersona($_GET['dni']);
        echo json_encode($data);
    }
}