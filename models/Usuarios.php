<?php

require_once 'Conexion.php';

class Usuarios extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConnect();
  }

  public function login ($nombreusuario = ""){
    try{
      $query = $this->conexion->prepare("CALL spu_user_login(?)");
      $query->execute(array($nombreusuario));

      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $err){
      die($err->getMessage());
    }
  }

  public function usuarios_registrar($data = []){

    $response = [
      "status"  => false,
      "message" => ""
    ];

    try{
      $query = $this->conexion->prepare("CALL spu_usuario_registrar(?,?,?,?,?,?,?,?,?)");
      $response["status"] = $query->execute(array(
          $data['nombres'],
          $data['apellidos'],
          $data['dni'],
          $data['correo'],
          $data['direccion'],
          $data['telefono'],
          $data['usuario'],
          $data['claveacceso'],
          $data['nivelacceso']
      ));
    }
    catch(Exception $err){
      $response["message"] = "No se completo el proceso. Codigo error: " . $err->getCode();
    }
    return $response;
  }

  public function usuariosID_registrar($data = []){

    $response = [
      "status"  => false,
      "message" => ""
    ];

    try{
      $query = $this->conexion->prepare("CALL spu_register_userid(?,?,?,?)");
      $response["status"] = $query->execute(array(
          $data['idpersona'],
          $data['usuario'],
          $data['claveacceso'],
          $data['nivelacceso']
      ));
    }
    catch(Exception $err){
      $response["message"] = "No se completo el proceso. Codigo error: " . $err->getCode();
    }
    return $response;
  }
}