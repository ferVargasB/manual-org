<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//include_once '../funciones/funciones.php';
$nombre_servicio = $_GET["numero_servicio"];


if ($_GET["numero_servicio"] == 1)
{
    $id = $_GET["id_s"];
    try 
    {
        $stmn = $objetoPDO->prepare("SELECT id_dependencia,nombre,codigo,ruta_objetivo_general,ruta_perfil_puesto,ruta_atribuciones FROM dependencias WHERE id_dependencia = :id LIMIT 1");
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
        $stmn = $objetoPDO->prepare("SELECT a.id_area,a.nombre,depen.id_dependencia,depen.nombre AS mombre_depen,depen.ruta_objetivo_general,depen.ruta_perfil_puesto,depen.ruta_atribuciones FROM areas AS a INNER JOIN dependencias AS depen on a.dependencia_perteneciente = depen.id_dependencia WHERE a.dependencia_perteneciente = :id");
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