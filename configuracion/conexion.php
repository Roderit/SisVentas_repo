<?php

    /*Llamado al archivo global.php*/
    require_once "global.php";

    /*Seteo de parámetros para la conexión con la BD*/
    $conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    /*Conexión con la BD*/
    mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

    /*Verificar conexión*/
    if(mysqli_connect_errno()){
        printf("Falló la conexión a la BD: %s\n", mysqli_connect_error());
    }


    if(!function_exists('ejConsulta')){

        /*Devuelve el resultado de una consulta*/
        function ejConsulta($sql){
            global $conexion;
            $query = $conexion->query($sql);
            return $query;
        }

        /*Devuelve el resultado de una fila*/
        function ejConsultaUnica($sql){
            global $conexion;
            $query = $conexion->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }

        /*Devuelve el ID de un usuario*/
        function ejConsul_retornarID($sql){
            global $conexion;
            $query = $conexion->query($sql);
            return $conexion->insert_id;
        }

        /*Limpiar una cadena*/
        function limpiarCadena($str){
            global $conexion;
            $str = mysqli_real_escape_string($conexion, trim($str));
            return htmlspecialchars($str);
        }
    }

?>