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
                /* try
                {
                $servidor = "mysql.hostinger.es";
                $dbUsuario = "u167218638_admin";
                $dbContrasenia = "lizondo08";
                $dbBaseDeDatos = "u167218638_model";

                $conexion = new PDO("mysql:host=$servidor;dbname=$dbBaseDeDatos",$dbUsuario,$dbContrasenia);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `USUARIO`(`NOMBRE`, `NOMBRE_USUARIO`, `CONTRASENIA`, `EMAIL`) VALUES(:user, :name, :pass,:email)";
                $stmt = $conexion->prepare($sql);
                 
                $stmt->bindParam(':user',$user,PDO::PARAM_STR);
                $stmt->bindParam(':name',$nombre,PDO::PARAM_STR);
                $passHASH = password_hash($password,PASSWORD_BCRYPT);
                $stmt->bindParam(':pass',$passHASH,PDO::PARAM_STR);
                $stmt->bindParam(':email',$email,PDO::PARAM_STR);
                 
                 if( $stmt->execute())
                 {  
                           
                    $_SESSION['ID_USUARIO'] = $conexion->lastInsertId();
                    $_SESSION['NOMBRE'] = $user;
                    $_SESSION['NOMBRE_USUARIO'] = $name;
                    $_SESSION['CONTRASENIA'] = $pass;
                    $_SESSION['EMAIL'] = $email;

                      
                    $estado = true;
                    $mensaje = array($_SESSION['ID_USUARIO'],$_SESSION['NOMBRE'],$_SESSION['NOMBRE_USUARIO'],$_SESSION['EMAIL'],$_SESSION['CONTRASENIA']);
                 }
                 else
                 {
                    $mensaje += "ERROR al momento de ejecutar la consulta sql";
                 }
                    
                }
                catch(PDOException $e)
                {
                  $mensaje = $e->getMessage();
                }*/

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


  }//FIN CLASE LOGIN
 ?>
		