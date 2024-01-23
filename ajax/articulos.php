<?php

    require_once "../modelos/articulo.php";

    $articulo = new Articulo();

    $idarticulo = isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
    $idcategoria = isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
    $codigo = isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $stock = isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
    $descripcion = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
    $imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


    switch($_GET["op"]){
        case 'guardareditar':
            if(empty($idarticulo)){
                $respuesta = $articulo->insertar($idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
                echo $respuesta? "Artículo registrado" : "Artículo no se pudo registrar";
            }else{
                $respuesta = $articulo->editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
                echo $respuesta? "Artículo actualizada" : "Artículo no se pudo actualizar";
            }
        break;

        case 'desactivar':
            $respuesta = $articulo->desactivar($idarticulo);
            echo $respuesta? "Artículo desactivada" : "Artículo no se pudo desactivar";
        break;

        case 'activar':
            $respuesta = $articulo->activar($idarticulo);
            echo $respuesta? "Artículo activada" : "Artículo no se pudo activar";
        break;

        case 'mostrar':
            $respuesta = $articulo->mostrar($idarticulo);
            echo json_encode($respuesta);
        break;

        case 'listar':
            $respuesta = $articulo->listar();

            $data = Array();

            while($resp=$respuesta->fetch_object()){
                $data[] = array(
                    "0"=>($resp->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$resp->idarticulo.')">
                    <i class="fa fa-pen"></i></button>'.'<button class="btn btn-danger" onclick="desactivar('.$resp->idarticulo.')">
                    <i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$resp->idarticulo.')">
                    <i class="fa fa-pen"></i></button>'.'<button class="btn btn-primary" onclick="activar('.$resp->idarticulo.')">
                    <i class="fa fa-check"></i></button>',
                    "1"=>$resp->idcategoria,
                    "2"=>$resp->codigo,
                    "3"=>$resp->nombre,
                    "4"=>$resp->stock,
                    "5"=>$resp->descripcion,
                    "6"=>"<img src='../files/articulos/".$resp->imagen."' height='50px' width='50px' >",
                    "7"=>($resp->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desctivado</span>',
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