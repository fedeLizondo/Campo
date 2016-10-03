<?php
session_start(); 

   // $SESSION['ID_USER'] = '1';
   // $SESSION['NOMBRE'] = 'contrasenia';
   // $SESSION['PASSWORD'] = 'password';
  
    if(isset($usuario)&& isset($password) )
  {
    echo 'Consulta SQL';
  }

  class Login {
    public function foo($value1,$value2 )
    {
        return $value1+$value2;
    }

    public function autenticar($nombre,$contrasenia)
    {
        if( is_null($nombre) )
        {
            return "El usuario es invalido";
        }
        if( is_null($contrasenia) )
        {
            return "La contraseña es invalida";
        }
        
                
        if( !isset($_SESSION["ID_USUARIO"]))
        {
            //BUSCO USUARIO Y SESSION EN BD 
            $_SESSION["ID_USUARIO"] = 0;
            $_SESSION["USUARIO"] = $nombre;
            $_SESSION["CONTRASENIA"] = $contrasenia;
            return $_SESSION["ID_USUARIO"] .",". $_SESSION["USUARIO"] .",". $_SESSION["CONTRASENIA"];
        }
        else
        {
            return "El usuario esta Autentificado";
        }
    }

  }
 ?>
