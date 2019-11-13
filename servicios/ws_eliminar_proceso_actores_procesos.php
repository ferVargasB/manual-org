<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//include_once '../funciones/funciones.php';

if ($_GET['no_service'] == 1) 
{  
    $id_proceso = $_POST['id_proceso'];
    try {
        if(!isset($id_proceso))
        {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        $stmn = $objetoPDO->prepare("DELETE FROM procesos_actores WHERE id_proceso = :id_proceso");
        $stmn->bindParam(":id_proceso",$id_proceso);
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
}

?>