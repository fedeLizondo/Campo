<?php

session_start(); 
   if( session_status() != PHP_SESSION_ACTIVE )
        session_start();


  class Login {

    const ERROR = 0;  
    const OK = 1;
    const perro = 2;

    public function autenticar($nombre,$contrasenia)
    {
        $mensaje = "";
        $estado  = 0;
        
        if( !is_null($nombre)&& !is_null($contrasenia) &&  !isset($_SESSION["ID_USUARIO"]))
        {
            //TODO BUSCAR USUARIO Y SESSION EN BD
            if($nombre != "marco")
            {
                $_SESSION["ID_USUARIO"] = 0;
                $_SESSION["USUARIO"] = $nombre;
                $_SESSION["CONTRASENIA"] = $contrasenia;           
                $mensaje = [ $_SESSION["ID_USUARIO"], $_SESSION["USUARIO"], $_SESSION["CONTRASENIA"] ];
            }
            else
            {
                $mensaje = "El usuario no esta registrado";
            }   
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

  }//FIN CLASE LOGIN
 ?>
