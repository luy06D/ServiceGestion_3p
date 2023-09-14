<?php

require_once 'Conexion.php';

  class Equipos extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
      $this->conexion = parent::getConnect();
    }

    public function equipos_listar(){
      try{
        $query = $this->conexion->prepare("CALL spu_equipos_listar()");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;

      }catch(Exception $err){
        die($err->getMessage());
      }
    }

    public function equipo_registrar ($datos = []){
      $respuesta = [
        "status" => false,
        "message" => ""
      ];
      try{
        $consulta = $this->conexion->prepare("CALL spu_equipo_registrar(?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
          $datos["tipoequipo"],
          $datos["marca"],
          $datos["descripcion"],
        ));
      }
      catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
      }
      return $respuesta;
    }

    public function describequipo_registrar($datos = []){
      $respuesta = [
        "status" => false,
        "message" => ""
      ];
      try{
        $consulta = $this->conexion->prepare("CALL spu_describequipo_registrar(?,?,?,?)");
        $respuesta["status"] = $consulta->execute(array(
            
          $datos["idequipo"],
          $datos["iddescServicio"],
          $datos["numSerie"],
          $datos["precio"]
        ));
      }
      catch(Exception $e){
        $respuesta["message"] = "No se pudo completar la operacion Codigo error: " .$e->getCode();
      }
      return $respuesta;
    }
  }


?>