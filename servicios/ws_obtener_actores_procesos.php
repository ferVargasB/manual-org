<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'funciones/funciones.php';
//include_once '../funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';

if ($_GET['numero_servicio'] == 1) 
{  
    $respuesta = array();
    $id_proceso = $_POST['id_proceso'];
    try {
        if(!isset($_POST['id_proceso']))
        {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("SELECT p.id_proceso, p.nombre as nombreProceso,a.nombre as nombreArea, pa.id_actor, ac.nombre as nombreActor FROM actores as ac
        INNER JOIN procesos_actores as pa
        ON ac.id_actor = pa.id_actor
        INNER JOIN procesos as p
        ON pa.id_proceso = p.id_proceso
        INNER JOIN areas as a
        ON  p.area_perteneciente = a.id_area
        WHERE pa.id_proceso = :id_proceso");
        $stmn->bindParam(":id_proceso",$id_proceso);
        $respuesta;
        if($stmn->execute())
        {
            $id_proceso = $objetoPDO->lastInsertId();
            $respuesta = $stmn->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $respuesta['respuesta'] = 'error';
        }
        $conn = null;
        echo json_encode($respuesta);
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => "error",
            "mensaje" => $e->getMessage()
        );

        echo json_encode($respuesta);
    }
}

?>