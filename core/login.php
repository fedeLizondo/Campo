<?php
    session_start();
    require('administradora.php');

    if( isset($_POST['EMAIL']) && isset($_POST['CONTRASENIA']) )
    {
          $administradora = new Administradora;
          
          $email = $_POST['EMAIL'];
          $contrasenia = $_POST['CONTRASENIA'];
          $respuesta = $administradora->autenticar($email,$contrasenia); 
          //CONVIERTO EL JSON A UN ARRAY DE PHP
          $rtaJSON = json_decode($respuesta,true);
          
          $estado = $rtaJSON['ESTADO']; 
          $_SESSION['ESTADO'] = $estado;
          $mensaje= $rtaJSON['MENSAJE'];
          
          if($estado == administradora::ERROR)
              $_SESSION['ERROR_MENSAJE']=$mensaje;  
    }
    

?>
