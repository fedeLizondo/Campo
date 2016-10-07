<?php
require('conexion.php');

session_start(); 
   if( session_status() != PHP_SESSION_ACTIVE )
        session_start();


  class Administradora {

    const ERROR = 0;  
    const OK = 1;

    public function autenticar($nombre,$contrasenia)
    {
        $mensaje = "";
        $estado  = 0;
        
        if( !is_null($nombre)&& !is_null($contrasenia) &&  !isset($_SESSION["ID_USUARIO"]))
        {
            $con = new Conexion;
            if( $con->autentificar($nombre,$contrasenia) )
            {
                $mensaje = "El usuario fue autentificado correctamente";
                $estado = 1;
            }
            else
                $mensaje = "El usuario no esta registrado";
               
        }
        else
        {    
            $mensaje = "El usuario ya esta Autentificado";
            
            if(is_null($nombre))
                $mensaje = "El usuario es invalido";
            
            if(is_null($contrasenia)) 
                $mensaje = "La contraseña es invalida";
        }

        //PREPARO LA RESPUESTA PARA CONVERTIRLA EN JSON
        $objectJSON = [ 'ESTADO' => $estado , 'MENSAJE' => $mensaje ];
        //DEVUELVO EL MENSAJE COMO JSON
        return json_encode($objectJSON);
    }

    public function registrar($user,$nombre,$email,$password)
    {
        $estado = ERROR;
        $mensaje = "";

        if(!is_null($user) && !is_null($nombre) && !is_null($email) && !is_null($password) )
        {
               
                password_hash($password);
        }  
        else
        {
            $mensaje = "El campo ";
            if(is_null($user))
                    $mensaje += " USUARIO ";

            if(is_null($nombre))
                    $mensaje += " NOMBRE ";
            if(is_null($email))
                $mensaje += " EMAIL ";
            if(is_null($password))
                $mensaje += "PASSWORD";
            
            $mensaje += " se encuentra invalido o vacio intente nuevamente";       
             
        }     
            $objectJSON = ['ESTADO' => $estado,'MENSAJE' => $mensaje];
            return json_encode($objectJSON);
    }


  }//FIN CLASE LOGIN
 ?>
