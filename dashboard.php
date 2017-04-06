<?php session_start();
include_once ('config.php');
$userquery=$mysqli->query("select * from users where user='".$_SESSION['user']."'") or die($mysqli->error); 
$data=mysqli_fetch_assoc($userquery);
$role=$data['role'];
$tipo=$data['type'];


	if ($_SESSION['user'] == "") { 
	//si no se logeo, te envia directo al login.
		header("Location: index.php");
	}

?>

<!DOCTYPE html>

<html lang="en">
<link rel="stylesheet" href="/assets/css/styleimgmodal.css"> <!-- Para los estilos del img Modal -->

	<head>

		<meta charset="utf-8" />

		<title>The Greatrock</title>



		<meta name="description" content="" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



		<!-- basic styles -->



		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

               						



		<!--[if IE 7]>

		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />

		<![endif]-->



		<!-- page specific plugin styles -->



		<!-- fonts -->



		<link rel="stylesheet" href="assets/css/ace-fonts.css" />



		<!-- ace styles -->



		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/personalStyles.css" />


		<!--[if lte IE 8]>

		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />

		<![endif]-->



		<!-- inline styles related to this page -->



		<!-- ace settings handler -->



		<script src="assets/js/ace-extra.min.js"></script>



		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->



		<!--[if lt IE 9]>

		<script src="assets/js/html5shiv.js"></script>

		<script src="assets/js/respond.min.js"></script>

		<![endif]-->

		

		<script src="assets/js/jquery.js"></script>

		<script src="assets/js/parsley.js"></script>

	</head>



	<body>

		<div class="navbar navbar-default" id="navbar">

			<script type="text/javascript">

				try{ace.settings.check('navbar' , 'fixed')}catch(e){}

			</script>



			<div class="navbar-container" id="navbar-container">

				<div class="navbar-header pull-left">

					<a href="#" class="navbar-brand">

						<small>

							<i class="icon-archive"></i>

						</small>

					</a><!-- /.brand -->

				</div><!-- /.navbar-header -->



				<div class="navbar-header pull-right" role="navigation">

					<ul class="nav ace-nav">



						<li class="light-blue">

							<a data-toggle="dropdown" href="#" class="dropdown-toggle">

								<img class="nav-user-photo" src="assets/avatars/profile-pic.jpg" alt="Jason's Photo" />

								<span class="user-info">

									<small>Welcome,</small>

									<?php echo $_SESSION['user'] ?>

								</span>
								<?php 
									include_once ('config.php');
									$userquery=$mysqli->query("select * from users where user='".$_SESSION['user']."'") or die($mysqli->error); 
									$data=mysqli_fetch_assoc($userquery);
									$role=$data['role'];
									$tipo=$data['type'];
								?>


								<i class="icon-caret-down"></i>

							</a>



							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li>

									<a href="dashboard.php?p=edit_password">

										<i class="icon-lock"></i>

										Edit Password

									</a>

								</li>



								<li class="divider"></li>



								<li>

									<a href="logout.php">

										<i class="icon-off"></i>

										Logout

									</a>

								</li>

							</ul>

						</li>

					</ul><!-- /.ace-nav -->

				</div><!-- /.navbar-header -->

			</div><!-- /.container -->

		</div>



		<div class="main-container" id="main-container">

			<script type="text/javascript">

				try{ace.settings.check('main-container' , 'fixed')}catch(e){}

			</script>



			<div class="main-container-inner">

				<a class="menu-toggler" id="menu-toggler" href="#">

					<span class="menu-text"></span>

				</a>



				<div class="sidebar" id="sidebar">

					<script type="text/javascript">

						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}

					</script>

					<!-- Menu -->
					<ul class="nav nav-list">

						<li <?php echo isset($x1) ?>>
							<a href="dashboard.php">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> Dashboard </span>
							</a>
						</li>

					    <?php if($tipo==1 ): ?>

                        <li <?php echo isset($x19) ?>>
							<a href="dashboard.php?p=excel&type=1">
								<i class="icon-table"></i>
								<span class="menu-text"> Excel </span>
							</a>
						</li>

						<li <?php echo isset($x20) ?>>
							<a href="dashboard.php?p=extraproducts&type=1">
								<i class="icon-plus"></i>
								<span class="menu-text"> Extra products </span>
							</a>
						</li>

						<li <?php echo isset($x21) ?>>
							<a href="dashboard.php?p=prestashop&type=1">
								<i class="icon-exchange"></i>
								<span class="menu-text"> Prestashop </span>
							</a>
						</li>
                       

						<li <?php echo isset($xc2) ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-sort-by-attributes"></i>
								<span class="menu-text"> Inventory </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li <?php echo isset($price) ?>>
									<a href="dashboard.php?p=list_price_b&type=1">
										<i class="icon-double-angle-right"></i>
										Products: Price A
									</a>
								</li>
								<li <?php echo isset($price) ?>>
									<a href="dashboard.php?p=list_price_b&type=2">
										<i class="icon-double-angle-right"></i>
										Products: Price B
									</a>
								</li>
								<li <?php echo isset($price) ?>>
									<a href="dashboard.php?p=list_price_b&type=3">
										<i class="icon-double-angle-right"></i>
										Products: Price C
									</a>
								</li>
							</ul>
						</li>
					
						<li <?php echo isset($xc7) ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-bar-chart"></i>
								<span class="menu-text"> Users </span>
								<b class="arrow icon-angle-down"></b>
							</a>
                            <ul class="submenu">
								<li <?php echo isset($newuser) ?>>
									<a href="dashboard.php?p=new_user">
										<i class="icon-double-angle-right"></i>
										New User
									</a>
								</li>
								<li <?php echo isset($customers) ?>>
									<a href="dashboard.php?p=customers_list">
										<i class="icon-double-angle-right"></i>

										All Customers

									</a>
								</li>

								<li <?php echo isset($customers2) ?>>
									<a href="dashboard.php?p=list_users_a">
										<i class="icon-double-angle-right"></i>
										Customers type A
									</a>
								</li>
								<li <?php echo isset($customers3) ?>>
									<a href="dashboard.php?p=list_users_b">
										<i class="icon-double-angle-right"></i>
										Customers type B
									</a>
								</li>
								<li <?php echo isset($customers4) ?>>
									<a href="dashboard.php?p=list_users_c">
										<i class="icon-double-angle-right"></i>
										Customers type C
									</a>
								</li>								
							</ul>
                        </li>
                    <?php endif; ?>
						<li <?php echo isset($xc7) ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-gears"></i>
								<span class="menu-text"> Settings </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
							<?php if(($tipo==1)): ?>
								<li <?php echo isset($x27) ?> >
									<a href="dashboard.php?p=settings_general">
										<i class="icon-double-angle-right"></i>
										General
									</a>
								</li>
								<li>
									<a href="dashboard.php?p=select_categories">
										<i class="icon-double-angle-right"></i>
										Categories
									</a>
								</li>
								<li>
									<a href="dashboard.php?p=customers_import">
										<i class="icon-double-angle-right"></i>
										Import Customers
									</a>
								</li>
								<li>
									<a href="dashboard.php?p=customers_export">
										<i class="icon-double-angle-right"></i>
										Export Customers
									</a>
								</li>
								<li>
									<a href="dashboard.php?p=bloqued_ip">
										<i class="icon-double-angle-right"></i>
										Blocked IP
									</a>
								</li>
							<?php endif; ?>
								<li <?php echo isset($x28) ?>>
									<a href="dashboard.php?p=edit_password">
										<i class="icon-double-angle-right"></i>
										Edit Password
									</a>
								</li>
                            <?php if(($tipo==1)): ?>
                                <li <?php echo isset($x28) ?>>
									<a href="dashboard.php?p=add_smtp">
										<i class="icon-double-angle-right"></i>
										SMTP configuration
									</a>
								</li>
                            <?php endif; ?>
							</ul>

							<?php if(($tipo==1)): ?>
							<li>
								<a href="#" class="dropdown-toggle">
									<i class="icon-gears"></i>
									<span class="menu-text"> App Order </span>
									<b class="arrow icon-angle-down"></b>
								</a>
								<ul class="submenu">
								
									<li <?php echo isset($x27) ?> >
										<a href="dashboard.php?p=app_list">
											<i class="icon-double-angle-right"></i>
											New Order List
										</a>
									</li>
									<li>
										<a href="dashboard.php?p=app_list_appoved">
											<i class="icon-double-angle-right"></i>
											Order List Approved
										</a>
									</li>
									
								</ul>

							</li>

							<li>
								<a href="#" class="dropdown-toggle">
									<i class="icon-gears"></i>
									<span class="menu-text"> Web Order </span>
									<b class="arrow icon-angle-down"></b>
								</a>
								<ul class="submenu">
								
									<li <?php echo isset($x27) ?> >
										<a href="dashboard.php?p=web_list">
											<i class="icon-double-angle-right"></i>
											New Order List
										</a>
									</li>
									<li>
										<a href="dashboard.php?p=web_list_appoved">
											<i class="icon-double-angle-right"></i>
											Order List Approved
										</a>
									</li>
									
								</ul>

							</li>
							<?php endif; ?>
							<li>
								<a href="logout.php">
									<i class="icon-off"></i>
									<span class="menu-text"> Logout </span>
								</a>
							</li>
						</li>

						

					</ul>	<!-- /.nav-list -->



					<div class="sidebar-collapse" id="sidebar-collapse">

						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>

					</div>



					<script type="text/javascript">

						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}

					</script>

				</div>



				<div class="main-content">

					<div class="breadcrumbs" id="breadcrumbs"></div>


					<div class="page-content">
						

						<!-- Opciones de Menu -->
						<div class="row">

							<div class="col-xs-12">

								<!-- PAGE CONTENT BEGINS -->

								<?php
									/*include_once ('config.php');
									$userquery=$mysqli->query("select * from users where                                    user='".$_SESSION['user']."'") or die($mysqli->error); 
									$data=mysqli_fetch_assoc($userquery);
									$role=$data['role'];
									$tipo=$data['type'];*/
									//esta cableado para probar en servidor
									if(isset($_GET['p']) && $_GET['p'] == 'list_users_a' && $tipo==1){
										require_once 'list_users_a.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'list_users_b' && $tipo==1){
										require_once 'list_users_b.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'list_users_c' && $tipo==1){
										require_once 'list_users_c.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'new_user' && $tipo==1){
										require_once 'new_user.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'view_customer' && $tipo==1){
										require_once 'view_customer.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'detail_order_web' && $tipo==1){
										require_once 'detail_order_web.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'detail_order_app' && $tipo==1){
										require_once 'detail_order_app.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'detail_order_web_return' && $tipo==1){
										require_once 'detail_order_web_return.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'detail_order_app_return' && $tipo==1){
										require_once 'detail_order_app_return.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'detail_cat_web' && $tipo==1){
										require_once 'detail_cat_web.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'delete_order_web' && $tipo==1){
										require_once 'delete_order_web.php';
									}

									if(isset($_GET['p']) && $_GET['p'] == 'delete_order_app' && $tipo==1){
										require_once 'delete_order_app.php';
									}

									if(isset($_GET['p']) && $_GET['p'] == 'edit_customer' && $tipo==1){
										require_once 'edit_customer.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'customers_list' && $tipo==1){
										require_once 'customers_list.php';
									}  
									if(isset($_GET['p']) && $_GET['p'] == 'app_list' && $tipo==1){
										require_once 'app_list.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'web_list' && $tipo==1){
										require_once 'web_list.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'web_list_appoved' && $tipo==1){
										require_once 'web_list_appoved.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'app_list_appoved' && $tipo==1){
										require_once 'app_list_appoved.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'select_categories' && $tipo==1){
										require_once 'select_categories.php';
									} 
									if((isset($_GET['p']) == "") && ($tipo ==2))
									{
										require_once 'dashboard_client.php';
									}
									if((isset($_GET['p']) == "" )&& ($tipo ==1))
									{
										require_once 'dashboard_admin.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'excel' && $tipo == 1)
									{
										require_once 'dashboard_excel.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'extraproducts' && $tipo == 1)
									{
										require_once 'dashboard_extraproducts.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'prestashop' && $tipo == 1)
									{
										require_once 'dashboard_prestashop.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'edit_password'){
										require_once 'edit_password.php';
									}
                                    if(isset($_GET['p']) && $_GET['p'] == 'add_smtp'){
										require_once 'add_smtp.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'settings_general' && $tipo==1){
										require_once 'settings_general.php';
									}
									if(isset($_GET['p']) && $_GET['p'] == 'list_price_b'){
										require_once 'list_price_b.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'customers_import' && $tipo==1){
										require_once 'import_customer.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'customers_export' && $tipo==1){
										require_once 'export_customer.php';
									} 
									if(isset($_GET['p']) && $_GET['p'] == 'bloqued_ip' && $tipo==1){
										require_once 'bloqued_ip.php';
									}

								?>

								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /.page-content -->

				</div><!-- /.main-content -->



			</div><!-- /.main-container-inner -->



			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">

				<i class="icon-double-angle-up icon-only bigger-110"></i>

			</a>

		</div><!-- /.main-container -->



		<!-- basic scripts -->



		<!--[if !IE]> -->



		<script type="text/javascript">

			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");

		</script>



		<!-- <![endif]-->



		<!--[if IE]>

<script type="text/javascript">

 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");

</script>

<![endif]-->



		<script type="text/javascript">

			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");

		</script>

		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/typeahead-bs2.min.js"></script>



		<!-- page specific plugin scripts -->



		<!-- ace scripts -->



		<script src="assets/js/ace-elements.min.js"></script>

		<script src="assets/js/ace.min.js"></script>



		<!-- inline scripts related to this page -->

		<script type="text/javascript">

		/*function mostrar(){
			$('#category').show();
		}

		function ocultar(){
			$('#category').hide();
		}*/

		function change(valor){
			if(valor==1){
				$('#category').hide();
			}else{
				$('#category').show();
			}
		}

		// Selecciona opcion del select
		  $('#type').on('change',function(){
		      var valor = $(this).val();
		      change(valor);
		  });
		</script>

		<script>

// Establece el modal div
var modal = document.getElementById('divModal');  //El div modal que contiene la imagen
var modalImg = document.getElementById("img_mod"); 
// Establece el elemento <span> que cerrara el modal
var span = document.getElementsByClassName("close")[0]; //Spam que funciona como CERRAR
// Cuando el usuario hace click en el <span> (x), cierra el div modal
span.onclick = function() {
    modal.style.display = "none";
}

var captionText = document.getElementById("caption"); //El caption que muestra informacion de la imagen
var precioText = document.getElementById("precio");  //El caption que muestra informacion de la imagen 2

function viewImg(la_img) {

    var img = la_img; //Aca se pasa el Id de la imagen que se desea mostrar

    modal.style.display = "block"; //Muestra el div modal
    modalImg.src = img.src; //Asocia la imagen que se desea mostrar
    //captionText.innerHTML = img.alt; //El texto que se desea mostrar debajo de la imagen
    //precioText.innerHTML = 'Precio: ' + el_precio; //El texto que se desea mostrar debajo de la imagen

}

</script>

	</body>

</html>

