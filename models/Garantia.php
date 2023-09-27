<?php

require_once 'Conexion.php';

class Garantia extends Conexion{
    private $acceso;

    public function __CONSTRUCT(){
        $this->access = parent::getConnect();
    }

    public function ListarGarantias(){
        try{
            $consulta = $this->access->prepare("CALL spu_garantia_listar()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function garantia_registrar($datos = []){
        $respuesta = [
            "status"    => false,
            "message"   => ""
        ];
        try{
            $consulta = $this->access->prepare("CALL spu_registrar_garantia(?,?,?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["iddescServicio"],
                $datos["idSoporteTecnico"],
                $datos["fechaAveria"],
                $datos["fechaEjecucion"],
                $datos["problemadetectado"],
                $datos["solucion"],
                $datos["inSitu"]
            ));
        }catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operación Código error: " .$e->getCode();
        }
        return $respuesta;
    }

    public function clientes_buscar($search = ""){
        try{
            $query = $this->access->prepare("CALL spu_clientes_garantia(?)");
            $query->execute(array($search));
            return $query->fetchAll(PDO::FETCH_ASSOC);
            
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }

    public function filtroG_cliente($idcliente = 0){
        try{
            $query = $this->access->prepare("CALL spu_filtroG_cliente(?)");
            $query->execute(array($idcliente));
            return $query->fetchAll(PDO::FETCH_ASSOC);
            
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }
}