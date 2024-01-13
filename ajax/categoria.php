<?php

    require_once "../modelos/categoria.php";

    $categoria = new Categoria();

    $idcategoria = isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";

    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

    $descripcion = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";


    switch($_GET["op"]){
        case 'guardareditar':
            if(empty($idcategoria)){
                $respuesta = $categoria->insertar($nombre, $descripcion);
                echo $respuesta? "Categoría registrada" : "Categoría no se pudo registrar";
            }else{
                $respuesta = $categoria->editar($idcategoria, $nombre, $descripcion);
                echo $respuesta? "Categoría actualizada" : "Categoría no se pudo actualizar";
            }
        break;

        case 'desactivar':
            $respuesta = $categoria->desactivar($idcategoria);
            echo $respuesta? "Categoría desactivada" : "Categoría no se pudo desactivar";
        break;

        case 'activar':
            $respuesta = $categoria->activar($idcategoria);
            echo $respuesta? "Categoría activada" : "Categoría no se pudo activar";
        break;

        case 'mostrar':
            $respuesta = $categoria->mostrar($idcategoria);
            echo json_encode($respuesta);
        break;

        case 'listar':
            $respuesta = $categoria->listar();

            $data = Array();

            while($resp=$respuesta->fetch_object()){
                $data[] = array(
                    "0"=>($resp->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$resp->idcategoria.')">
                    <i class="fa fa-pen"></i></button>'.'<button class="btn btn-danger" onclick="desactivar('.$resp->idcategoria.')">
                    <i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$resp->idcategoria.')">
                    <i class="fa fa-pen"></i></button>'.'<button class="btn btn-primary" onclick="activar('.$resp->idcategoria.')">
                    <i class="fa fa-check"></i></button>',
                    "1"=>$resp->nombre,
                    "2"=>$resp->descripcion,
                    "3"=>$resp->condicion?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desctivado</span>',
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