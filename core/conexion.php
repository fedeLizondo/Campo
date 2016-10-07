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
                $query = "SELECT * FROM USUARIO WHERE nombre is like %'" + $username + "'%;"; 
                
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
            $objetoJson = [0,$usuario,$password,"PEPE"];
            return json_encode($objetoJson,true); 
        }

        function crearCuenta( $usuario,$password,$email,$nombre )
        {  

            try{
                $conexion = new PDO("mysql:host=$servidor;dbname=$dbBaseDeDatos",$dbUsuario,$dbContrasenia);
                $query = "SELECT * FROM USUARIO WHERE nombre is like %'" + $username + "'%;"; 
                
            $sql = "INSERT INTO USUARIO (NOMBRE,NOMBRE_USUARIO,CONTRASENIA,EMAIL) VALUES(:user, :name, :pass,:email)"; 
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':user',$usuario);
            $stmt->bindParam(':name',$nombre);
            $stmt->bindParam(':pass',password_hash($password),PASSWORD_BCRYPT);
            $stmt->bindParam(':email',$email);

                if($stmt->execute())
                {    return true;}
                else
                {    return false;}
                
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
