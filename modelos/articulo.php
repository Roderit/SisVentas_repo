<?php

    require_once "../configuracion/conexion.php";

    class Articulo{

        public function __construct(){

        }

        public function insertar($nombre, $descripcion){
            $sql = "INSERT INTO articulo (idcategoria, codigo, nombre, stock, descripcion, imagen, condicion) VALUES ('$idcategoria', 
            '$codigo', '$nombre', '$stock', '$descripcion', '$imagen', '1')";
            return ejConsulta($sql);
        }

        public function editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen){
            $sql = "UPDATE articulo SET idcategoria=$idcategoria, codigo=$codigo, nombre='$nombre', stock=$stock,
            descripcion='$descripcion', imagen=$imagen WHERE idarticulo='$idarticulo'";
            return ejConsulta($sql);
        }

        public function activar($idarticulo){
            $sql = "UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
            return ejConsulta($sql);
        }

        public function desactivar($idarticulo){
            $sql = "UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
            return ejConsulta($sql);
        }

        public function mostrar($idarticulo){
            $sql = "SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
            return ejConsultaUnica($sql);
        }

        public function listar(){
            $sql = "SELECT * FROM articulo";
            return ejConsulta($sql);
        }
    }

?>