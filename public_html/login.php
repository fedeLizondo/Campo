<?php
    session_start();
    require('administradora.php');

    if( isset($_POST['EMAIL']) && isset($_POST['CONTRASENIA']) )
    {
          $administradora = new Administradora;
          
          $email = $_POST['EMAIL'];
          $contrasenia = $_POST['CONTRASENIA'];
          echo $administradora->autenticar($email,$contrasenia);
                  
    }
    else
    { 
          $estado = false;
          
          $mensaje = "No ingreso Usuario ";

          $objectJSON = ['ESTADO' => $estado,'MENSAJE' => $mensaje];
          echo json_encode($objectJSON);
    }
    

?>
