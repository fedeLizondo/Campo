<?php

    if( session_status() != PHP_SESSION_ACTIVE )
        session_start();    

    class Conexion{
        
        private $dbDir =  "";
        private $dbUsuario = "";
        private $dbContrasenia = "";
        private $dbBaseDeDatos = "";

        function NombreUsuarioExiste($username)
        {
            
            $boolean = false;
            try{
                $conexion = new PDO("mysql:host=$servidor;dbname=$dbBaseDeDatos",$dbUsuario,$dbContrasenia);
                $query = "SELECT * FROM USUARIO WHERE NOMBRE_USUARIO is like %'" + $username + "'%;"; 
                
                
                $stmt =  $conexion->prepare($query);
                $stmt->bindParam(":nombre",$username);
                //password_hash();
                
                if( $stmt->execute() )
                {
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    return count($resultado)>0; 
                } 
                else
                {
                    return false;
                }

            }
            catch(PDOException $e)
            {
               die("La conexión fallo:".$e->getMessage());
            }
        }

        function EmailUsuarioExiste($email)
        {

        }

        function autentificar( $usuario , $password )
        {
            //TODO HACE CONEXION A BD ; CREAR UN OBJETO JSON A PARTIR DE LOS DATOS
           try{
                $conexion = new PDO("mysql:host=$servidor;dbname=$dbBaseDeDatos",$dbUsuario,$dbContrasenia);
                $query = "SELECT * FROM USUARIO WHERE EMAIL = '" + $username + "' AND CONTRASENIA ='"+$password+"';";        
                $stmt =  $conexion->prepare($query);
                $stmt->bindParam(":nombre",$username);
                $stmt->bindParam(":pass",password_hash($password,PASSWORD_BCRYPT) );
                
                if( $stmt->execute() )
                {
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $mensaje = "El Usuario no esta registrado";
                    if( $resultado > 0 )
                    {    
                        $estado =  1;
                        $mensaje = $resultado;   
                        $_SESSION['ID_USUARIO'] = $resultado['ID_USUARIO'];
                        $_SESSION['NOMBRE'] = $resultado['NOMBRE'];
                        $_SESSION['NOMBRE_USUARIO'] = $resultado['NOMBRE_USUARIO'];
                        $_SESSION['CONTRASENIA'] = $resultado['CONTRASENIA'];
                        $_SESSION['EMAIL'] = $resultado['EMAIL'];
                        return true;
                    }
            
                    return false; 
                } 
                else
                {
                    return false;
                }

            }
            catch(PDOException $e)
            {
               die("La conexión fallo:".$e->getMessage());
            }
        }

        function crearCuenta( $usuario,$password,$email,$nombre )
        {  

            try{
                $conexion = new PDO("mysql:host=$servidor;dbname=$dbBaseDeDatos",$dbUsuario,$dbContrasenia);
                $sql = "INSERT INTO USUARIO (NOMBRE,NOMBRE_USUARIO,CONTRASENIA,EMAIL) VALUES(:user, :name, :pass,:email)"; 
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':user',$usuario);
                $stmt->bindParam(':name',$nombre);
                $stmt->bindParam(':pass',password_hash($password),PASSWORD_BCRYPT);
                $stmt->bindParam(':email',$email);

                if($stmt->execute())
                {
                           
                    $_SESSION['ID_USUARIO'] = $stmt->lastInsertId();
                    $_SESSION['NOMBRE'] = $nombre;
                    $_SESSION['NOMBRE_USUARIO'] = $usuario;
                    $_SESSION['CONTRASENIA'] = $password;
                    $_SESSION['EMAIL'] = $email;

                    return true;
                }
                else
                    return false;
                
            }
            catch(PDOException $e)
            {
                die( $e->getMessage());
            }

            //return [0,$usuario,$password,"pepe@pepe.com","pedro martinez"];
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
