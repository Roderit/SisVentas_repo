var tabla;

function init(){
    mostrarFormulario(false);
    listar();
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
                    url: '../ajax/permisos.php?op=listar',
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

init();