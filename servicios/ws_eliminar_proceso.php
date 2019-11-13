<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
header('Content-Type: application/json');
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';

if ($_GET['numero_servicio'] == 1) 
{  
    $respuesta = array();
    try {
        if(!isset($_POST['id_proceso']))
        {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        die(var_dump($_POST));
        $id_proceso = $_POST['id_proceso'];
        $stmn = $objetoPDO->prepare("SELECT id_proceso,ruta_diagrama, ruta_ficha FROM procesos WHERE id_proceso = :id_proceso");
        $stmn->bindParam(":id_proceso",$id_proceso);
        if($stmn->execute())
        {
            $resultado = $stmn->fetchAll(PDO::FETCH_ASSOC);
            unlink($resultado[0]["ruta_diagrama"]);
            unlink($resultado[0]["ruta_ficha"]);

            $stmn = $objetoPDO->prepare("DELETE FROM procesos WHERE id_proceso = :id_proceso");
            $stmn->bindParam(":id_proceso",$id_proceso);
            if($stmn->execute())
            {
                $id_proceso = $objetoPDO->lastInsertId();
                $respuesta[] = array(
                    "respuesta" => "exito"
                );
            }
            else
            {
                throw new Exception('Existe un error, volver a intentarlo');
            }
        }
        else
        {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        echo json_encode($respuesta);
        $conn = null;
    } catch (Exception $e) {
        $respuesta[] = array(
            "respuesta" => "error",
            "mensaje" => $e->getMessage()
        );
    }
    //die(json_encode($respuesta));
}
else{
    $respuesta[] = array(
        "respuesta" => "error",
        "mensaje" => "error"
    );
}
echo json_encode($respuesta[0]);
?>