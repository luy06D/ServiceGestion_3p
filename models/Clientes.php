<?php

require_once 'Conexion.php';

class Clientes extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function clientes_listar(){
        try{
            $query = $this->conexion->prepare("CALL spu_clientes_listar()");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;

        }catch(Exception $err){
            die($err->getMessage());
        }
    }

    public function clientes_registrar ($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_clientes_registrar(?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idempresa"],
                $datos["idpersona"],
                $datos["direccion"],
                $datos["telefono"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }
}



?>