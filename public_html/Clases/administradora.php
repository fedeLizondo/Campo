<?php
require('conexion.php');


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
            return $con->autentificar($nombre,$contrasenia); 
        }
        else
        {    
            $mensaje = "El usuario ya esta Autentificado";
            
            if(is_null($nombre))
                $mensaje = "El usuario es invalido";
            
            if(is_null($contrasenia)) 
                $mensaje = "La contrasena es invalida";
        }
       
        //PREPARO LA RESPUESTA PARA CONVERTIRLA EN JSON
        $objectJSON = [ 'ESTADO' => $estado , 'MENSAJE' => $mensaje ];
        return json_encode($objectJSON);
    }

    public function registrarUsuario($user,$nombre,$email,$password)
    {
        $estado = ERROR;
        $mensaje = "";

        if(!is_null($user) && !is_null($nombre) && !is_null($email) && !is_null($password) )
        {
               $conexion = new Conexion;
               $rta = $conexion->crearCuenta( $user,$nombre,$email,$password );
               return $rta;

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

    public function buscarProyecto($nombre , $pagina )
    {
        $estado = false;
        $mensaje = "";
        if(!is_null($nombre) && !is_null($pagina) )
        {
              $conexion = new Conexion;
              $rta = $conexion-> buscarProyectoNombre($nombre,$pagina);
              return $rta;
        }
        else
        {
            $mensaje = "El nombre del proyecto no puede estar vacio";
        }
        $objectJSON = ['ESTADO' => $estado,'MENSAJE' => $mensaje];
        return json_encode($objectJSON);
    }

    public function buscarProyectoID($idProyecto)
    {
        $estado = false;
        $mensaje = "Error";

        if(!is_null($idProyecto) && is_integer($idProyecto))
        {


        }
        else{
            $mensaje = "El ID no puede estar vacio";
            if(!is_integer($idProyecto))
            {
              $mensaje = "El ID del proyecto debe ser un valor numerico";
            }
        }
    }



    public function crearProyecto($nombre,$duenoProyecto,$array_usuarios)
    {   
        $estado = false;
        $mensaje = "";
        
        if(!is_null($nombre) && !is_null($duenoProyecto))
        {
            $conexion = new Conexion;
            $rta = $conexion->crearProyecto($nombre,$duenoProyecto,$array_usuarios);
            return $rta;
        }
        else
        {
            $mensaje = "Falta el nombre del proyecto o la identificacion del usuario creador del proyecto";
        }
        $objectJSON = ['ESTADO' => $estado,'MENSAJE' => $mensaje];
        return json_encode($objectJSON);
    }




  }//FIN CLASE LOGIN
 ?>
		