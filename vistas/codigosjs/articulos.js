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
    $("#codigo").val("");
    $("#stock").val("");
    $("#imagen").val("");
    $("#imagenactual").val("");
    $("#print").hide();
    $("#idarticulo").val("");

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
                    url: '../ajax/articulos.php?op=listar',
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
            url: "../ajax/articulos.php?op=guardareditar",
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

function mostrar(idarticulo){

    $.post("../ajax/articulos.php?op=mostrar",
    {idarticulo: idarticulo},
    function(data, status){
        data = JSON.parse(data);
        mostrarFormulario(true);

        $("#idcategoria").val(data.idcategoria);
        $("#idcategoria").selectpicker('refresh');
        $("#codigo").val(data.codigo);
        $("#nombre").val(data.nombre);
        $("#stock").val(data.stock);
        $("#descripcion").val(data.descripcion);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/articulos/"+data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#idarticulo").val(data.idarticulo);
    }
    )
}

function desactivar(idarticulo){
    bootbox.confirm("¿Está seguro de desactivar el artículo?", function(result){
        if(result){
            $.post("../ajax/articulos.php?op=desactivar", 
            {idarticulo: idarticulo},
            function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(idarticulo){
    bootbox.confirm("¿Está seguro de activar el artículo?", function(result){
        if(result){
            $.post("../ajax/articulos.php?op=activar", 
            {idarticulo: idarticulo},
            function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();