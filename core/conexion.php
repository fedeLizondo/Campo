<?php

    //include "dbSettings.php";

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
            $db = new mysql();
            $query = "SELECT * FROM USUARIO WHERE nombre is like '" + $username + "'"; 
            $consulta = mysql_query($query) or die( false ) ;
            $boolean = mysql_fetch_array($consulta);

            mysql_close($db);
            return true; 
        }

        function EmailUsuarioExiste($email)
        {

            $db = new mysql();
            $query = "SELECT * FROM USUARIO WHERE email is like '"+ $email +"'"; 
            mysql_query($query) or die(mysql_error());
            mysql_close($db);
        }

        function autentificar( $usuario , $password )
        {
            //TODO HACE CONEXION A BD ; CREAR UN OBJETO JSON A PARTIR DE LOS DATOS
            $objetoJson = [0,$usuario,$password,"PEPE"];
            return json_encode($objetoJson,true); 
        }

        function crearCuenta( $usuario,$password,$email,$nombre )
        {  
            //TODO AGREGAR ESTADO 
            return [0,$usuario,$password,"pepe@pepe.com","pedro martinez"];
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
