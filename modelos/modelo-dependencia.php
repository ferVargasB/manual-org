<?php
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//require_once "C:\wamp64\www\manuales_digitales\admin-area\funciones\funciones.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/manual-org/funciones/funciones.php';

if ($_POST['registro'] == 'nuevo') {
    $nombre = $_POST['nombre'];
    try {
        //obtener iniciales
        $iniciales_dependencia = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //carga el documento objetivo general
        $_FILES["diagrama"]["name"] = $iniciales_dependencia . ".png";
        $dir_diagrama = 'diagrama-' . basename($_FILES['diagrama']['name']);
        if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], '../diagramas/' . $dir_diagrama)) {
            throw new Exception('No se ha podido subir el diagrama');
        }

        //carga el documento objetivo general
        $_FILES["objetivo-general"]["name"] = $iniciales_dependencia . ".pdf";
        $dir_objetivo = 'objetivo-' . basename($_FILES['objetivo-general']['name']);
        if (!move_uploaded_file($_FILES['objetivo-general']['tmp_name'], "../objetivos-pdf/generales/" . $dir_objetivo)) {
            throw new Exception('No se ha podido subir el objetivo general');
        }

        //carga el documento perfil de puesto
        $_FILES["perfil-puesto"]["name"] = $iniciales_dependencia . ".pdf";
        $dir_perfil = 'perfil-' . basename($_FILES['perfil-puesto']['name']);
        if (move_uploaded_file($_FILES['perfil-puesto']['tmp_name'], "../perfiles-pdf/dependencias/" . $dir_perfil)) { } else {
            throw new Exception('No se ha podido subir el perfil de puesto');
        }

        //carga el documento atribucion
        $_FILES["atribucion"]["name"] = $iniciales_dependencia . ".pdf";
        $dir_atribucion = 'atribucion-' . basename($_FILES['atribucion']['name']);
        if (move_uploaded_file($_FILES['atribucion']['tmp_name'], "../atribuciones-pdf/dependencias/" . $dir_atribucion)) { } else {
            throw new Exception('No se ha podido subir un archivo');
        }

        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("INSERT INTO dependencias(nombre,ruta_objetivo_general,ruta_perfil_puesto,ruta_atribuciones,ruta_diagrama) VALUES(:nombre,:objetivo,:perfil,:atribucion,:diagrama)");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":objetivo", $dir_objetivo);
        $stmn->bindParam(":perfil", $dir_perfil);
        $stmn->bindParam(":atribucion", $dir_atribucion);
        $stmn->bindParam(":diagrama", $dir_diagrama);
        if ($stmn->execute()) {
            $respuesta = array(
                "respuesta" => "exito",
                "id_admin" => $stmn,
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
    $id = $_POST['id'];
    try {
        //Se obtienen todos los procesos de la dependencia
        $stm = $objetoPDO->prepare("SELECT id_proceso FROM procesos_dependencias WHERE dependencia_perteneciente = :id");
        $stm->bindParam("id", $id);
        $stm->execute();
        $procesos_dependencias = $stm->fetchAll(PDO::FETCH_ASSOC);

        //Se borran los actores ligados a cada proceso
        foreach ($procesos_dependencias as $proceso) {
            $objetoPDO->exec("DELETE FROM procesos_actores_dependencias WHERE id_proceso_dependencia = " . $proceso['id_proceso']);
        }

        //Se borran los procesos ligados a la dependecnia
        $objetoPDO->beginTransaction();
        $objetoPDO->exec("DELETE FROM procesos_dependencias WHERE dependencia_perteneciente = " . $id);

        //Se obtiene informacion del la dependencia
        $stm = $objetoPDO->prepare("SELECT id_dependencia,nombre,ruta_objetivo_general,ruta_perfil_puesto,ruta_atribuciones,ruta_diagrama FROM dependencias WHERE id_dependencia = :id");
        $stm->bindParam("id", $id);
        $stm->execute();
        $data_tramite = $stm->fetchAll(PDO::FETCH_ASSOC);
        if (!unlink('../diagramas/' . $data_tramite[0]['ruta_diagrama'])) {
            throw new Exception("Error al eliminar el diagrama");
        }

        if (!unlink('../objetivos-pdf/generales/' . $data_tramite[0]['ruta_objetivo_general'])) {
            throw new Exception("Error al eliminar el objetivo");
        }

        if (!unlink('../perfiles-pdf/dependencias/' . $data_tramite[0]['ruta_perfil_puesto'])) {
            throw new Exception("Error al eliminar el perfil");
        }

        if (!unlink('../atribuciones-pdf/dependencias/' . $data_tramite[0]['ruta_atribuciones'])) {
            throw new Exception("Error al eliminar la atribucion");
        }

        //Se borra el registro
        $objetoPDO->exec("DELETE FROM dependencias WHERE id_dependencia = " . $id);
        $respuesta = array(
            "respuesta" => "exito",
            "id_dependencia" => $id,
        );

        $objetoPDO->commit();
    } catch (Exception $e) {
        $objetoPDO->rollBack();
        $respuesta = array(
            "respuesta" => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}

if ($_POST['registro'] == "actualizar") {
    $nombre = $_POST['nombre'];
    $id_dependencia = $_POST['id_registro'];
    try {
        //obtener iniciales
        $iniciales_dependencia = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //carga el diagrama
        $dir_diagrama = "";
        if ($_FILES["diagrama"]["size"] > 0) {
            $_FILES["diagrama"]["name"] = $iniciales_dependencia . ".png";
            $dir_diagrama = 'diagrama-' . basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], '../diagramas/' . $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } else {
            $dir_diagrama = $_POST['ruta_actual_diagrama'];
        }

        //carga el documento objetivo general
        $dir_objetivo = "";
        if ($_FILES["objetivo-general"]["size"] > 0) {
            $_FILES["objetivo-general"]["name"] = $iniciales_dependencia . ".pdf";
            $dir_objetivo = 'objetivo-' . basename($_FILES['objetivo-general']['name']);
            if (!move_uploaded_file($_FILES['objetivo-general']['tmp_name'], '../objetivos-pdf/generales/' . $dir_objetivo)) {
                throw new Exception('No se ha podido subir el objetivo');
            }
        } else {
            $dir_objetivo = $_POST['ruta_actual_objetivo'];
        }


        //carga el documento perfil de puesto
        $dir_perfil = "";
        if ($_FILES["perfil-puesto"]["size"] > 0) {
            $_FILES["perfil-puesto"]["name"] = $iniciales_dependencia . ".pdf";
            $dir_perfil = 'perfil-' . basename($_FILES['perfil-puesto']['name']);
            if (!move_uploaded_file($_FILES['perfil-puesto']['tmp_name'], "../perfiles-pdf/dependencias/" . $dir_perfil)) {
                throw new Exception('No se ha podido subir el perfil de puesto');
            }
        } else {
            $dir_perfil = $_POST['ruta_actual_perfil'];
        }

        //carga el documento atribucion
        $dir_atribucion = "";
        if ($_FILES["atribucion"]["size"] > 0) {
            $_FILES["atribucion"]["name"] = $iniciales_dependencia . ".pdf";
            $dir_atribucion = 'atribucion-' . basename($_FILES['atribucion']['name']);
            if (!move_uploaded_file($_FILES['atribucion']['tmp_name'], '../atribuciones-pdf/dependencias/' . $dir_atribucion)) {
                throw new Exception('No se ha podido subir la atribucion');
            }
        } else {
            $dir_atribucion = $_POST['ruta_actual_atribucion'];
        }
        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("UPDATE dependencias SET nombre=:nombre,ruta_objetivo_general=:objetivo,ruta_perfil_puesto=:perfil,ruta_atribuciones=:atribucion,ruta_diagrama=:diagrama WHERE id_dependencia=:id");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":objetivo", $dir_objetivo);
        $stmn->bindParam(":perfil", $dir_perfil);
        $stmn->bindParam(":atribucion", $dir_atribucion);
        $stmn->bindParam(":diagrama", $dir_diagrama);
        $stmn->bindParam(":id", $id_dependencia);
        if ($stmn->execute()) {
            $respuesta = array(
                "respuesta" => "exito",
                "id_admin" => $stmn,
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

function obtener_iniciales($data)
{
    $palabras = explode(" ", $data);
    $iniciales = "dependencia-";
    foreach ($palabras as $palabra) {
        $iniciales .= substr($palabra, 0, 1);
    }
    return $iniciales;
}
