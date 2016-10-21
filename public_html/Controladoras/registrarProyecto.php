<?php
require('../Clases/administradora.php');
session_start();

header('Content-Type: charset=utf-8'); 

if(isset( $_POST['NOMBRE_PROYECTO']) )
{
	$administradora = new Administradora;
	echo $administradora->crearProyecto($_POST['NOMBRE_PROYECTO'],$_SESSION[ID_USUARIO],null);
}


?> 
