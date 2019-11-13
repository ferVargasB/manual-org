<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//include_once '../funciones/funciones.php';
$nombre_servicio = $_GET["numero_servicio"];


if ($_GET["numero_servicio"] == 1)
{
    $id = $_GET["id"];
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT id_area,nombre,dependencia_perteneciente FROM areas WHERE dependencia_perteneciente = :id LIMIT 1");
        $stmn->bindParam(":id", $id);
        $stmn->execute();
        $respuesta;
        $data = $stmn->fetch(PDO::FETCH_ASSOC);
        if ($data)
        {
/*             $jdata["id"] = $data["id_dependencia"];
            $jdata["nombre"] = $data["nombre"];
            $jdata["ruta"] = $data["ruta"]; */

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

if($_GET["numero_servicio"] == 2)
{
    $id = $_GET["id"];
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT sa.id_subarea, sa.nombre,sa.nombre,sa.ruta_perfil_puesto,sa.atribucion,sa.area_perteneciente,a.nombre as nombre_area,  a.ruta_perfil_puesto as perfil_area, a.ruta_atribucion as atribucion_area  FROM sub_areas as sa INNER JOIN areas as a on sa.area_perteneciente = a.id_area WHERE area_perteneciente = :id;");
        $stmn->bindParam(":id", $id);
        $stmn->execute();
        $areas = array();
        $data = $stmn->fetchAll(PDO::FETCH_ASSOC);
        if ($data)
        {
            die(json_encode($data));
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
}
?>