<?php

require_once 'Conexion.php';

class TiposE extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function tipos_listar(){
        try{
            $query = $this->conexion->prepare("CALL spu_tipoequip_recuperar()");
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(Exception $err){
            die($err->getMessage());
        }
    }

    public function tipos_registrar($datos = []){
        $respuesta =[
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_tipoequipo_registrar(?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["tipoequipo"]
            ));
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function tipos_actualizar($datos = []){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_tipoequip_actualizar(?,?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["idtipoequipo"],
                $datos["tipoequipo"]
            ));
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function tipos_obtener($idtipoequipo = 0){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_tipoequip_obtener(?)");
            $respuesta["status"] = $consulta->execute(array($idtipoequipo));

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
    }

    public function tipos_eliminar($idtipoequipo = 0){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_tipoequip_eliminar(?)");
            $respuesta["status"] = $consulta->execute(array($idtipoequipo));
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function tipos_buscar($tipoequipo = ''){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_buscar_tipoe(?)");
            $respuesta["status"] = $consulta->execute(array($tipoequipo));

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function tipos_activar($idtipoequipo = 0){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_activar_tipo(?)");
            $respuesta["status"] = $consulta->execute(array($idtipoequipo));
        }catch(Exception $e){
            $respuesta["message"] = "No se ha podido completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    
}

?>