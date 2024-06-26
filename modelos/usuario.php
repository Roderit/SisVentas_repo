<?php

    require_once "../configuracion/conexion.php";

    class Usuario{

        public function __construct(){

        }

        public function insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, 
            $login, $clave, $imagen, $permisos){
            $sql = "INSERT INTO usuario(nombre, tipo_documento, num_documento, direccion, telefono, email, cargo, login, clave, imagen, condicion) 
            VALUES('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$login','$clave','$imagen','1')";
            //return ejConsulta($sql);
            $idusuarionew = ejConsul_retornarID($sql);

            $num_elementos=0;
            $sw=true;

            while ($num_elementos < count($permisos)){

                $sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
                ejConsulta($sql_detalle) or $sw = false;
                $num_elementos=$num_elementos + 1;
            }

            return $sw;
        }

        public function editar($idusuario, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo,
            $login, $clave, $imagen, $permisos){
            $sql = "UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',
            telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' WHERE idusuario='$idusuario'";
            ejConsulta($sql);
            
            $sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
            ejConsulta($sqldel);

            $num_elementos=0;
		    $sw=true;
            
            while ($num_elementos < count($permisos))
            {
                $sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
                ejConsulta($sql_detalle) or $sw = false;
                $num_elementos=$num_elementos + 1;
            }

            return $sw;
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

        public function verificar($login,$clave)
        {
            $sql="SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,cargo,imagen,login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'"; 
            return ejConsulta($sql);  
        }
    }

?>