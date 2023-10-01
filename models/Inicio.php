<?php 
require_once 'Conexion.php';

class Inicio extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConnect();
  }

  public function getSolicitado(){

    try{
        $query = $this->conexion->prepare("CALL spu_cliente_solicitado()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(Exception $e){
        die($e->getMessage());
    }

}







}

?>