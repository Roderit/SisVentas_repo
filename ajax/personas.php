<?php

    require_once "../modelos/persona.php";

    $persona = new Persona();

    $idpersona = isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
    $tipo_persona = isset($_POST["tipo_persona"])? limpiarCadena($_POST["tipo_persona"]):"";
    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $tipo_documento = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
    $num_documento = isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
    $direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
    $telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
    $email = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";


    switch($_GET["op"]){
        case 'guardareditar':
            if(empty($idpersona)){
                $respuesta = $persona->insertar($tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email);
                echo $respuesta? "Persona registrada" : "Persona no se pudo registrar";
            }else{
                $respuesta = $persona->editar($idpersona, $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email);
                echo $respuesta? "Persona actualizada" : "Persona no se pudo actualizar";
            }
        break;

        case 'eliminar':
            $respuesta = $persona->eliminar($idpersona);
            echo $respuesta ? "persona eliminada" : "la persona no se puede eliminar";
        break;

        case 'mostrar':
            $respuesta = $persona->mostrar($idpersona);
            echo json_encode($respuesta);
        break;

        case 'listarP':
            $respuesta = $persona->listarP();

            $data = Array();

            while($resp=$respuesta->fetch_object()){
                $data[] = array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$resp->idpersona.')"><i class="fa fa-pencil"></i></button>'.
 				    '<button class="btn btn-danger" onclick="eliminar('.$resp->idpersona.')"><i class="fa fa-trash"></i></button>',
                    "1"=>$resp->nombre,
                    "2"=>$resp->tipo_documento,
                    "3"=>$resp->num_documento,
                    "4"=>$resp->telefono,
                    "5"=>$resp->email
                );
            }

            $result = array(
                "echo"=>1,
                "totalrecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );

            echo json_encode($result);
        break;

        case 'listarC':
            $resspuesta = $persona->listarC();

             $data= Array();
    
             while ($reg=$respuesta->fetch_object()){
                $data[] = array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$resp->idpersona.')"><i class="fa fa-pencil"></i></button>'.
                    '<button class="btn btn-danger" onclick="eliminar('.$resp->idpersona.')"><i class="fa fa-trash"></i></button>',
                    "1"=>$resp->nombre,
                    "2"=>$resp->tipo_documento,
                    "3"=>$resp->num_documento,
                    "4"=>$resp->telefono,
                    "5"=>$resp->email
                );
            }

            $result = array(
                "echo"=>1,
                "totalrecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );

            echo json_encode($result);
        break;

    }
?>