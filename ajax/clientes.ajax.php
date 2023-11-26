<?php

require_once "../controlador/cliente.controlador.php";
require_once "../modelo/cliente.modelo.php";

/**
 * Description of cliente
 *
 * @author Diego Molina
 */
class AjaxClientes {
    public $documento;
    public $nombre;
    public $telefono;
    
    public function ajaxGuardarCliente() {
       $datos = array(
        "documento"=>$this->documento,
        "nombre"=>$this->nombre,
        "telefono"=>$this->telefono
        );
       $respuesta = ControladorClientes::crtCrearCliente($datos);
       echo $respuesta;
    }
    
    public function ajaxeditarCliente() {
       $datos = array(
        "id"=>$this->id,
        "nombre"=>$this->nombre,
        "telefono"=>$this->telefono
        );
       $respuesta = ControladorClientes::crtEditarCliente($datos);
       echo $respuesta;
    }
}
// Guardar Cliente
if(isset($_POST["documento"])){
  $guardar = new AjaxClientes();
  $guardar -> documento = $_POST["documento"];
  $guardar -> nombre = $_POST["nombre"];
  $guardar -> telefono = $_POST["telefono"];
  $guardar -> ajaxGuardarCliente();
}

// Editar cliente
if(isset($_POST["id"])){
  $editar = new AjaxClientes();
  $editar -> id = $_POST["id"];
  $editar -> nombre = $_POST["nombre"];
  $editar -> telefono = $_POST["telefono"];
  $editar -> ajaxEditarCliente();
}
