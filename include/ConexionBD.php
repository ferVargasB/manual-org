<?php
  try{
    //Opciones de la conexión
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $objetoPDO = new PDO('mysql:host=localhost;dbname=gaaso1_manuales','root','root',$opciones);
    //$objetoPDO = new PDO('mysql:host=localhost;dbname=manual_org','eduardo','jesm1997',$opciones);
    $objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
  }
?>
