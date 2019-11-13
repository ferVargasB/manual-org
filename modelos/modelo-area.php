<?php
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/manual-org/funciones/funciones.php';
//Cuando se crea
if ($_POST['registro'] == 'nuevo') {
    $nombre = $_POST['nombre'];
    $id_dependencia = $_POST['dependencia_perteneciente'];
    try {
        //obtener iniciales
        $iniciales_area = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //carga el diagrama del area
        $dir_diagrama = "";
        if ( $_FILES["diagrama"]["size"] > 0 ){
            $_FILES["diagrama"]["name"] = "diagrama-" . $iniciales_area . ".pdf";
            $dir_diagrama = basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], "../diagramas/areas/" . $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } 

        //carga el documento perfil de puesto
        $_FILES["perfil-puesto"]["name"] = "perfil-" . $iniciales_area . ".pdf";
        $dir_perfil = basename($_FILES['perfil-puesto']['name']);
        if (!move_uploaded_file($_FILES['perfil-puesto']['tmp_name'], "../perfiles-pdf/areas/" . $dir_perfil)) {
            throw new Exception('No se ha podido subir un el perfil de puesto');
        }

        //carga el documento atribucion
        $_FILES["atribucion"]["name"] = "atribucion-" . $iniciales_area . ".pdf";
        $dir_atribucion = basename($_FILES['atribucion']['name']);
        if (!move_uploaded_file($_FILES['atribucion']['tmp_name'], "../atribuciones-pdf/areas/" . $dir_atribucion)) {
            throw new Exception('No se ha podido subir un archivo');
        }

        //guardar todos los campos en la bd.
        $stmn = $objetoPDO->prepare("INSERT INTO areas(nombre,dependencia_perteneciente,ruta_perfil_puesto,ruta_atribucion,ruta_diagrama) VALUES(:nombre,:id_dependencia,:perfil,:atribucion,:diagrama)");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":id_dependencia", $id_dependencia);
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

// Cuando se elimina un registro 
if ($_POST['registro'] == "eliminar") {
    $id = $_POST['id'];

    try {
        $stmn = $objetoPDO->prepare("DELETE FROM areas WHERE id_area = :id");
        $stmn->bindParam(":id", $id);
        if ($stmn->execute()) {
            $respuesta = array(
                "respuesta" => "exito",
                "id_eliminado" => $id,
            );
        } else {
            $respuesta = array(
                "respuesta" => "error",
                "id_eliminado" => $id,
            );
        }
        $conn = null;
    } catch (Exception $e) {
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
    $dependencia_perteneciente = $_POST['dependencia_perteneciente'];
    try {
        //obtener iniciales
        $iniciales_area = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //actualiza el diagrama del area si se subió
        $dir_diagrama = "";
        if ($_FILES["diagrama"]["size"] > 0) {
            $_FILES["diagrama"]["name"] = "diagrama-".$iniciales_area . ".png";
            $dir_diagrama = basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], "../diagramas/areas/" . $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } else {
            $dir_diagrama = $_POST['ruta_actual_diagrama'];
        }


        //actualiza el documento perfil de puesto
        $dir_perfil = "";
        if ($_FILES["perfil-puesto"]["size"] > 0) {
            $_FILES["perfil-puesto"]["name"] = "perfil-".$iniciales_area . ".pdf";
            $dir_perfil = basename($_FILES['perfil-puesto']['name']);
            if (!move_uploaded_file($_FILES['perfil-puesto']['tmp_name'], "../perfiles-pdf/areas/" . $dir_perfil)) {
                throw new Exception('No se ha podido subir el perfil');
            }
        } else {
            $dir_perfil = $_POST['ruta_actual_perfil'];
        }


        //actualiza el documento atribucion
        $dir_atribucion = "";
        if ($_FILES["atribucion"]["size"] > 0) {
            $_FILES["atribucion"]["name"] = "atribucion-".$iniciales_area . ".pdf";
            $dir_atribucion = basename($_FILES['atribucion']['name']);
            if (!move_uploaded_file($_FILES['atribucion']['tmp_name'], "../atribuciones-pdf/areas/" . $dir_atribucion)) {
                throw new Exception('No se ha podido subir la atribucion');
            }
        } else {
            $dir_atribucion =  $_POST['ruta_actual_atribucion'];
        }


        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("UPDATE areas SET nombre=:nombre,dependencia_perteneciente=:id_dependencia,ruta_perfil_puesto=:perfil,ruta_atribucion=:atribucion,ruta_diagrama=:diagrama WHERE id_area=:id");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":id_dependencia", $dependencia_perteneciente);
        $stmn->bindParam(":perfil", $dir_perfil);
        $stmn->bindParam(":atribucion", $dir_atribucion);
        $stmn->bindParam(":diagrama", $dir_diagrama);
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
    $iniciales = "area-";
    foreach ($palabras as $palabra) {
        $iniciales .= substr($palabra, 0, 1);
    }
    return $iniciales;
}
