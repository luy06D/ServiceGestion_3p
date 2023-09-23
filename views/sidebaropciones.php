<?php

$permiso = $_SESSION['login']['nivelacceso'];

$opciones = [];

//ADM - SPV- AST
switch($permiso){
  //EN CASO TENGAS OPCION 
  case  "A":
    $opciones = [
        ["menu" => "Inicio", "url"    => "cabezera.php?view=pruebas.php"],
        ["menu" => "Garantia",  "url"    => "cabezera.php?view=garantia.php"],
        ["menu" => "Contratos", "url"    => "cabezera.php?view=contratos.php"],
        ["menu" => "Equipos", "url"    => "cabezera.php?view=equipos.php"],
        ["menu" => "Marcas",   "url"    => "cabezera.php?view=marcas.php"],
        ["menu" => "Tipos",   "url"    => "cabezera.php?view=tipoequipos.php"],
        ["menu" => "Usuarios",   "url"    => "cabezera.php?view=usuariosRegistros.php"],
    ];
  break;

  case "E":
    $opciones = [
        ["menu" => "Inicio", "url"    => "cabezera.php?view=pruebas.php"], 
        ["menu" => "Contratos", "url"    => "cabezera.php?view=contratos.php"],
    ];
  break;

}

//Renderizar los items del SIDEBAR
foreach ($opciones AS $item) {
  echo "
  <li class='nav-item'>
    <a class='nav-link' href='{$item['url']}'>
      <i class='fas fa-fw fa-chart-area'></i>
      <span>{$item['menu']}</span></a>
  </li>
  ";
}
