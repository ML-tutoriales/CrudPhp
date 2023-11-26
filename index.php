<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>CRUD PHP</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        
    $(document).ready(function() {
          var table = $('#tblCliente').DataTable();

          // Agrega un controlador de clics a las filas de la tabla
          $('#tblCliente tbody').on('click', 'tr', function () {
                // Obtiene los datos de la fila seleccionada usando DataTables
                var data = table.row(this).data();

                // Puedes acceder a los datos de cada columna por índice, por ejemplo:
                var id = data[0];
                var documento = data[1];
                var nombre = data[2];
                var telefono = data[3];

                $("#id").val(id);
                $("#documento").val(documento);
                $("#nombre").val(nombre);
                $("#telefono").val(telefono);
                $('#documento').prop('disabled', true);

            });
        });
        
    function limpiarFormulario(){
        $("#id").val("");
        $("#documento").val("");
        $("#nombre").val("");
        $("#telefono").val("");
        $('#documento').prop('disabled', false);
        $("#documento").focus();
    }
    </script>
  </head>
  <body>
      <input type="text" id="id" class="id" name="id" disabled>            
      <br><br>
      <input type="text" id="documento" class="documento" placeholder="Ingresar documento" name="documento">            
      <br><br>
      <input type="text" id="nombre" class="nombre" placeholder="Ingresar nombre" name="nombre">           
      <br><br>
      <input type="text" id="telefono" class="telefono" placeholder="Ingresar telefono" name="telefono" required>
      <br><br>

      <button type="button" class="guardarCliente">Guardar cliente</button>
      <button type="button" id="btnnuevo" onclick="limpiarFormulario()">Nuevo</button>
      <br><br><br>
      <table id="tblCliente" class="tablaClientes" width="100%">
          <thead>            
            <tr>
              <th>ID</th>
              <th>Documento</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>      
      
      <script src="lib/jquery.min.js"></script>
      <script src="lib/jquery.dataTables.min.js"></script>
      <script src="lib/sweetalert2.all.js"></script>
      <script src="vista/js/gestorClientes.js"></script>
  </body>
</html>

<?php
    require_once "./controlador/cliente.controlador.php";
    require_once "./modelo/cliente.modelo.php";
    
    $editarCliente = new ControladorClientes();
    $editarCliente ->crtEditarCliente();
    
    $eliminarCliente = new ControladorClientes();
    $eliminarCliente ->crtEliminarCliente();
?>

