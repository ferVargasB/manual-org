<?php
//include_once 'funciones/funciones.php';
//include_once 'C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\funciones\funciones.php';
//require_once "C:\wamp64\www\manuales_digitales\admin-area\\funciones\\funciones.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/manual-org/funciones/funciones.php';

if ($_POST['registro'] == 'nuevo' && isset($_POST['area_perteneciente'])) {
    $nombre = $_POST['nombre'];
    $ruta_diagrama = "";
    $ruta_ficha = "";
    $numero_actores = $_POST["numero_actores"];
    $area = $_POST["area_perteneciente"];
    try {
        //obtener iniciales
        $iniciales_proceso = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS
        //carga el diagrama del proceso 
        $_FILES["diagrama"]["name"] = $iniciales_proceso . ".png";
        $ruta_diagrama = "../procesos-pdf/" . basename($_FILES['diagrama']['name']);
        if (move_uploaded_file($_FILES['diagrama']['tmp_name'], $ruta_diagrama)) { } else {
            throw new Exception('No se ha podido subir archivo diagrama');
        }

        //carga la ficha tecnica
        $ruta_ficha = "";
        if ($_FILES["ficha"]["size"] > 0) {
            $_FILES["ficha"]["name"] = $iniciales_proceso . ".pdf";
            $ruta_ficha = "../fichas-pdf/procesos/" . basename($_FILES['ficha']['name']);
            if (!move_uploaded_file($_FILES['ficha']['tmp_name'], $ruta_ficha)) {
                throw new Exception('No se ha podido subir archivo ficha');
            }
        }

        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("INSERT INTO procesos(nombre,ruta_diagrama,ruta_ficha,numero_actores,area_perteneciente) VALUES(:nombre,:diagrama,:ficha,:numero_actores,:area)");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":diagrama", $ruta_diagrama);
        $stmn->bindParam(":ficha", $ruta_ficha);
        $stmn->bindParam(":numero_actores", $numero_actores);
        $stmn->bindParam(":area", $area);
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
                "area" => $area
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
    echo json_encode($respuesta);
}

