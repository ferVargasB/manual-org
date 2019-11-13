<?php
include_once 'funciones/funciones.php';
//include_once 'C:\wamp64\www\manuales_digitales\admin-area\funciones\funciones.php';
//include_once "C:\MAMP\htdocs\manuales_digitales_ga\manuales_digitales\admin-area\include\ConexionBD.php";
if (isset($_POST['login-admin']))
{
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        $stmn = $objetoPDO->prepare("SELECT * FROM usuarios WHERE nombre = :usuario;");
        $stmn->bindParam(":usuario", $usuario);
        $stmn->execute();
        $id_usuario_usuario = 0;
        $password_usuario = 0;
        $rol_usuaio = 0;
        $puesto_usuario = 0;
        //$stmn->bind_result($id_admin, $usuario_admin, $correo_admin, $password_admin, $puesto_admin, $rol_admin);
        $existe = $stmn->fetch(PDO::FETCH_ASSOC);
        if ($existe)
        {
            $password_usuario = $existe["password"];
            $rol_usuaio = $existe["rol"];
            $puesto_usuario = $existe["puesto"];
            if( $password == $password_usuario)
            {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = $rol_usuaio;
                $_SESSION["puesto"] = $puesto_usuario;
                $respuesta = array(
                    "respuesta" => "exito",
                    "usuario" => $usuario
                );
            }
            else
            {
                $respuesta = array(
                    "respuesta" => "no_existe"
                );
            }
        }
        else
        {
            $respuesta = array(
                "respuesta" => "no_existe"
            );
        }
    } catch (Throwable $e) {
        echo $e->getMessage();
    }

    die(json_encode($respuesta));
}
?>