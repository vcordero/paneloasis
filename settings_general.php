<?php
// Verifica si un usuario iniciò sesion
    if(!isset($_SESSION)):
        session_start(); 
    endif;

	if($_SESSION['user'] == ""):
		header("Location: index.php");
	endif;

	include 'config.php';
	$user 	=	$_SESSION['user'];
	$query 	=	$mysqli->query("select * from users where user='$user'");
	$data 	=	mysqli_fetch_assoc($query);

	// Mensaje de respuesta
	$mensaje="";

?>
	<!-- Titulo del Formulario -->
	<div class="page-header">
		<h1>General Settings</h1>
	</div><!-- /.page-header -->
	<!-- Cuerpo del Formulario -->
	<div class="row">
		<div class="col-xs-12">
			<!-- Respuesta de mensaje -->
			<?php if(isset($_GET['message'])):
				if($_GET['message']==0):  ?>
					<div class="alert alert-success text-center" role="alert">
					  Email Save ..
					</div>
			<?php elseif($_GET['message']==1): ?>
					<div class="alert alert-danger text-center" role="alert">
					  Error saving the mail ..
					</div>
			<?php endif;endif; ?>

			<form class="form-horizontal" role="form" action="functions/new_email.php" method="post" parsley-validate>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Email</label>

					<div class="col-sm-9">
						<span class="input-icon">
							<input type="email" id="form-field-icon-1" placeholder="admin.email@gmail.com" name="email"  parsley-type="email" required/>
							<i class="icon-envelope blue"></i>
						</span>
					</div>
				</div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="icon-ok bigger-110"></i>
							Save
						</button>
					</div>
				</div>
			</form>
		</div>							
	</div>