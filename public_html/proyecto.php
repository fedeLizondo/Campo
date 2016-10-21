<?php
//header('Content-type: text/html; charset=utf-8');
//mb_internal_encoding('UTF-8');
header('Content-Type: charset=utf-8'); 
require 'Clases/administradora.php';
session_start();

if( isset($_SESSION['BUSCAR_PROYECTO']) )
{
	header("Location: /buscarProyecto.php");
}

if(  !isset($_GET['id']) )
  	header("Location: /");
?>



<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modela</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--script src="https://use.fontawesome.com/e7b734d3ed.js"></script-->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/base.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
</head>
<body>

<?php
	$administradora = new administradora;
	echo "El json \n".$administradora->buscarProyectoID($_GET['id']);
	
?>

</body>
</html>