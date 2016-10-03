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
        $result = $a->foo(5,6);
        $this->assertEquals(11,$result);

        //EL NOMBRE_USUARIO ES NULL
        $result = $a->autenticar(null,"algo");
        $this->assertEquals("El usuario es invalido",$result);
        
        //LA CONTRASEÑA ES NULL
        $result = $a->autenticar("algo",null);
        $this->assertEquals("La contraseña es invalida",$result);

        //EL USUARIO NO ESTE AUTENTIFICADO
        $result = $a->autenticar("uno","12345");
        $this->assertEquals("El usuario fue autentificado exitosamente",$result);
        //EL USUARIO YA ESTA AUTENTIFICADO
        $result = $a->autenticar("uno","12345");
        $this->assertEquals("El usuario ya esta autentificado",$result);
             
        //EL USUARIO NO ESTE REGISTRADO
        $result = $a->autenticar("marco","polo");
        $this->assertEquals("El usuario no esta registrado",$result);
            
        }    
}


?>
