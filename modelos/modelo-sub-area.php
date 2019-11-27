<?php
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/manual-org/funciones/funciones.php';
//Cuando se crea
if ($_POST['registro'] == 'nuevo') {
    $nombre = $_POST['nombre'];
    $area = $_POST['area_perteneciente'];
    try {
        //obtener iniciales
        $iniciales_area = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //carga el diagrama del area
        $dir_diagrama = "";
        if ( $_FILES["diagrama"]["size"] > 0 ){
            $_FILES["diagrama"]["name"] = "diagrama_".$area."_".strtr($nombre," ","_"). ".pdf";
            $dir_diagrama = basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], "../diagramas/sub_areas/" . $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } 


        //carga el documento perfil de puesto
        $_FILES["perfil-puesto"]["name"] = "perfil_".$area."_".strtr($nombre," ","_").".pdf";
        $dir_perfil = basename($_FILES['perfil-puesto']['name']);
        if (!move_uploaded_file($_FILES['perfil-puesto']['tmp_name'], "../perfiles-pdf/sub_areas/" . $dir_perfil)) {
            throw new Exception('No se ha podido subir un el perfil de puesto');
        }

        //carga el documento atribucion
        $_FILES["atribucion"]["name"] = "atribucion-".$area."_".strtr($nombre," ","_").".pdf";
        $dir_atribucion = basename($_FILES['atribucion']['name']);
        if (!move_uploaded_file($_FILES['atribucion']['tmp_name'], "../atribuciones-pdf/sub_areas/" . $dir_atribucion)) {
            throw new Exception('No se ha podido subir un archivo');
        }

        //guardar todos los campos en la bd.
        $stmn = $objetoPDO->prepare("INSERT INTO sub_areas(nombre,ruta_perfil_puesto,ruta_atribucion,ruta_diagrama, area_perteneciente) VALUES(:nombre,:perfil,:atribucion,:diagrama,:area)");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":perfil", $dir_perfil);
        $stmn->bindParam(":atribucion", $dir_atribucion);
        $stmn->bindParam(":diagrama", $dir_diagrama);
        $stmn->bindParam(":area", $area);
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

// Cuando se elimina un registro 
if ($_POST['registro'] == "eliminar") {
    $id = $_POST['id'];
    try {
        //Se obtienen todos los procesos de la sub area
        $stm = $objetoPDO->prepare("SELECT id_proceso,ruta_diagrama,ruta_ficha FROM procesos_subareas WHERE subarea_perteneciente = :id");
        $stm->bindParam("id", $id);
        $stm->execute();
        $procesos_area = $stm->fetchAll(PDO::FETCH_ASSOC);

        //Se borran los actores ligados a cada proceso
        foreach ($procesos_area as $proceso) {
            unlink('../procesos/por_subareas/' . $proceso[0]['ruta_diagrama']);
            unlink('../procesos/por_subareas/' . $proceso[0]['ruta_ficha']);
            $objetoPDO->exec("DELETE FROM procesos_actores_subareas WHERE id_proceso_subarea = " . $proceso['id_proceso']);
        }

        //Se borran los procesos ligados al area
        $objetoPDO->beginTransaction();
        $objetoPDO->exec("DELETE FROM procesos_subareas WHERE subarea_perteneciente = " . $id);

        //Se obtiene informacion del area
        $stm = $objetoPDO->prepare("SELECT id_subarea,nombre,ruta_perfil_puesto,ruta_atribucion,ruta_diagrama FROM sub_areas WHERE id_subarea = :id");
        $stm->bindParam("id", $id);
        $stm->execute();
        $data_tramite = $stm->fetchAll(PDO::FETCH_ASSOC);

        unlink('../diagramas/sub_areas/' . $data_tramite[0]['ruta_diagrama']);

        unlink('../perfiles-pdf/sub_areas/' . $data_tramite[0]['ruta_perfil_puesto']);

        unlink('../atribuciones-pdf/sub_areas/' . $data_tramite[0]['ruta_atribucion']);

        //Se borra el registro
        $objetoPDO->exec("DELETE FROM sub_areas WHERE id_subarea = " . $id);
        $respuesta = array(
            "respuesta" => "exito",
            "id_area" => $id,
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

//Cuando se actualiza
if ($_POST['registro'] == "actualizar") {
    $nombre = $_POST['nombre'];
    $id_registro = $_POST['id_registro'];
    $area = $_POST['area_perteneciente'];
    try {
        //obtener iniciales
        $iniciales_area = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //actualiza el diagrama del area si se subió
        $dir_diagrama = "";
        if ($_FILES["diagrama"]["size"] > 0) {
            $_FILES["diagrama"]["name"] = "diagrama_".$area."_".strtr($nombre," ","_").".png";
            $dir_diagrama = basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], "../diagramas/sub_areas/" . $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } else {
            $dir_diagrama = $_POST['ruta_actual_diagrama'];
        }


        //actualiza el documento perfil de puesto
        $dir_perfil = "";
        if ($_FILES["perfil-puesto"]["size"] > 0) {
            $_FILES["perfil-puesto"]["name"] = "perfil_".$area."_".strtr($nombre," ","_").".pdf";
            $dir_perfil = basename($_FILES['perfil-puesto']['name']);
            if (!move_uploaded_file($_FILES['perfil-puesto']['tmp_name'], "../perfiles-pdf/sub_areas/" . $dir_perfil)) {
                throw new Exception('No se ha podido subir el perfil');
            }
        } else {
            $dir_perfil = $_POST['ruta_actual_perfil'];
        }


        //actualiza el documento atribucion
        $dir_atribucion = "";
        if ($_FILES["atribucion"]["size"] > 0) {
            $_FILES["atribucion"]["name"] = "atribucion_".$area."_".strtr($nombre," ","_").".pdf";
            $dir_atribucion = basename($_FILES['atribucion']['name']);
            if (!move_uploaded_file($_FILES['atribucion']['tmp_name'], "../atribuciones-pdf/sub_areas/" . $dir_atribucion)) {
                throw new Exception('No se ha podido subir la atribucion');
            }
        } else {
            $dir_atribucion =  $_POST['ruta_actual_atribucion'];
        }


        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("UPDATE sub_areas SET nombre=:nombre,ruta_perfil_puesto=:perfil,ruta_atribucion=:atribucion,ruta_diagrama=:diagrama,area_perteneciente=:area WHERE id_subarea=:id");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":perfil", $dir_perfil);
        $stmn->bindParam(":atribucion", $dir_atribucion);
        $stmn->bindParam(":diagrama", $dir_diagrama);
        $stmn->bindParam(":area", $area);
        $stmn->bindParam(":id", $id_registro);
        if ($stmn->execute()) {
            $respuesta = array(
                "respuesta" => "exito",
                "id" => $id_registro,
            );
        } else {
            $respuesta = array(
                "respuesta" => "error",
                "id" => $id_registro,
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
    $iniciales = "subarea-";
    foreach ($palabras as $palabra) {
        $iniciales .= substr($palabra, 0, 1);
    }
    return $iniciales;
}
