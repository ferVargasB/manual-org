<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/manual-org/funciones/funciones.php';
//include_once 'funciones/funciones.php';
//include_once '../funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';

if ($_GET['numero_servicio'] == 1) {
    $respuesta = array();
    $id_proceso = $_POST['id_proceso'];
    try {
        if (!isset($_POST['id_proceso'])) {
            throw new Exception('Existe un error, volver a intentarlo');
        }
        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("SELECT pas.id_actor, a.nombre FROM procesos_subareas AS ps
        INNER JOIN procesos_actores_subareas AS pas
        ON ps.id_proceso = pas.id_proceso_subarea
        INNER JOIN actores AS a
        ON pas.id_actor = a.id_actor WHERE pas.id_proceso_subarea = :id_proceso");
        $stmn->bindParam(":id_proceso", $id_proceso);
        $respuesta;
        if ($stmn->execute()) {
            $id_proceso = $objetoPDO->lastInsertId();
            $respuesta = $stmn->fetchAll(PDO::FETCH_ASSOC);
        } else {
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
