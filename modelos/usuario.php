<?php

    require_once "../configuracion/conexion.php";

    class Usuario{

        public function __construct(){

        }

        public function insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, 
            $login, $clave, $imagen, $permisos){
            $sql = "INSERT INTO usuario(nombre, tipo_documento, num_documento, direccion, telefono, email, cargo, login, clave, imagen, condicion) 
            VALUES('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$login','$clave','$imagen','1')";
            return ejConsulta($sql);
        }

        public function editar($idusuario, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo,
            $login, $clave, $imagen, $permisos){
            $sql = "UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',
            telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' WHERE idusuario='$idusuario'";
            return ejConsulta($sql);
        }

        public function desactivar($idusuario){
            $sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
            return ejConsulta($sql);
        }

        public function activar($idusuario){
            $sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
            return ejConsulta($sql);
        }

        public function mostrar($idusuario){
            $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
            return ejConsultaUnica($sql);
        }

        public function listar(){
            $sql = "SELECT * FROM usuario";
            return ejConsulta($sql);
        }

        public function listarmarcados($idusuario){
            $sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
            return ejConsulta($sql);		
        }
    }

?>