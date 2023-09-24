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
        $consulta = $this->conexion->prepare("CALL spu_clientesPer_registrar(?,?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["nombres"],
            $datos["apellidos"],
            $datos["dni"],
            $datos["correo"],            
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
      $consulta = $this->conexion->prepare("CALL spu_clientesEmp_registrar(?,?)");
      $respuesta["status"] = $consulta->execute(array(
          
          $datos["razonsocial"],
          $datos["ruc"],
      ));
  }
  catch(Exception $e){
      $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
  }
  return $respuesta;
}


public function contrato_registrar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => ""
    ];
    try{
        $consulta = $this->conexion->prepare("CALL spu_contrato_registrar(?,?,?,?,?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["idusuario"],
            $datos["idcliente"],
            $datos["fechainicio"],            
            $datos["observacion"],
            $datos["garantia"],
            $datos["idservicio"],
            $datos["precioservicio"],
            $datos["cantidad"]
            
        ));
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
    }
    return $respuesta;
  }

  public function contrato_finalizar ($datos = []){
    $respuesta = [
        "status" => false,
        "message" => ""
    ];
    try{
        $consulta = $this->conexion->prepare("CALL spu_finalizarContrato(?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
            $datos["idcontrato"],
            $datos["fechacierre"],
            
        ));
    }
    catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
    }
    return $respuesta;
  }


public function getClientes(){

    try{
        $query = $this->conexion->prepare("CALL spu_getClientes()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(Exception $e){
        die($e->getMessage());
    }

}


public function getServicios(){

    try{
        $query = $this->conexion->prepare("CALL spu_getServicios()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(Exception $e){
        die($e->getMessage());
    }

}

public function contratos_listar(){
    try{
        $query = $this->conexion->prepare("CALL spu_contratos_listar()");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }catch(Exception $err){
        die($err->getMessage());
    }
}


public function detalleContratos_listar($idcontrato = 0){
    try{
        $query = $this->conexion->prepare("CALL spu_detalleContratos_listar(?)");
        $query->execute(array($idcontrato));
        return $query->fetchAll(PDO::FETCH_ASSOC);
        
    }
    catch(Exception $err){
        die($err->getMessage());
    }
}



}

?>