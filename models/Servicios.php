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

                $data["tiposervicio"],
                $data["duracionE"],
                $data["garantia"]
            ));
        }
        catch (Exception $e) {
            $respuesta ["message"] = "No se pudo completar la operacion";
        }

        return $respuesta;
    }
}