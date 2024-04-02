<?php

/**
 * Description of cliente
 *
 * @author Diego Molina
 */
class ControladorClientes {
    
    static public function ctrMostrarCliente() {
      $tabla = "tcliente";
      $respuesta = ModeloCliente::mdlMostrarCliente($tabla);
      return $respuesta;
    }

    static public function crtCrearCliente($datos) {
     if (isset($datos["documento"])) {

            $datos2 = array(
                "documento" => $datos["documento"],
                "nombre" => $datos["nombre"],
                "telefono" => $datos["telefono"]
            );
           $respuesta = ModeloCliente::mdlIngresarCliente("tcliente", $datos2);
           return $respuesta;
        }   
    }
    
    static public function crtEditarCliente() {
      if (isset($_POST["id"])) {

            $datos = array("id" => $_POST["id"],
                "nombre" => $_POST["nombre"],
                "telefono" => $_POST["telefono"]);

            $respuesta = ModeloCliente::mdlEditarCliente("tcliente", $datos);
            return $respuesta;            
        }  
    }
    
    static public function crtEliminarCliente() {
      if (isset($_GET["id"])) {

            $respuesta = ModeloCliente::mdlEliminarCliente("tcliente", $_GET["id"]);
            // echo '<pre>'; print_r($respuesta); echo '</pre>'; 

            if ($respuesta == "ok") {
                echo'<script>
                        swal({
                            type: "success",
                            title: "La categoría ha sido borrada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                  if (result.value) {
                                      window.location = "../index.php";
                                  }
                              })
                    </script>';
            }
        }  
    }
}
