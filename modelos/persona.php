<?php

    require_once "../configuracion/conexion.php";

    class Persona{

        public function __construct(){

        }

        public function insertar($tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email){
            $sql = "INSERT INTO persona(tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email) VALUES 
            ('$tipo_persona','$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email')";
            return ejConsulta($sql);
        }

        public function editar($idpersona,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email){
            $sql = "UPDATE persona SET tipo_persona='$tipo_persona',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email' WHERE idpersona='$idpersona'";
            return ejConsulta($sql);
        }

        public function eliminar($idpersona){
            $sql="DELETE FROM persona WHERE idpersona='$idpersona'";
            return ejConsulta($sql);
        }

        public function mostrar($idpersona){
            $sql = "SELECT * FROM persona WHERE idpersona='$idpersona'";
            return ejConsultaUnica($sql);
        }

        public function listarP(){
            $sql = "SELECT * FROM persona WHERE tipo_persona='proveedor'";
            return ejConsulta($sql);
        }

        public function listarC(){
            $sql="SELECT * FROM persona WHERE tipo_persona='clientes'";
            return ejConsulta($sql);		
        }
    }

?>