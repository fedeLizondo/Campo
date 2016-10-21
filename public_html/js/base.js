$(document).ready(function(){	

	    var h = $('nav').height() + 30;
   		$('body').animate({ paddingTop: h });
	
		$('form').submit( function(e){
			e.preventDefault(); //EVITA CADA VEZ QUE HAGO UN SUBMIT EN UN FORMULARIO ACTUALICE LA PAGINA
		}) ,
		$('#buscarProyecto').keypress(function(e){   
        	if(e.which == 13) //PRESIONA LA TECLA ENTER 
                Buscar();      
        });	
	})
         
	
		
	function Login() {
		
		var email = document.getElementById('InputEmailLogin').value;
		var pass = document.getElementById('InputPasswordLogin').value;
				  
		$.ajax({
			type:'POST',
			url:'Controladoras/login.php',
			data:{EMAIL:email,CONTRASENIA:pass},
			beforeSend:function() {
                                $('.fa').css('display','inline');
            }
		})
		.done(function(respuesta) {
        	console.log("ESTA ES LA RESPUESTA: "+respuesta+" \n");
            JSONData = jQuery.parseJSON(respuesta);
            console.log(JSONData);
            
            if( JSONData.ESTADO ) // SI EL RESULTADO DE LA CONSULTA ES SATISFACTORIO
            {
            	location.reload();
            } 
		} )
		.fail( function() {
			$('#mensajeError').show();	
			$('#mensajeError').html("HAY UN ERROR MUY GRAVE CON AJAX");
		})
		.always( function(){
                console.log("-------------DESPUES--------------");
				$('.fa').hide();
		})
	}
	
	function isValid(str) {
		//Permite verificar si un string es NULL o vacio 
    	return !(!str || 0 === str.length || /^\s*$/.test(str));
	}
	
    function Buscar() {
    	var busqueda = $('#buscarProyecto').val();

	 	console.log("ERROR");
	 	if(isValid(busqueda))
	 	{
            $.ajax({
		    type:'POST',
			url:'Controladoras/buscar.php',
			data:{ BUSCAR_PROYECTO:busqueda },
			beforeSend:function() {
                                //$('.fa').css('display','inline');
                console.log("ENTRE EN EL BUSCAR");
			}
		})
		.done(function(respuesta) {
			console.log("respuesta");
			console.log("DATOS");
			location.reload();
        })
		.fail( function() {
			$('#mensajeError').show();	
			$('#mensajeError').html("HAY UN ERROR con el servidor no se pudo buscar");
		})
		.always( function(){
                $('.fa').hide();
		})		
	 	}
	 }

	function Registrarse(){
		
        var user  = $('#inputUser').val();
		var email = $('#inputEmailRegistrar').val();
		var name  = $('#inputName').val();
		var pass  = $('#inputPasswordRegistrar').val(); 
        var pass2 = $('#inputConfirmPassword').val();
		
        
		if( isValid(user) )
		{
			if(isValid(name))
			{
				if(isValid(email))
				{
					if( isValid(pass) && pass == pass2 )
					{
						$.ajax({
							
							url:'/Controladoras/registrarUsuario.php',
							type:'POST',
                            data: {USUARIO:user,NOMBRE:name,EMAIL:email,CONTRASENIA:pass},
                            beforeSend:function() {
								console.log("ESTOY POR MANDAR EL REQUEST");
							},
							success:function(respuesta) {
                            	console.log("-----------------------------------------");
                                console.log(respuesta);
                                console.log("-----------------------------------------");
                                JSONData = jQuery.parseJSON(respuesta);
                                console.log(JSONData);

                                if( JSONData.ESTADO )
                                {
                                	location.reload();
                                }
                                                        
                            },
							error:function(jqXHR,estado,error){
								console.log(estado);
								console.log(error);
							},
							complete:function(jqXHR,estado) {
								console.log("EL COMPLETE:"+estado);
							},
							timeout:5000
						})
					}
					else
					{
						$('#mensajeErrorRegistrar').show();	
						$('#mensajeErrorRegistrar').html("Complete el password");
					}//FIN PASSWORD INVALIDO
				}
				else
				{
					$('#mensajeErrorRegistrar').show();	
					$('#mensajeErrorRegistrar').html("Complete el email");
				}//FIN EMAIL INVALIDO
			}
			else
			{
				$('#mensajeErrorRegistrar').show();	
				$('#mensajeErrorRegistrar').html("Complete el nombre");
			}//FIN NOMBRE_USUARIO INVALIDO
		}
		else
		{
			$('#mensajeErrorRegistrar').show();	
			$('#mensajeErrorRegistrar').html("Complete el nombre de usuario");
		}//FIN USUARIO INVALIDO
			
	}


		$(document).ready(function(){	
	
		$('form').submit( function(e){
			e.preventDefault();
		})

	})
         
       $('#buscarProyecto').keypress(function(e){   
               if( e.which == 13 ){      
                Buscar();      
               }   
              });	
		
	function LogOut() {
				  
		$.ajax({
			type:'POST',
			url:'logout.php',
			data:{},
			beforeSend:function() {
                                
			}
		})
		.done(function(respuesta) {
			//location.reload();
			document.location.href="http://modela.esy.es/logout.php";
		} )
		.fail( function() {
			$('#mensajeError').show();	
			$('#mensajeError').html("HAY UN ERROR MUY GRAVE CON AJAX");
		})
		.always( function(){
                console.log("-------------DESPUES--------------");
				$('.fa').hide();
		})
	}
	
     
	function RegistrarProyecto(){
		
        var user  = $('#inputUser').val();
		var email = $('#inputEmailRegistrar').val();
		
		$.ajax({
			beforeSend:function() {
				console.log("ESTOY POR MANDAR EL REQUEST");
			},
			url:'/Controladoras/registrarProyecto.php',
			type:'POST',
			data: {NOMBRE_PROYECTO:user},
			success:function(respuesta) {
				console.log("-----------------------------------------");
				console.log(respuesta);
				console.log("-----------------------------------------");

			},
			error:function(jqXHR,estado,error){
				console.log(estado);
				console.log(error);
			},
			complete:function(jqXHR,estado) {
				console.log("EL COMPLETE:"+estado);
			},
			timeout:5000
		})
		
	} 	
