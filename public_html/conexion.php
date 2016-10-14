<?php

    if( session_status() != PHP_SESSION_ACTIVE )
        session_start();    
   
    
    class Conexion{
        
        function abrirConexion()
        {
                $servidor = "mysql.hostinger.es";
                $dbUsuario = "u167218638_admin";
                $dbContrasenia = "lizondo08";
                $dbBaseDeDatos = "u167218638_model";
                return new PDO("mysql:host=$servidor;dbname=$dbBaseDeDatos",$dbUsuario,$dbContrasenia);    
        }
        
        function cerrarConexion( &$pdo, &$stmt ) 
        {
               $stmt->closeCursor();
               $stmt = null;
               $pdo = null;
        }   

        function NombreUsuarioExiste($username)
        {
            
        }

        function EmailUsuarioExiste($email)
        {

        }

        function autentificar( $usuario , $password )
        { 
           $estado = false;
            
           try{
                $conexion = $this->abrirConexion();

                $query = "SELECT * FROM USUARIO WHERE EMAIL = :nombre ";        
                $stmt =  $conexion->prepare($query);
                
                $stmt->bindParam(":nombre",$usuario);
                //$passHASH = password_hash($password,PASSWORD_BCRYPT);
                //$stmt->bindParam(':pass',$passHASH,PDO::PARAM_STR);
                
                if( $stmt->execute() )
                {
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $mensaje = "El usuario no esta registrado";
                    $pass = password_verify($password, $resultado['CONTRASENIA']);
                    if( $resultado > 0 && pass )
                    {    
                        
                        $_SESSION['ID_USUARIO'] = $resultado['ID_USUARIO'];
                        $_SESSION['NOMBRE'] = $resultado['NOMBRE'];
                        $_SESSION['NOMBRE_USUARIO'] = $resultado['NOMBRE_USUARIO'];
                        $_SESSION['CONTRASENIA'] = $resultado['CONTRASENIA'];
                        $_SESSION['EMAIL'] = $resultado['EMAIL'];
                        
                        $estado = true;
                        $mensaje = array($_SESSION['ID_USUARIO'],$_SESSION['NOMBRE'],$_SESSION['NOMBRE_USUARIO'],$_SESSION['EMAIL'],$_SESSION['CONTRASENIA']);
                    } 
                    $this->cerrarConexion($conexion , $stmt);
               } 
               else
               {
                   $mensaje = "No se pudo conectar con la base de datos , intente nuevamente"; 
               }
            }
            catch(PDOException $e)
            {
               $mensaje = $e->getMessage();
            }
            $objectJSON = ['ESTADO' => $estado,'MENSAJE' => $mensaje];
            return json_encode($objectJSON);
            
        }

        function crearCuenta( $usuario,$nombre,$email,$password )
        {  
            try{
                $estado = false;
                $mensaje = "Error Desconocido";

                $conexion = $this->abrirConexion();
                //$this->abrirConexion($conexion);
              
                $sql = "INSERT INTO USUARIO (NOMBRE,NOMBRE_USUARIO,CONTRASENIA,EMAIL) VALUES(:user, :name, :pass,:email)"; 
                $stmt = $conexion->prepare($sql);
               
                $stmt->bindParam(':user',$usuario,PDO::PARAM_STR);
                $stmt->bindParam(':name',$nombre,PDO::PARAM_STR);
                $passHASH = password_hash($password,PASSWORD_BCRYPT);
                $stmt->bindParam(':pass',$passHASH,PDO::PARAM_STR);
                $stmt->bindParam(':email',$email,PDO::PARAM_STR);

                if($stmt->execute())
                {
                           
                    $_SESSION['ID_USUARIO'] = $conexion->lastInsertId();
                    $_SESSION['NOMBRE'] = $nombre;
                    $_SESSION['NOMBRE_USUARIO'] = $usuario;
                    $_SESSION['CONTRASENIA'] = $password;
                    $_SESSION['EMAIL'] = $email;
                      
                    $estado = true;
                    $mensaje = array($_SESSION['ID_USUARIO'],$_SESSION['NOMBRE'],$_SESSION['NOMBRE_USUARIO'],$_SESSION['EMAIL'],$_SESSION['CONTRASENIA']);
                }
                else
                {
                    $mensaje = "No se pudo conectar con la base de datos , intente nuevamente"; 
                }
                $this->cerrarConexion($conexion , $stmt);
                
            }
            catch(PDOException $e)
            {
                $mensaje =$e->getMessage();
            }
            finally
            {
               $objectJSON = ['ESTADO' => $estado,'MENSAJE' => $mensaje];
               return json_encode($objectJSON);
            }
        }

        function crearProyecto($idUsuario,$password,$nombreProyecto,$integrantes)
        {
            return [0];
        }

        function buscarProyectoNombre($nombreProyecto)
        {
           return [];            
        }

        function buscarProyectoID($idProyecto)
        {
            return [];
        }

        function buscarUsuarioNombre($nombre)
        {
            return[];
        }

        function buscarUsuarioID($idUsuario)
        {
            return[];
        }

        function buscarUsuarioEmail($emailUsuario)
        {
            return[];
        }
       
    
    }   
    
?>