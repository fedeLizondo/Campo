<?php
	header('Content-Type: charset=utf-8');
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

	<title>Modela</title>
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


		<?php if(!isset($_SESSION['ID_USUARIO'])): ?>
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
		<?php else:?>
			<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
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
					<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" onclick="LogOut()">							
							Log out!
					</button>						
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDatosUsuario">
						Perfil	<span class="glyphicon glyphicon-user"></span> 
					</button>
						<!--ul class="dropdown-menu">
                          <!-- Loguearse >
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
						</ul-->
				</div>
			</div>
		</nav>
		<?php endif;?>
		</div>
</header>

<div class="container" style="padding-top: 60px;">
<?php
session_start();
header('Content-Type: charset=utf-8'); 
require 'Clases/administradora.php';
    if( isset( $_SESSION["BUSCAR_PROYECTO"] ))  
	{
		$administradora = new Administradora;
		$pag = 0;
		if(isset($_SESSION["BUSCAR_PROYECTO_PAGINA"]))
		{
    		$pag = $_SESSION["BUSCAR_PROYECTO_PAGINA"];      
		}

		echo $administradora->buscarProyecto($_SESSION["BUSCAR_PROYECTO"],$pag);
		unset($_SESSION["BUSCAR_PROYECTO"]);
	}
    else
     	echo "Ingrese el proyecto a buscar en la barra de busqueda\n" ;
?>
</br>
<a href="http://modela.esy.es/">BACK HOME</a>
</div>
</body>
</html>
