<?php  
$nombre=$_FILES["atribucion"]["name"];
$ruta=$_FILES["atribucion"]["tmp_name"];
$dest="img/";
$destino=$dest.basename($_FILES["atribucion"]["name"]);
	if ($nombre !="") {
		if (copy($ruta, $destino)) {
			echo "Archivo subido exitosamente";
		}else {
			echo "Error al subir archivo";
		}
	}


    



include_once 'include/ConexionBD.php';
$nombre=$_POST["nombre"];
$ruta=$_POST["atribucion"];
$director=$_POST["es_director"];


$insertar = "INSERT INTO actores(nombre,ruta_atribucion,es_director) VALUES ('$nombre','wwwndnkndkn','$director')";

$resultado =mysqli_query($opciones,$insertar);


if (!$resultado) {
	echo "Error de registro";
}else {
	echo "Registro correcto";
}
mysqli_close($opciones);*/
?>