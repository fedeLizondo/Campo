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
            $mensaje = "Error Desconocido";
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
                    if( $resultado > 0 && $pass )
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

        function crearProyecto($idUsuario,$nombreProyecto,$array_integrantes)
        {
            try{
                $estado = false;
                $mensaje = "Error Desconocido";

                $conexion = $this->abrirConexion();
                
                $sql = "INSERT INTO PROYECTO (ID_USUARIO,NOMBRE) VALUES(:iduser,:name)"; 
                $stmt = $conexion->prepare($sql);
               
 //              $stmt->bindParam(':iduser',$idUsuario);
//               $stmt->bindParam(':name',$nombreProyecto,PDO::PARAM_STR);
                $stmt->bindParam(':iduser',$nombreProyecto,PDO::PARAM_STR);
                $stmt->bindParam(':name',$idUsuario);


                if($stmt->execute())
                {
                           
                    $_SESSION['ID_PROYECTO'] = $conexion->lastInsertId();
                    

                    $sql = "INSERT INTO USUARIOS_PROYECTO (ID_PROYECTO,ID_USUARIO,ID_PERMISO) VALUES(:idproyecto,:iduser,0)"; 
                    $stmt = $conexion->prepare($sql);
                    $stmt->bindParam(':iduser',$idUsuario);
                    $stmt->bindParam(':idproyecto',$_SESSION['ID_PROYECTO']);
                    if($stmt->execute())
                    {
                        if(!is_null($array_integrantes) && !empty($array_integrantes)){
                        foreach ($array_integrantes as $elemento) {
                            $sql = "INSERT INTO USUARIOS_PROYECTO (ID_PROYECTO,ID_USUARIO,ID_PERMISO) VALUES(:idproyecto,:iduser,0)"; 
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':iduser',$elemento);
                            $stmt->bindParam(':idproyecto',$_SESSION['ID_PROYECTO']);
                        }
                    }
                            
                        $estado = true;
                        $mensaje = array("Se creo el proyecto y se agregaron correctamente los usuarios",$_SESSION['ID_PROYECTO'],$idUsuario);
                    }
                    else
                        $mensaje = "Se creo el proyecto pero no puedo agregar los usuarios al proyecto , intente nuevamente";
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

        function buscarProyectoNombre($nombreProyecto,$pagina)
        {
                $estado = false;
            
           try{
                $conexion = $this->abrirConexion();
                
                $pagInicio = 0;
                $cantidadResutaldos = 30;
                $paginaFin = 1;

                if(!is_null($paginaFin) && is_int($pagina) && pagina >=0)
                {
                    $paginaInicio = ($pagina * $cantidadResutaldos);
                }    
                
                $paginaFin = $paginaInicio+$cantidadResutaldos;

                $query = "SELECT * FROM PROYECTO WHERE NOMBRE like :nombre ";//:limit :inicio , :fin";        
                $stmt =  $conexion->prepare($query);
                
                $var ="%".$nombreProyecto."%";
                $stmt->bindParam(":nombre",$var);
                /*$stmt->bindParam(":inicio",$pagInicio);
                $stmt->bindParam(":fin",$paginaFin);*/
                //$passHASH = password_hash($password,PASSWORD_BCRYPT);
                //$stmt->bindParam(':pass',$passHASH,PDO::PARAM_STR);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if( $stmt->execute() )
                {
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $mensaje = "No se encontraron resultados";
                    $estado = true;
                    if( $resultado > 0  )
                    {    
                        $mensaje = array();
                        $arrayAux = array($resultado['ID_PROYECTO'],$resultado['ID_USUARIO'],$resultado['NOMBRE'],$resultado['FECHA_CREACION']);
                        array_push($mensaje, $arrayAux);

                        while ( $resultado = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                            $arrayAux = array($resultado['ID_PROYECTO'],$resultado['ID_USUARIO'],$resultado['NOMBRE'],$resultado['FECHA_CREACION']);
                            array_push($mensaje, $arrayAux);
                         } 
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

        function buscarProyectoID($idProyecto)
        {
            $estado = false;
            
           try{
                $conexion = $this->abrirConexion();
                
                $pagInicio = 0;
                $cantidadResutaldos = 30;
                $paginaFin = 1;

                if(!is_null($paginaFin) && is_int($pagina) && pagina >=0)
                {
                    $paginaInicio = ($pagina * $cantidadResutaldos);
                }    
                
                $paginaFin = $paginaInicio+$cantidadResutaldos;

                $query = "SELECT * FROM PROYECTO WHERE NOMBRE like :nombre ";//:limit :inicio , :fin";        
                $stmt =  $conexion->prepare($query);
                
                $var ="%".$nombreProyecto."%";
                $stmt->bindParam(":nombre",$var);
                /*$stmt->bindParam(":inicio",$pagInicio);
                $stmt->bindParam(":fin",$paginaFin);*/
                //$passHASH = password_hash($password,PASSWORD_BCRYPT);
                //$stmt->bindParam(':pass',$passHASH,PDO::PARAM_STR);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if( $stmt->execute() )
                {
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $mensaje = "No se encontraron resultados";
                    $estado = true;
                    if( $resultado > 0  )
                    {    
                        $mensaje = array();
                        $arrayAux = array($resultado['ID_PROYECTO'],$resultado['ID_USUARIO'],$resultado['NOMBRE'],$resultado['FECHA_CREACION']);
                        array_push($mensaje, $arrayAux);
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