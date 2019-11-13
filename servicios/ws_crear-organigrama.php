<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
$nombre_servicio = $_GET["numero_servicio"];


if ($_GET["numero_servicio"] == 1)
{
    $id = $_GET["aid"];
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT id_dependencia,nombre,codigo,ruta_objetivo_general,ruta_perfil_puesto,ruta_atribuciones FROM dependencias WHERE id_dependencia = :id LIMIT 1");
        $stmn->bindParam(":id", $id);
        $stmn->execute();
        $respuesta;
        $data = $stmn->fetch(PDO::FETCH_ASSOC);
        if ($data)
        {
            $jdata = array(
                "id" => $data["id_dependencia"],
                "nombre" =>  $data["nombre"],
                "codigo" => $data["codigo"],
                "objetivo_general" => $data["ruta_objetivo_general"],
                "perfil_puesto" => $data["ruta_perfil_puesto"],
                "atribuciones" => $data["ruta_atribuciones"]
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