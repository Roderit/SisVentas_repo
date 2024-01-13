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
    $("#descripcion").val("");
    $("#idcategoria").val("");
}

function mostrarFormulario(x){
    limpiar();

    if(x){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnguardar").prop("disabled",false);
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
                    url: '../ajax/categoria.php?op=listar',
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
            url: "../ajax/categoria.php?op=guardareditar",
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

init();