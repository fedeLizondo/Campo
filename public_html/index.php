<?php
//header('Content-type: text/html; charset=utf-8');
//mb_internal_encoding('UTF-8');
 header('Content-Type: charset=utf-8'); 
 require 'administradora.php';
 session_start();
 if( isset($_SESSION['ID_USUARIO']) )
     header("Location: /principal.php");

 if( isset($_POST['BUSQUEDA_PROYECTO']) )
     header("Location: /principal.php");


?>
<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modela</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--script src="https://use.fontawesome.com/e7b734d3ed.js"></script-->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

	<!--script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function () {
  														$('#myInput').focus()
														})
</script-->
	<style type="text/css">
	.fa{
	       display: none;
           }
	</style>
</head>
<body>
	<header>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="row">
			<!-- ACA ES DONDE VOY A INFORMAR LOS ERRORES -->
			<div class="container-fluid">
					<div id="mensajeError" onclick="$(this).hide()" class="alert alert-danger" role="alert" style="display:none"></div>
			</div>
		</div> 

		<div class="row"> 
                    <div class="col-xs-12 col-lg-4 text-center">
					<h1>MODELA   </h1>
  
				</div>
				<div class="col-xs-12 col-lg-4">
					<h1>
						<div class="input-group">
	     					<input type="text" class="form-control" placeholder="Ingrese el nombre del proyecto!" id="buscarProyecto">
	  					    <span class="input-group-btn">
					        	<button class="btn btn-default" type="button" onclick="Buscar()">
					        		<span class="glyphicon glyphicon-search"></span>
					        	</button>
	     					</span>
	    				</div>
	    			</h1>
				</div>

					<div class="col-xs-12 col-lg-4 dropdown text-center" style="margin-top:15px">
		
						<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
							
							<span class="glyphicon glyphicon-user"></span> Log in!
						</button>						
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalRegistrarme">
							<span class="glyphicon glyphicon-list-alt"></span> Registrarme 
						</button>

						<ul class="dropdown-menu">
                                                        <!-- Loguearse -->
							<form class="container-fluid" id="formLogin">
								<div class="form-group">
									<label for="exampleInputEmail1">Dirección de Email </label>
									<input type="email" class="form-control" id="InputEmailLogin" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Contraseña</label>
									<input type="password" class="form-control" id="InputPasswordLogin" placeholder="Contraseña">
								</div>
								<button type="submit" class="btn btn-success "onclick="Login()">Enviar<span class="glyphicon glyphicon-send"></span></button>
								<button type="button" class="btn btn-default" data-toggle="modal"  data-target="#myModal">Olvide mi contraseña</button>	
								<p>
									<i class="fa fa-spinner fa-spin fa-fw" id="spinner"></i>
								</p>
                                                                  
								</br>
								 
							</form>
						</ul>
					</div>
			</div>
		</div>

	
	</header>

<!-- Ventanas Modals -->

<!-- OLVIDE MI CONTRASEÑA-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Recuperar Contraseña</h2>
      </div>
      <div class="modal-body">
         <form >
      		<div class="form-group">
      			<label for="exampleInputEmail1">Dirección de Email </label>
      			<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email@email.com">
      		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Recuperar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

<!-- Registrarme-->
<div class="modal fade" id="modalRegistrarme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">

      	<div class="row">
			<!-- ACA ES DONDE VOY A INFORMAR LOS ERRORES -->
			<div class="container-fluid">
				<div id="mensajeErrorRegistrar" onclick="$(this).hide()" class="alert alert-danger" role="alert" style="display:none"></div>
			</div>
		</div> 
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">Registrarse</h2>
      </div>
      <div class="modal-body">
      	<div class="row container-fluid">
      	<form class="col-lg-4 col-lg-push-2">
      		<div class="form-group">
      			<label for="usr">Nombre de Usuario </label>
      			<input type="text" class="form-control" id="inputUser" placeholder="User">
      		</div>
      		<div class="form-group">
      			<label for="usr">Nombre y Apellido </label>
      			<input type="text" class="form-control" id="inputName" placeholder="Nombre">
      		</div>
      		<div class="form-group">
      			<label for="exampleInputEmailA">Dirección de Email </label>
      			<input type="email" class="form-control" id="inputEmailRegistrar" placeholder="Email@email.com">
      		</div>            
  
      		<div class="form-group">
      			<label for="exampleInputPasswordA">Contraseña </label>
      			<input type="password" class="form-control" id="inputPasswordRegistrar" placeholder="Contraseña">
      		</div>
      		<div class="form-group">
      			<label for="exampleInputPasswordB">Confirmación de Contraseña </label>
      			<input type="password" class="form-control" id="inputConfirmPassword" placeholder="Contraseña">
      		</div>
      	</form>
      	</div>

      </div>
      <div class="modal-footer">

      	<div class="col-lg-8 col-lg-push-1">
        <button type="submit" class="btn btn-primary" onclick="Registrarse()">Registrarse</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	$(document).ready(function(){	
	
		$('form').submit( function(e){
			e.preventDefault();
		})

	})
         
       $('#buscarProyecto').keypress(function(e){   
               if(e.which == 13){      
                Buscar();      
               }   
              });	
		
	function Login() {
		var email = document.getElementById('InputEmailLogin').value;
		var pass = document.getElementById('InputPasswordLogin').value;
				  
		$.ajax({
			type:'POST',
			url:'login.php',
			data:{EMAIL:email,CONTRASENIA:pass},
			beforeSend:function() {
                                $('.fa').css('display','inline');
                                
			}
		})
		.done(function(respuesta) {
                        console.log("ESTA ES LA RESPUESTA: "+respuesta+" \n");
                        JSONData = jQuery.parseJSON(respuesta);
                        console.log(JSONData);
                        if( JSONData.ESTADO )
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
    	return !(!str || 0 === str.length || /^\s*$/.test(str));
	}
	
        function Buscar() {
	 	var busqueda = $('#buscarProyecto').val();
	 	if(isValid(busqueda))
	 	{
                 $.ajax({
		        type:'POST',
			url:'index.php',
			data:{BUSCAR_PROYECTO:busqueda},
			beforeSend:function() {
                                //$('.fa').css('display','inline');
			}
		})
		.done(function(respuesta) {
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
		
                //VALIDAR LOS CAMPOS

		if( isValid(user) )
		{
			if(isValid(name))
			{
				if(isValid(email))
				{
					if( isValid(pass) && pass == pass2 )
					{
						/*$.ajax({
							type:'POST',
							url: 'registrarUsuario.php',
							data: ('USUARIO='+user+'&NOMBRE='+name+'&EMAIL='+email+'&CONTRASENIA='+pass),
							beforeSend:function() {
							$('.fa').css('display','inline');
							}
						})
						.done(function() {
							console.log("EXITO");
						} )
						.fail( function() {
							$('#mensajeError').show();	
							$('#mensajeError').html("HAY UN ERROR MUY GRAVE CON AJAX");
						})
						.always( function(){
								$('.fa').hide();
						})*/

                                                $.ajax({
							beforeSend:function() {
								console.log("ESTOY POR MANDAR EL REQUEST");
							},
							url:'registrarUsuario.php',
							type:'POST',
                                                        data: {USUARIO:user,NOMBRE:name,EMAIL:email,CONTRASENIA:pass},
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
      


	
</script>

</body>
</html>