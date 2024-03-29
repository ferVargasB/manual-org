<?php
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//require_once "C:\wamp64\www\manuales_digitales\admin-area\\funciones\\funciones.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/manual-org/funciones/funciones.php';

if ($_POST['registro'] == 'nuevo' && isset($_POST['subarea_perteneciente'])) {
    $nombre = $_POST['nombre'];
    $ruta_diagrama = "";
    $ruta_ficha = "";
    $numero_actores = $_POST["numero_actores"];
    $subarea_perteneciente = $_POST["subarea_perteneciente"];
    try {
        //PARTE PARA SUBIR LOS DOCUMENTOS
        //carga el diagrama del proceso 
        $_FILES["diagrama"]["name"] = "diagrama_" . $subarea_perteneciente . "_" . strtr($nombre, " ", "_") . ".png";
        $ruta_diagrama = "../procesos/por_subareas/" . basename($_FILES['diagrama']['name']);
        if (move_uploaded_file($_FILES['diagrama']['tmp_name'], $ruta_diagrama)) { } else {
            throw new Exception('No se ha podido subir archivo diagrama');
        }

        //carga la ficha tecnica
        $ruta_ficha = "";
        if ($_FILES["ficha"]["size"] > 0) {
            $_FILES["ficha"]["name"] = "ficha_" . $subarea_perteneciente . "_" . strtr($nombre, " ", "_") . ".pdf";
            $ruta_ficha = "../procesos/por_subareas/" . basename($_FILES['ficha']['name']);
            if (!move_uploaded_file($_FILES['ficha']['tmp_name'], $ruta_ficha)) {
                throw new Exception('No se ha podido subir archivo ficha');
            }
        }

        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("INSERT INTO procesos_subareas (nombre,ruta_diagrama,ruta_ficha,numero_actores,subarea_perteneciente) VALUES(:nombre,:diagrama,:ficha,:numero_actores,:subarea)");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":diagrama", $ruta_diagrama);
        $stmn->bindParam(":ficha", $ruta_ficha);
        $stmn->bindParam(":numero_actores", $numero_actores);
        $stmn->bindParam(":subarea", $subarea_perteneciente);
        $id_proceso = 0;
        if ($stmn->execute()) {
            $id_proceso = $objetoPDO->lastInsertId();
            $respuesta = array(
                "respuesta" => "exito",
                "nombre" => $nombre,
                "id_proceso" => $id_proceso,
                "ruta_diagrama" => $ruta_diagrama,
                "ruta_ficha" => $ruta_ficha,
                "numero_actores" => $numero_actores,
                "dependencia" => $subarea_perteneciente
            );
        } else {
            $respuesta = array(
                "respuesta" => "error",
                "id_admin" => $stmn,
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

if ($_POST['registro'] == "eliminar") {
    $respuesta = array();
    $id = $_POST['id_proceso'];

    try {
        //Se obtiene la info del proceso
        $stm = $objetoPDO->prepare("SELECT id_proceso,ruta_diagrama,ruta_ficha FROM procesos_subareas WHERE id_proceso = :id");
        $stm->bindParam("id", $id);
        $stm->execute();
        $data_proceso = $stm->fetchAll(PDO::FETCH_ASSOC);
        /*         echo json_encode(".procesos/por_dependencias/".pathinfo($data_proceso[0]["ruta_diagrama"], PATHINFO_BASENAME ));
        die; */

        $objetoPDO->beginTransaction();
        //Se borran los actores ligados al proceso
        $objetoPDO->exec("DELETE FROM procesos_actores_subareas WHERE id_proceso_subarea = " . $id);

        unlink("../procesos/por_subareas/" . pathinfo($data_proceso[0]["ruta_diagrama"], PATHINFO_BASENAME));
        unlink("../procesos/por_subareas/" . pathinfo($data_proceso[0]["ruta_ficha"], PATHINFO_BASENAME));

        //Se borra el proceso
        $objetoPDO->exec("DELETE FROM procesos_subareas WHERE id_proceso = " . $id);

        $respuesta = array(
            "estado" => "ok"
        );

        $objetoPDO->commit();
    } catch (Exception $e) {
        $objetoPDO->rollBack();
        $respuesta = array(
            "estado" => $e->getMessage()
        );
    }

    echo json_encode($respuesta);
}

if ($_POST['registro'] == "actualizar") {

    $nombre = $_POST['nombre'];
    $subarea_perteneciente = $_POST['subarea_perteneciente'];

    /*REALIZAR LA OPERACIÓN DE ACTUALIZAR*/
    try {
        $respuesta = "";

        //Verifica que se hayan cambiado el numero de actores
        if (intval($_POST['no_actores_actual']) != intval($_POST['numero_actores'])) {
            $respuesta = borrar_actores_procesos($objetoPDO, $_POST['id_proceso']);
        }

        $dir_diagrama = "";
        if ($_FILES["diagrama"]["name"]) {
            $_FILES["diagrama"]["name"] = "diagrama_" . $subarea_perteneciente . "_" . strtr($nombre, " ", "_") . ".png";
            $dir_diagrama = "../procesos/por_subareas/" . basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } else {
            $dir_diagrama = $_POST['ruta_diagrama_actual'];
        }

        //carga la ficha tecnica
        $ruta_ficha = "";
        if ($_FILES["ficha"]["size"] > 0) {
            $_FILES["ficha"]["name"] = "ficha_" . $subarea_perteneciente . "_" . strtr($nombre, " ", "_") . ".pdf";
            $ruta_ficha = "../procesos/por_subareas/" . basename($_FILES['ficha']['name']);
            if (!move_uploaded_file($_FILES['ficha']['tmp_name'], $ruta_ficha)) {
                throw new Exception('No se ha podido subir archivo ficha');
            }
        } else {
            $ruta_ficha = $_POST['ruta_ficha_actual'];
        }

        $stmn = $objetoPDO->prepare("UPDATE procesos_subareas SET nombre=:nombre,ruta_diagrama=:diagrama,ruta_ficha=:ficha,numero_actores=:numero_actores,subarea_perteneciente=:area WHERE id_proceso=:proceso");
        $stmn->bindParam(":nombre", $_POST['nombre']);
        $stmn->bindParam(":diagrama", $dir_diagrama);
        $stmn->bindParam(":ficha", $ruta_ficha);
        $stmn->bindParam(":numero_actores", $_POST['numero_actores']);
        $stmn->bindParam(":area", $_POST['subarea_perteneciente']);
        $stmn->bindParam(":proceso", $_POST['id_proceso']);
        if ($stmn->execute()) {
            $respuesta = array(
                "respuesta" => "exito",
                "id" => $_POST['id_proceso'],
            );
        } else {
            $respuesta = array(
                "respuesta" => "error",
                "id" => $_POST['id_proceso'],
            );
        }
        echo json_encode($respuesta);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}


function borrar_actores_procesos($objetoPDO, $id_proceso)
{
    $respuesta = array();
    try {
        $stmn = $objetoPDO->prepare("DELETE FROM gaaso1_manuales.procesos_actores_subareas WHERE id_proceso_subarea = :id;");
        $stmn->bindParam(":id_proceso", $id_proceso);
        if ($stmn->execute()) {
            $respuesta['respuesta'] = 'exito';
        } else {
            throw new Exception('Ocurrió un problema al borrar los actores en el proceso');
        }
    } catch (Exception $e) {
        $respuesta['respuesta'] = 'error';
        $respuesta['mensaje'] = $e->getMessage();
    }

    return $respuesta;
}

function verificar_actores_proceso($objetoPDO, $datos)
{
    if ($datos['no_actores_actual'] != $datos['numero_actores']) {
        $stmn = $objetoPDO->prepare("SELECT id_proceso,id_actor FROM procesos_actores_subareas WHERE procesos_actores.id_proceso_subarea = :id;");
        $stmn->bindParam(":id", $datos['id_proceso']);
        if ($stmn->execute()) {
            $registros = $stmn->fetchAll(PDO::FETCH_ASSOC);
            if (count($registros) != 0) {
                $resultado = borrar_actores_procesos($objetoPDO, $datos['id_proceso']);
                if ($resultado['respuesta'] != 'exito') {
                    $datos['respuesta'] = "error";
                    $datos['mensaje'] = "Ha ocurrido un error al actualizar los actores en el procesos";
                    return $datos;
                } else {
                    $respuesta['respuesta'] = 'exito';
                    return $respuesta;
                }
            } else {
                $respuesta['respuesta'] = 'exito';
                return $respuesta;
            }
        } else {
            $datos['respuesta'] = "error";
            $datos['mensaje'] = "Ha ocurrido un error al ejecutar la consulta de actores en el proceso actual";
        }
    } else {
        $respuesta['respuesta'] = 'exito';
        return $respuesta;
    }
}
