var tabla;

function init(){
    mostrarFormulario(false);
    listar();

    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    })

}

function limpiar(){
    $("#nombre").val("");
	$("#num_documento").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#idpersona").val("");
}

function mostrarFormulario(x){
    limpiar();

    if(x){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnguardar").prop("disabled",false);
        $("#imagenmuestra").hide();
        $("#btnagregar").hide();
    }else{
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarFormulario(){
    limpiar();
    mostrarFormulario(false);
}

function listar(){
    tabla = $('#tablalistado').dataTable({
        "aProcessing": true, //Activa el procesamiento de tablas
        "aServerSide": true, //Paginación y filtrado realizado por el servidor
            dom: 'Bfrtip', //Definición de elementos de control de tabla
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],

            "ajax":
                {
                    url: '../ajax/personas.php?op=listarP',
                    type: "get",
                    datatype: "json",
                    error: function(e){
                        console.log(e.responseText);
                    }
                },

        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [[0, "desc"]] //Ordenar (columna, orde)

    }).dataTable()
}

function guardaryeditar(e){
    e.preventDefault(); //No se activará la función predeterminada del evento
    $("#btnguardar").prop("disabled",true);

    var formData = new FormData($("#formulario")[0]);

        $.ajax({
            url: "../ajax/personas.php?op=guardareditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function(datos){
                bootbox.alert(datos);
                mostrarFormulario(false);
                tabla.ajax.reload();
            }
        });
    limpiar();
}

function mostrar(idpersona){

    $.post("../ajax/personas.php?op=mostrar",
    {idpersona: idpersona},
    function(data, status){
        data = JSON.parse(data);
        mostrarFormulario(true);

        $("#nombre").val(data.nombre);
		$("#tipo_documento").val(data.tipo_documento);
		//$("#tipo_documento").selectpicker('refresh');
		$("#num_documento").val(data.num_documento);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
 		$("#idpersona").val(data.idpersona);
    })
}

function eliminar(idpersona){
    bootbox.confirm("¿Está Seguro de eliminar al proveedor?", 
        function(result){
            if (result){
                $.post("../ajax/personas.php?op=eliminar", 
                {idpersona : idpersona}, 
                function(e){
                    bootbox.alert(e);
                    tabla.ajax.reload();
                });	
            }
    })

}

init();