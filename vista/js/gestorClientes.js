/*
$.ajax({

    url:"ajax/tablaCliente.ajax.php",
    success:function(respuesta){

    console.log("respuesta", respuesta);

    }

 })
*/
$(".tablaClientes").DataTable({
    "ajax": "../ajax/tablaCliente.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
           "sProcessing":     "Procesando...",
           "sLengthMenu":     "Mostrar _MENU_ registros",
           "sZeroRecords":    "No se encontraron resultados",
           "sEmptyTable":     "Ningún dato disponible en esta tabla",
           "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
           "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
           "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
           "sInfoPostFix":    "",
           "sSearch":         "Buscar:",
           "sUrl":            "",
           "sInfoThousands":  ",",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
                   "sFirst":    "Primero",
                   "sLast":     "Último",
                   "sNext":     "Siguiente",
                   "sPrevious": "Anterior"
           },
           "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
           }
    }
});

$(".guardarCliente").click(function () {
    if ($(".documento").val() !== "" &&
        $(".nombre").val() !== "" &&
        $(".telefono").val() !== "") {

        var documento = $(".documento").val();
        var nombre = $(".nombre").val();
        var telefono = $(".telefono").val();

        var datosProducto = new FormData();
        datosProducto.append("documento", documento);
        datosProducto.append("nombre", nombre);
        datosProducto.append("telefono", telefono);

        $.ajax({
            url: "../ajax/clientes.ajax.php",
            method: "POST",
            data: datosProducto,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log("respuesta", respuesta);
                if (respuesta === "ok") {
                    swal({
                        type: "success",
                        title: "cliente ha sido guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function (result) {
                        if (result.value) {
                            window.location = "../";
                        }
                    });
                } else {
                    alert("Nok");
                }
            }
        });
    } else {
        swal({
            title: "Llenar todos los campos obligatorios",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
        return;
    }
});

$(".tablaClientes tbody").on("click", ".btnEditarCliente", function(){
    if ($(".nombre").val() !== "" &&
        $(".telefono").val() !== "") {
	var idCliente = $(this).attr("id");
        var nombre = $(".nombre").val();
        var telefono = $(".telefono").val();

	var datos = new FormData();
	datos.append("id", idCliente);
        datos.append("nombre", nombre);
        datos.append("telefono", telefono);

	$.ajax({
		url:"../ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
                    console.log("respuesta", respuesta);
                if (respuesta === "ok") {
                    swal({
                        type: "success",
                        title: "cliente ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function (result) {
                        if (result.value) {
                            window.location = "../";
                            limpiarFormulario();                            
                        }
                    });
                } else {
                    alert("Nok");
                }
            }
        });			
    } else {
            swal({
                title: "Llenar todos los campos obligatorios",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });
            return;
        }
});

$(".tablaClientes tbody").on("click", ".btnEliminarCliente", function () {
    var idCliente = $(this).attr("id");
    swal({
        title: '¿Está seguro de borrar los datos?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
    }).then(function (result) {
        if (result.value) {
            window.location = "../index.php?id="+idCliente;
        }
    });
});

$(".imprimirCliente").click(function () {

        var datos = new FormData();

        $.ajax({
            url: "../reporte/reporteCliente.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log("respuesta", respuesta);
                if (respuesta !== "") {
                    window.open(respuesta, "_blank");
                } 
            }
        });
});

$(".tablaClientes tbody").on("click", ".btnImprimirCliente", function(){

	var idCliente = $(this).attr("id");

	var datos = new FormData();
	datos.append("id", idCliente);

	$.ajax({
		url:"../reporte/reporteCliente.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
                    console.log("respuesta", respuesta);
                if (respuesta !== "") {
                    window.open(respuesta, "_blank");
                }
            }
        });			
});


