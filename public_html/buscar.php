<?php

session_start();
header('Content-Type: charset=utf-8'); 
require 'administradora.php';
if(isset( $_POST['BUSCAR_PROYECTO']) )
{
	$_SESSION['BUSCAR_PROYECTO'] = $_POST['BUSCAR_PROYECTO'];	
}
echo respuesta;
?> 