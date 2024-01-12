<?php

    require_once "../configuracion/conexion.php";

    class Categoria{

        public function __construct(){

        }

        public function insertar($nombre, $descripcion){
            $sql = "INSERT INTO categoria(nombre, descripcion, condicion) VALUES ('$nombre', '$descripcion', '1')";
            return ejConsulta($sql);
        }

        public function editar($idcategoria, $nombre, $descripcion){
            $sql = "UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' WHERE idcategoria='$idcategoria'";
            return ejConsulta($sql);
        }

        public function activar($idcategoria){
            $sql = "UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
            return ejConsulta($sql);
        }

        public function desactivar($idcategoria){
            $sql = "UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
            return ejConsulta($sql);
        }

        public function mostrar($idcategoria){
            $sql = "SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
            return ejConsultaUnica($sql);
        }

        public function listar(){
            $sql = "SELECT * FROM categoria";
            return ejConsulta($sql);
        }
    }

?>