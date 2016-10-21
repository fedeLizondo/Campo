<?php
    require('../Clases/administradora.php');
    session_start();

    if( !isset($_SESSION['ID_USUARIO']) )
    {
            $estado = falso;
            $mensaje = "";
            
            $user = $_POST["USUARIO"];
            $name = $_POST["NOMBRE"];
            $email = $_POST["EMAIL"];
            $pass = $_POST["CONTRASENIA"];
            
            $administradora = new Administradora;    
            echo $administradora->registrarUsuario($user,$name,$email,$pass);            
    }
    else
    {
        $array = array('ESTADO'=>false,'MENSAJE'=>"El usuario ya esta logueado"); 
        echo json_encode($array); 

	/*session_unset();
	session_destroy();*/
    }
   
?>															
