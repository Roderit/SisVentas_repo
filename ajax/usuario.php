<?php

    require_once "../modelos/usuario.php";

    $usuario = new Usuario();

    $idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
    $num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
    $direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
    $telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
    $email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
    $cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
    $login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
    $clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
    $imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


    switch($_GET["op"]){
        case 'guardareditar':
            if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){
                $imagen=$_POST["imagenactual"];
            }	
            else {
                $ext = explode(".", $_FILES["imagen"]["name"]);
                if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
                {
                    $imagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
                }
            }

            $clavehash = hash("SHA256",$clave);

            if(empty($idusuario)){
                $respuesta = $usuario->insertar($nombre, $tipo_documento, $num_documento, $direccion,
                $telefono, $email, $cargo, $login, $clavehash, $imagen, $_POST['permiso']);
                echo $respuesta? "Usuario registrada" : "Usuario no se pudo registrar";
            }else{
                $respuesta = $usuario->editar($idusuario, $nombre, $tipo_documento, $num_documento, $direccion,
                $telefono, $email, $cargo, $login, $clavehash, $imagen, $_POST['permiso']);
                echo $respuesta? "Usuario actualizada" : "Usuario no se pudo actualizar";
            }
        break;

        case 'desactivar':
            $rspta=$usuario->desactivar($idusuario);
             echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
        break;
    
        case 'activar':
            $rspta=$usuario->activar($idusuario);
             echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
        break;

        case 'mostrar':
            $respuesta = $usuario->mostrar($idusuario);
            echo json_encode($respuesta);
        break;

        case 'listar':
            $respuesta = $usuario->listar();

            $data = Array();

            while($resp=$respuesta->fetch_object()){
                $data[] = array(
                    "0"=>($resp->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$resp->idusuario.')">
                    <i class="fa fa-pen"></i></button>'.' <button class="btn btn-danger" onclick="desactivar('.$resp->idusuario.')">
                    <i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$resp->idusuario.')">
                    <i class="fa fa-pen"></i></button>'.' <button class="btn btn-primary" onclick="activar('.$resp->idusuario.')">
                    <i class="fa fa-check"></i></button>',
                    "1"=>$resp->nombre,
                    "2"=>$resp->tipo_documento,
                    "3"=>$resp->num_documento,
                    "4"=>$resp->telefono,
                    "5"=>$resp->email,
                    "6"=>$resp->login,
                    "7"=>"<img src='../files/usuarios/".$resp->imagen."' height='50px' width='50px' >",
                    "8"=>($resp->condicion)?'<span class="label bg-green">Activado</span>':
                    '<span class="label bg-red">Desactivado</span>'
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

        case 'permisos':

            require_once "../modelos/permiso.php";
    
            $permiso = new Permiso();
            $rspta = $permiso->listar();
            $id=$_GET['id'];
            $marcados = $usuario->listarmarcados($id);
    
            $valores=array();
    
            while ($per = $marcados->fetch_object()){
                array_push($valores, $per->idpermiso);
            }
    
    
            while ($resp = $rspta->fetch_object()){
                $sw=in_array($resp->idpermiso,$valores)?'checked':'';    
                echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$resp->idpermiso.'">'.$resp->nombre.'</li>';
            }
    
        break;

        case 'verificar':

            $login=$_POST['login'];
            $clave=$_POST['clave'];
    
            $clavehash=hash("SHA256",$clave);
    
            $rspta=$usuario->verificar($login, $clavehash);
    
            $fetch=$rspta->fetch_object();
    
            if(isset($fetch)){
    
                $_SESSION['idusuario']=$fetch->idusuario;
                $_SESSION['nombre']=$fetch->nombre;
                $_SESSION['imagen']=$fetch->imagen;
                $_SESSION['login']=$fetch->login;
    
                $marcados = $usuario->listarmarcados($fetch->idusuario);
    
                $valores=array();
    
                    while ($per = $marcados->fetch_object())
                    {
                        array_push($valores, $per->idpermiso);
                    }
    
    
            }
    
            in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
            in_array(2,$valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
            in_array(3,$valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
            in_array(4,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
            in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
            in_array(6,$valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
            in_array(7,$valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;
    
    
            echo json_encode($fetch);
    
    
    
    
    
        break;

    }
?>