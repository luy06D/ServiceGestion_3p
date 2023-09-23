<?php

require_once 'Conexion.php';

class Marcas extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function marcas_listar(){
        try{
            $query = $this->conexion->prepare("CALL spu_marcas_recuperar()");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(Exception $err){
            die($err->getMessage());
        }
    }

    public function marcas_registrar($datos = []){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_marca_registrar(?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["marca"]
            ));
        }catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function marcas_actualizar($datos = []){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_marca_actualizar(?,?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["idmarca"],
                $datos["marca"]
            ));
        }catch(Exception $e){
            $respuesta["message"] = "No se ha pudido completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function marcas_obtener($idmarca = 0){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_marca_obtener(?)");
            $respuesta["status"] = $consulta->execute(array($idmarca));

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
 
    }

    public function marcas_eliminar($idmarca = 0){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_marca_eliminar(?)");
            $respuesta["status"] = $consulta->execute(array($idmarca));
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }
}

?>