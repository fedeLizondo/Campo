<?php

require 'login.php';

class loginTest extends PHPUnit_Framework_TestCase
{
	/*public function setUp()
	{
		$this->autenticar = new login; 
	}

	public function testStoresListOfAssets()
	{
		$this->assertClassHasStaticAttribute('paths','login');
    }
     */
    public function testAdd()
    {
        $a = New Login;

        //EL NOMBRE_USUARIO ES NULL
        $result = $a->autenticar(null,"algo");
        $mensaje = json_decode( $result,true ); 

        $this->assertEquals("El usuario es invalido",$mensaje['MENSAJE']);

        //LA CONTRASEÑA ES NULL
        $result = $a->autenticar("algo",null);
        
        $mensaje = json_decode($result,true); 
        $this->assertEquals("La contraseña es invalida",$mensaje['MENSAJE']);

        //EL USUARIO NO ESTE AUTENTIFICADO
        $result = $a->autenticar("uno","12345");
        $mensaje = json_decode( $result,true ); 
        
        $this->assertEquals("0,uno,12345",implode(",",$mensaje['MENSAJE']));
        //EL USUARIO YA ESTA AUTENTIFICADO
        $result = $a->autenticar("uno","12345");
        $mensaje = json_decode( $result,true ); 
        
        $this->assertEquals("El usuario ya esta Autentificado",$mensaje['MENSAJE']);
             
        //EL USUARIO NO ESTE REGISTRADO
        $result = $a->autenticar("marco","polo");
        $mensaje = json_decode( $result,true ); 
        
        $this->assertEquals("El usuario no esta registrado",$mensaje['MENSAJE']);

        }    
}


?>
