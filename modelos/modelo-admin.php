<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$puesto = $_POST['puesto'];
$rol = $_POST['rol'];
$id_registro = $_POST['id_registro'];

if ($_POST['registro'] == 'nuevo' ) 
{
    //die(var_dump($_POST));
    $respuesta = array();
    try {
        $stmn = $objetoPDO->prepare("INSERT INTO usuarios(nombre,correo,password,puesto,rol) VALUES(:nombre,:correo,:password,:puesto,:rol)");
        $stmn->bindParam(":nombre",$nombre);
        $stmn->bindParam(":correo",$correo);
        $stmn->bindParam(":password",$password);
        $stmn->bindParam(":puesto",$puesto);
        $stmn->bindParam(":rol",$rol);
        if($stmn->execute())
        {
            $respuesta['respuesta'] = 'exito';
        }
        else
        {
            throw new Exception('Ocurrió un error en la consulta');
        }
    } catch (Throwable $e) {
        echo $e->getMessage();
    }
    die(json_encode($respuesta));
}

if ($_POST['registro'] == "actualizar")
{
    try {
        $stmn = $objetoPDO->prepare("UPDATE usuarios SET nombre = :nombre, correo = :correo, password = :password, puesto = :puesto, rol = :rol WHERE id_usuario = :id_usuario;");
        $stmn->bindParam(":nombre",$nombre);
        $stmn->bindParam(":correo",$correo);
        $stmn->bindParam(":password",$password);
        $stmn->bindParam(":puesto",$puesto);
        $stmn->bindParam(":rol",$rol);
        $stmn->bindParam(":id_usuario",$id_registro);
        
        if ($stmn->execute())
        {
            $respuesta = array(
                "respuesta" => "exito",
                "id_actualizado" => $stmn->insert_id
            );
        }
        else
        {
            $respuesta = array(
                "respuesta" => "error"
            );
        }

    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}

if ($_POST['registro'] == "eliminar")
{
    $id = $_POST['id'];

    try {
        $stmn = $objetoPDO->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
        $stmn->bindParam(":id",$id);
        if ($stmn->execute())
        {
            $respuesta = array(
                "respuesta" => "exito",
                "id_eliminado" => $id
            );
        }
        else
        {
            $respuesta = array(
                "respuesta" => "error"
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}


?>