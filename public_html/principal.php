<?php
	header('Content-Type: charset=utf-8'); 
	session_start();
	
	if( !isset($_SESSION['ID_USUARIO']) )
    	header("Location: /");

	if(isset($_POST['BUSQUEDA_PROYECTO'] ))
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
	
	<script type="text/javascript" src="/js/base.js"></script>

	<!--script src="https://use.fontawesome.com/e7b734d3ed.js"></script-->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

	<!--script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function () {
  			$('#myInput').focus()
		})
	</script-->


</head>
<body>

	<!--header class = "row"-->
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
	<!--/header-->
	<div class="container"> 
		<div class="row">
			<div class="col-xs-12 col-lg-6 ">
			<!-- LISTA FAVORITOS -->

            <div class="box-header with-border">
              <h3 class="box-title">Favoritos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="/img/default-50x50.gif" alt="Product Image"> <a href="javascript:void(0)" class="product-title">Proyecto 1 </a>
                    <span class="glyphicon glyphicon-star pull-right"></span>
                  </div>
                  <div class="product-info">
                    
                      <!--span class="label label-warning pull-right">0</span-->
                        <span class="product-description">
                          descripcion del proyecto
                        </span>
                  </div>
                </li>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">Ver todos los Favoritos</a>
            </div>
            <!-- /.box-footer -->
                    
			</div>

			<div class="col-xs-12 col-lg-6">
			<button type="button" class="btn btn-primary btn-lg btn-block hidden-md-down" data-toggle="modal" data-target="#modalRegistrarProyecto">
				<span class="glyphicon glyphicon-user"></span> Crear Proyecto
				<i class="fa fa-file-text"></i> 
			</button>
				<!-- Ventana Modal CrearProyecto-->
				</div>
				<div class="modal fade" id="modalRegistrarProyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
								<h2 class="modal-title" id="myModalLabel">Crear Proyecto</h2>
							</div><!-- end modal-header-->

							<div class="modal-body">
								<div class="row container-fluid">
									<form class="col-lg-4 col-lg-push-2">
										<div class="form-group">
											<label for="usr">Nombre del proyecto </label>
											<input type="text" class="form-control" id="inputUser" placeholder="User">
										</div>
										<div class="form-group">
											<label for="exampleInputEmailA">Invitar a un usuario Email </label>
											<input type="email" class="form-control" id="inputEmailRegistrar" placeholder="Email@email.com">
										</div>            
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<div class="col-lg-8 col-lg-push-1">
									<button type="submit" class="btn btn-primary" onclick="RegistrarProyecto()">Registrarse</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			
		</div>
	</div>
<style>

.box.box-primary {
    border-top-color: #3c8dbc;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}


.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-body {

    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}
.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}
.text-center {
    text-align: center;
}

.btn-box-tool {
    padding: 5px;
    font-size: 12px;
    background: transparent;
    color: #97a0b3;
}
</style>
</body>
</html>