if ($_POST['registro'] == 'nuevo' && isset($_POST['dependencia_perteneciente'])) {
    $nombre = $_POST['nombre'];
    $ruta_diagrama = "";
    $ruta_ficha = "";
    $numero_actores = $_POST["numero_actores"];
    $dependencia = $_POST["dependencia_perteneciente"];
    try {
        //obtener iniciales
        $iniciales_proceso = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS
        //carga el diagrama del proceso 
        $_FILES["diagrama"]["name"] = $iniciales_proceso . ".png";
        $ruta_diagrama = "../procesos-pdf/" . basename($_FILES['diagrama']['name']);
        if (move_uploaded_file($_FILES['diagrama']['tmp_name'], $ruta_diagrama)) { } else {
            throw new Exception('No se ha podido subir archivo diagrama');
        }

        //carga la ficha tecnica
        $ruta_ficha = "";
        if ($_FILES["ficha"]["size"] > 0) {
            $_FILES["ficha"]["name"] = $iniciales_proceso . ".pdf";
            $ruta_ficha = "../fichas-pdf/procesos/" . basename($_FILES['ficha']['name']);
            if (!move_uploaded_file($_FILES['ficha']['tmp_name'], $ruta_ficha)) {
                throw new Exception('No se ha podido subir archivo ficha');
            }
        }

        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("INSERT INTO procesos_dependencias(nombre,ruta_diagrama,ruta_ficha,numero_actores,dependencia_perteneciente) VALUES(:nombre,:diagrama,:ficha,:numero_actores,:dependencia)");
        $stmn->bindParam(":nombre", $nombre);
        $stmn->bindParam(":diagrama", $ruta_diagrama);
        $stmn->bindParam(":ficha", $ruta_ficha);
        $stmn->bindParam(":numero_actores", $numero_actores);
        $stmn->bindParam(":dependencia", $dependencia);
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
                "dependencia" => $dependencia
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


if ($_POST['registro'] == 'nuevo' && isset($_POST['subarea_perteneciente'])) {
    $nombre = $_POST['nombre'];
    $ruta_diagrama = "";
    $ruta_ficha = "";
    $numero_actores = $_POST["numero_actores"];
    $subarea_perteneciente = $_POST["subarea_perteneciente"];
    try {
        //obtener iniciales
        $iniciales_proceso = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS
        //carga el diagrama del proceso 
        $_FILES["diagrama"]["name"] = $iniciales_proceso . ".png";
        $ruta_diagrama = "../procesos-pdf/sub_areas/" . basename($_FILES['diagrama']['name']);
        if (move_uploaded_file($_FILES['diagrama']['tmp_name'], $ruta_diagrama)) { } else {
            throw new Exception('No se ha podido subir archivo diagrama');
        }

        //carga la ficha tecnica
        $ruta_ficha = "";
        if ($_FILES["ficha"]["size"] > 0) {
            $_FILES["ficha"]["name"] = $iniciales_proceso . ".pdf";
            $ruta_ficha = "../fichas-pdf/procesos/subareas/" . basename($_FILES['ficha']['name']);
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
    $id = $_POST['id'];

    try {
        $stmn = $objetoPDO->prepare("DELETE FROM procesos WHERE id_proceso = :id");
        $stmn->bindParam(":id", $id);
        if ($stmn->execute()) {
            $stmn = $objetoPDO->prepare("DELETE FROM procesos_actores WHERE id_proceso = :id;");
            $stmn->bindParam(":id", $id);
            if ($stmn->execute()) {
                $respuesta = array(
                    "respuesta" => "exito",
                    "id_dependencia" => $id,
                );
            } else {
                throw new Exception("Error al eliminar los actores");
            }
        } else {
            $respuesta = array(
                "respuesta" => "error",
                "id_dependencia" => $id,
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

if ($_POST['registro'] == "actualizar") {

    /*REALIZAR LA OPERACIÓN DE ACTUALIZAR*/
    try {
        $respuesta = "";
        //obtener iniciales
        $iniciales_proceso = obtener_iniciales($_POST['nombre']);
        if ( intval($_POST['no_actores_actual']) != intval($_POST['numero_actores']) ){
            $respuesta = borrar_actores_procesos($objetoPDO, $_POST['id_proceso']);
        }

        $dir_diagrama = "";
        if ( $_FILES["diagrama"]["name"] ) {
            $_FILES["diagrama"]["name"] = $iniciales_proceso . ".png";
            $dir_diagrama = "../procesos-pdf/" .basename($_FILES['diagrama']['name']);
            if (!move_uploaded_file($_FILES['diagrama']['tmp_name'], $dir_diagrama)) {
                throw new Exception('No se ha podido subir el diagrama');
            }
        } else {
            $dir_diagrama = $_POST['ruta_diagrama_actual'];
        }
        
        //carga la ficha tecnica
        $ruta_ficha = "";
        if ($_FILES["ficha"]["size"] > 0) {
            $_FILES["ficha"]["name"] = $iniciales_proceso . ".pdf";
            $ruta_ficha = "../fichas-pdf/procesos/" . basename($_FILES['ficha']['name']);
            if (!move_uploaded_file($_FILES['ficha']['tmp_name'], $ruta_ficha)) {
                throw new Exception('No se ha podido subir archivo ficha');
            }
        } else {
            $ruta_ficha = $_POST['ruta_ficha_actual'];
        }
        
        $stmn = $objetoPDO->prepare("UPDATE procesos SET nombre=:nombre,ruta_diagrama=:diagrama,ruta_ficha=:ficha,numero_actores=:numero_actores,area_perteneciente=:area WHERE id_proceso=:proceso");
        $stmn->bindParam(":nombre", $_POST['nombre']);
        $stmn->bindParam(":diagrama", $dir_diagrama);
        $stmn->bindParam(":ficha", $ruta_ficha);
        $stmn->bindParam(":numero_actores", $_POST['numero_actores']);
        $stmn->bindParam(":area", $_POST['area_perteneciente']);
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

function obtener_iniciales($data)
{
    $palabras = explode(" ", $data);
    $iniciales = "diagrama-proceso-";
    foreach ($palabras as $palabra) {
        $iniciales .= substr($palabra, 0, 1);
    }
    return $iniciales;
}

function borrar_actores_procesos($objetoPDO, $id_proceso)
{
    $respuesta = array();
    try {
        $stmn = $objetoPDO->prepare("DELETE FROM procesos_actores WHERE id_proceso = :id_proceso");
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

function actualizar_datos($objetoPDO, $datos)
{
    try {
        $stmn = $objetoPDO->prepare("UPDATE procesos SET nombre = :nombre,numero_actores = :numero_actores,area_perteneciente = :area WHERE id_proceso = :id_proceso");
        $stmn->bindParam(":nombre", $datos['nombre']);
        $stmn->bindParam(":numero_actores", $datos['numero_actores']);
        $stmn->bindParam(":area", $datos['area']);
        $stmn->bindParam(":id_proceso", $datos['id_proceso']);
        if ($stmn->execute()) {
            $datos = array(
                "respuesta" => "exito",
                "nombre" => $datos['nombre'],
                "id_proceso" => $datos['id_proceso'],
                "numero_actores" => $datos['numero_actores'],
                "area" => $datos['area']
            );
        } else {
            throw new Exception('Ocurrió un problema al actualizar el registro');
        }
    } catch (Exception $e) {
        $datos['respuesta'] = 'error';
        $datos['mensaje'] = $e->getMessage();
    }
    return $datos;
}

function actualizar_diagrama($objetoPDO, $ruta_diagrama, $id_proceso)
{
    $respuesta = array();
    $stmn = $objetoPDO->prepare("UPDATE procesos SET ruta_diagrama = :diagrama WHERE id_proceso = :id_proceso");
    $stmn->bindParam(":diagrama", $ruta_diagrama);
    $stmn->bindParam(":id_proceso", $id_proceso);
    if ($stmn->execute()) {
        $respuesta['respuesta'] = 'exito';
    } else {
        $respuesta['respuesta'] = 'error';
        $respuesta['mensaje'] = 'Ocurrió un error al actualizar el diagrama';
    }

    return $respuesta;
}

function actualizar_ficha($objetoPDO, $ruta_ficha, $id_proceso)
{
    $respuesta = array();
    $stmn = $objetoPDO->prepare("UPDATE procesos SET ruta_ficha = :ficha WHERE id_proceso = :id_proceso");
    $stmn->bindParam(":ficha", $ruta_ficha);
    $stmn->bindParam(":id_proceso", $id_proceso);
    if ($stmn->execute()) {
        $respuesta['respuesta'] = "exito";
    } else {
        $respuesta['respuesta'] = "error";
        $respuesta['mensaje'] = 'Ocurrió un error al actualizar la ficha';
    }

    return $respuesta;
}

function verificar_actores_proceso($objetoPDO, $datos)
{
    if ($datos['no_actores_actual'] != $datos['numero_actores']) {
        $stmn = $objetoPDO->prepare("SELECT id_proceso,id_actor FROM procesos_actores WHERE procesos_actores.id_proceso = :id;");
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
