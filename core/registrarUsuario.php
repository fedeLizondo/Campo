<?php
    session_start();
    require('administradora.php');
    if( !isset($_SESSION['ID_USUARIO']) )
    {
        $administradora = new Administradora;
        $rtaJSON = $administradora->registrarUsuario($_POST['USUARIO'],$_POST['NOMBRE'],$_POST['EMAIL'],$_POST['CONTRASENIA']);
        $rta = json_decode($rtaJSON,true);
        if($rta['ESTADO'] == $administradora->ERROR )
            $_SESSION['MENSAJE_ERROR'] = $rta['MENSAJE']; 
    }
    else
    {
        header('Location: /');
        exit();
    }
?>
