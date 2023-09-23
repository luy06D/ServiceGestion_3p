<?php

require_once 'Conexion.php';

class Personas extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function buscarpersona($dni = ""){
        try{
            $query = $this->conexion->prepare("CALL spu_buscar_persona(?)");
            $query->execute(array($dni));
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}

