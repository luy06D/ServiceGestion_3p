<?php 
require_once 'Conexion.php';

class Contratos extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConnect();
  }

  public function clientesPer_registrar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => ""
    ];
    try{
        $consulta = $this->conexion->prepare("CALL spu_clientesPer_registrar(?,?,?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["nombres"],
            $datos["apellidos"],
            $datos["dni"],
            $datos["correo"],
            $datos["genero"],
            $datos["direccion"],
            $datos["telefono"]
        ));
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
    }
    return $respuesta;
}


public function clientesEmp_registrar ($datos = []){
  $respuesta = [
      "status" => false,
      "message" => ""
  ];
  try{
      $consulta = $this->conexion->prepare("CALL spu_clientesEmp_registrar(?,?,?,?)");
      $respuesta["status"] = $consulta->execute(array(
          
          $datos["nombre"],
          $datos["ruc"],
          $datos["direccion"],
          $datos["telefono"]
      ));
  }
  catch(Exception $e){
      $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
  }
  return $respuesta;
}



}

?>