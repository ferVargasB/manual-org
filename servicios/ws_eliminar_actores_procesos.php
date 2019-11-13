<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';

if ($_GET['no_service'] == 1) 
{  
    $id_proceso = $_POST['id_proceso'];
    $id_actor = $_POST['id_actor'];
    try {
        if(!isset($id_proceso) || !isset($id_actor))
        {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("DELETE FROM procesos_actores WHERE id_proceso = :id_proceso AND id_actor = :id_actor");
        $stmn->bindParam(":id_proceso",$id_proceso);
        $stmn->bindParam(":id_actor",$id_actor);
        if($stmn->execute())
        {
            $id_proceso = $objetoPDO->lastInsertId();
            $respuesta = array(
                "respuesta" => "exito"
            );
        }
        else
        {
            $respuesta = array(
                "respuesta" => "error",
                "id_admin" => $stmn,
            );
        }
        $conn = null;
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => "error",
            "mensaje" => $e->getMessage()
        );
    }
    die(json_encode($respuesta));

} elseif ($_GET['numero_servicio'] == 2){
    try {
        if(!isset($_POST['id_proceso']) || !isset($_POST['id_actor']))
        {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        $id_proceso = $_POST['id_proceso'];
        $id_actor = $_POST['id_actor'];
        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("DELETE FROM procesos_actores_subareas WHERE id_proceso_subarea = :id_proceso AND id_actor = :id_actor");
        $stmn->bindParam(":id_proceso",$id_proceso);
        $stmn->bindParam(":id_actor",$id_actor);
        if($stmn->execute())
        {
            $id_proceso = $objetoPDO->lastInsertId();
            $respuesta = array(
                "respuesta" => "exito"
            );
        }
        else
        {
            $respuesta = array(
                "respuesta" => "error",
                "id_admin" => $stmn,
            );
        }
        $conn = null;
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => "error",
            "mensaje" => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
} else {
    die("UUUUPS!");
}

?>