<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//require_once "C:\wamp64\www\manuales_digitales\admin-area\\funciones\\funciones.php";
//include_once '../funciones/funciones.php';
$nombre_servicio = $_GET["numero_servicio"];


if ($_GET["numero_servicio"] == 1)
{
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT id_actor,nombre,es_director,ruta_atribucion FROM actores ORDER BY nombre");
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
    } catch (Exception $e) 
    {
        echo $e->getMessage();
    }

    die(json_encode($respuesta));
}
?>