<?php

require_once 'Conexion.php';

class Servicios extends Conexion{

    private $acceso;

    public function __CONSTRUCT(){
        $this->access = parent::getConnect();
    }

    public function ListarServicios(){
        try{
            $consulta = $this->access->prepare("CALL spu_servicios_listar()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Servicios_Registrar($data = []){

        $respuesta = [
            "status" => false,
            "message" =>""
        ];

        try{
            $consulta = $this->access->prepare("CALL spu_servicios_registrar(?,?,?)");
            $respuesta["status"] = $consulta->execute(array(

                $data["idtiposervicio"],
                $data["nombreservicio"],
                $data["precioestimado"]
            ));
        }
        catch (Exception $e) {
            $respuesta ["message"] = "No se pudo completar la operacion". $e->getCode();
        }

        return $respuesta;
    }

    public function ObtenerServicio($idservicio = 0){
        try{
            $consulta = $this->access->prepare("CALL spu_servicios_obtener(?)");
            $consulta->execute(array($idservicio));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }


    }

    public function ActualizarServicio($data = []){
        try{
            $consulta = $this->access->prepare("CALL spu_servicios_update(?,?,?,?)");
            $consulta->execute(array(
                $data['idservicio'],
                $data['idtiposervicio'],
                $data['nombreservicio'],
                $data['precioestimado']
                
            ));
        }
        catch(Exception $e){
            die($e->getMEssage());
        }
    }

    public function EliminarServicio($idservicio = 0){
        try{
            $consulta = $this->access->prepare("CALL spu_servicios_eliminar(?)");
            $consulta->execute(array($idservicio));
    }catch(Exception $e){
        die($e->getMessage());
       }
    }

    public function getTipoServicios(){

        try{
            $query = $this->access->prepare("CALL spu_tipo_select()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
    
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    
    }
}