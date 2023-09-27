<?php

session_start();

$nivelacceso = $_SESSION['login']['nilveacceso'];


$url    =   $_SERVER['REQUEST_URI'];
$url_array = explode("/", $url);
$vistaActiva = $url_array[count($url_array) -1];

$permiso = [
    "A" => ["prueba.php","contratos.php","equipos.php","marcas.php","tipoequipos.php","usuariosRegistros.php"],
    "E" => ["prueba.php","contratos.php"]
];


$autorizado  = false;

$vistasPermitidas = $permiso[$nivelacceso];

foreach($vistasPermitidas as $item){
    if($item == $vistaActiva){
        $autorizado = true;
    }
}

if(!$autorizado){
    echo "<h1>Acceso no permitido</h1>";
    exit();
}