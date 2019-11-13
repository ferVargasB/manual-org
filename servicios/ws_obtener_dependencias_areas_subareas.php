<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//include_once '../funciones/funciones.php';
$nombre_servicio = $_GET["numero_servicio"];


if ($_GET["numero_servicio"] == 1)
{
    $respuesta;
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT depen.id_dependencia,depen.nombre,a.id_area,a.nombre AS area_nombre,a.dependencia_perteneciente FROM dependencias AS depen INNER JOIN areas AS a ON depen.id_dependencia = a.dependencia_perteneciente ORDER BY id_dependencia");
        $stmn->execute();
        $respuesta;
        $data = $stmn->fetchAll(PDO::FETCH_ASSOC);
        if ($data)
        {
            $respuesta = $data;
        }
        else
        {
            $respuesta = array(
                "respuesta" => "no_existe"
            );
        }
    } catch (Throwable $e) 
    {
        echo $e->getMessage();
    }
    die(json_encode($respuesta));
}
?>