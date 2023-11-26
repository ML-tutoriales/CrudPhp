<?php

require_once "../controlador/cliente.controlador.php";
require_once "../modelo/cliente.modelo.php";

/**
 * Description of tablaCliente
 *
 * @author Diego Molina
 */
class TablaClientes {
    public function mostrarTabla() {
        $cliente = ControladorClientes::ctrMostrarCliente();
        $datosJson = '{

              "data": [ ';

    for($i = 0; $i < count($cliente); $i++){
                 
    $acciones = "<button class='btnEditarCliente' id='".$cliente[$i]["id"]."'>Modificar</button>"
               ."<button class='btnEliminarCliente' id='".$cliente[$i]["id"]."'>Eliminar</button>";

        $datosJson	 .= '[
                      "'.$cliente[$i]["id"].'",
                      "'.$cliente[$i]["documento"].'",
                      "'.$cliente[$i]["nombre"].'",
                      "'.$cliente[$i]["telefono"].'",
                      "'.$acciones.'"		    
                    ],';

    }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson.=  ']

    }';
    
    echo $datosJson;
    }
}

$activar = new TablaClientes();
$activar -> mostrarTabla();
