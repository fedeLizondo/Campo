<?php
//header('Content-type: text/html; charset=utf-8');
//mb_internal_encoding('UTF-8');
header('Content-Type: charset=utf-8'); 
require 'Clases/administradora.php';
session_start();

if( isset($_SESSION['ID_USUARIO']) )
{
    header("Location: /principal.php");
}

if( isset($_SESSION['BUSCAR_PROYECTO']) )
{
	header("Location: /buscarProyecto.php");
}


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
	<script type="text/javascript" src="js/base.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
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
					<h1>MODELA</h1>
  
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

</body>
</html>