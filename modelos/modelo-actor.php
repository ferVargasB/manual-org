<?php
//include_once 'funciones/funciones.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
//Cuando se crea
if ($_POST['registro'] == 'nuevo' ) 
{
    $ruta_atribucion = "";
    $ruta_def =$_POST["ruta"];
    $nombre = $_POST["nombre"];
    $es_director;
    if (isset($_POST["es_director"])) {
        $es_director = 1;
    } else {
        $es_director = 0;
    }
    try {
        //obtener iniciales
        $iniciales_director = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //carga la tribucion del actor
        $_FILES["atribucion"]["name"] = "director_".clean($nombre).".pdf";
        $ruta_atribucion = "../atribuciones-pdf/funcionarios/".basename($_FILES['atribucion']['name']);
        if (move_uploaded_file($_FILES['atribucion']['tmp_name'], $ruta_atribucion)) {

        } else {
            $ruta_atribucion = "Sin atribución";
        }

        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("INSERT INTO actores(nombre,es_director,ruta_atribucion) VALUES(:nombre,:es_director,:ruta_atribucion)");
        $stmn->bindParam(":nombre",$nombre);
        $stmn->bindParam(":es_director",$es_director);
        $stmn->bindParam(":ruta_atribucion",$ruta_atribucion);
        if($stmn->execute())
        {
            $respuesta = array(
                "respuesta" => "exito",
                "id_admin" => $stmn,
            );
        }
        else
        {
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
if ($_POST['registro'] == "eliminar")
{
    $nombre = $_POST["nombre"];
    $id = $_POST['id'];

    try {
        $stmn = $objetoPDO->prepare("DELETE FROM actores WHERE id_actor = :id");
        $stmn->bindParam(":id",$id);
        if($stmn->execute())
        {
            $respuesta = array(
                "respuesta" => "exito",
                "id_eliminado" => $id,
            );
        }
        else
        {
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
if ($_POST['registro'] == "actualizar")
{
    $id_registro = $_POST['id_registro'];
    $nombre = $_POST["nombre"];
    $ruta_def =$_POST["ruta"];
    try {
        //obtener iniciales
        $iniciales_area = obtener_iniciales($nombre);
        //PARTE PARA SUBIR LOS DOCUMENTOS

        //die(var_dump($_POST));
        //carga el documento atribucion
        $_FILES["atribucion"]["name"] = "director_".clean($nombre).".pdf";
        $dir_atribucion = "../atribuciones-pdf/funcionarios/".basename($_FILES['atribucion']['name']);
        if ($_FILES["atribucion"]["size"] > 0) {
            if ( !move_uploaded_file($_FILES['atribucion']['tmp_name'], $dir_atribucion)) {
                throw new Exception('No se ha podido subir un archivo');
        	} 
        } else {
            $dir_atribucion= $ruta_def;
        }

        //guardar todos los campos en la bd
        $stmn = $objetoPDO->prepare("UPDATE actores SET nombre=:nombre,ruta_atribucion=:atribucion WHERE id_actor=:id");
        $stmn->bindParam(":nombre",$nombre);
        $stmn->bindParam(":atribucion",$dir_atribucion);
        $stmn->bindParam(":id",$id_registro);
        if($stmn->execute())
        {
            $respuesta = array(
                "respuesta" => "exito",
                "id" => $id_registro,
            );
        }
        else
        {
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
    $palabras = explode(" ",$data);
    $iniciales = "director-";
    foreach($palabras as $palabra)
    {
        $iniciales .= substr($palabra,0,1);
    }
    return $iniciales;
}

function clean($string) 
{
    $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }
?>