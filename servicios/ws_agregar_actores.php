<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//require_once "C:\wamp64\www\manuales_digitales\admin-area\\funciones\\funciones.php";
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
$nombre_servicio = $_GET["numero_servicio"];


if ($_GET["numero_servicio"] == 1)
{
    $id = $_GET["id_proceso"];
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT id_proceso,numero_actores FROM procesos WHERE id_proceso = :id LIMIT 1");
        $stmn->bindParam(":id", $id);
        $stmn->execute();
        $respuesta;
        $data = $stmn->fetch(PDO::FETCH_ASSOC);
        if ($data)
        {
            $jdata = array(
                "id" => $data["id_proceso"],
                "numero_actores" =>  $data["numero_actores"]
            );

            $respuesta = $jdata;

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