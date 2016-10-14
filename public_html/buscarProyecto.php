<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR</title>
</head>
<body>

 <?php
session_start();
header('Content-Type: charset=utf-8'); 
require 'administradora.php';
    if( isset( $_SESSION["BUSCAR_PROYECTO"] ))  
	{
		$administradora = new Administradora;
		$pag = 0;
		if(isset($_SESSION["BUSCAR_PROYECTO_PAGINA"]))
		{
    		$pag = $_SESSION["BUSCAR_PROYECTO_PAGINA"];      
		}

		echo $administradora->buscarProyecto($_SESSION["BUSCAR_PROYECTO"],$pag);
		unset($_SESSION["BUSCAR_PROYECTO"]);
	}
    else
     	echo "Ingrese el proyecto a buscar en la barra de busqueda " ;
?>

<a href="http://modela.esy.es/"></a>
</body>
</html>
