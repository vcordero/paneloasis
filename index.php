<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Fragancias Oasis - Admin Login</title>

		<meta name="description" content="User login page" />
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
		

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<script src="assets/js/jquery.js"></script>
		<script type="text/javascript">
		
		$( document ).ready(function(){
			$('#updatecaptcha').on('click',function(){
			
			 $("#captchaimage").attr("src","captcha.php?r=" + Math.random());

			});
		});

		
		</script>
		<!--<script src="assets/js/parsley.js"></script>-->

		
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
					  <div class="login-container">

							<div class="center">
								<h1>
									<i class="icon-archive green"></i>
									<span class="red">Fragancias</span>
									<span class="white">Admin Login</span>
								</h1>
							</div>

							<div class="space-6"></div>
							<div class="text-center">
								<span id="response"></span>

									<?php if(isset($_SESSION['message'])): 
											if($_SESSION['message']==0): ?>
												<span style="color:#E74C3C"> the value of the captcha is incorrect</span>
												
									<?php   endif;
											if($_SESSION['message']==1): ?>
												<span style="color:#2FA862"> You have been successfully registered</span>

									<?php   endif;
											if($_SESSION['message']==2): ?>
												<span style="color:#E74C3C">Problems with registration. Try again</span>
									<?php	endif;
											if($_SESSION['message']==3): ?>
												<span style="color:#E74C3C">The user already exists. Try again</span>
									<?php	endif;
											endif;  unset($_SESSION['message']); ?>
							</div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-lock"></i>
												Admin Login
											</h4>

											<div class="space-6"></div>

											<form action="login.php" role="form" method="post" parsley-validate>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="username" parsley-type="alphanum" parsley-minlength="5" required/>
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="password" parsley-type="alphanum" parsley-minlength="5" required/>
															<i class="icon-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key"></i>
															Login
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											
										</div><!-- /widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
													<i class="icon-arrow-left"></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="#" onclick="show_box('signup-box'); return false;" class="forgot-password-link">
													Register
													<i class="icon-arrow-right"></i>
												</a>
											</div>

										</div>

									</div><!-- /widget-body -->
								</div><!-- /login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="icon-key"></i>
												Retrieve Password
											</h4>
 
											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form action="functions/recover_password.php" method="post" parsley-validate>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" name="email" parsley-type="email" required/>
															<i class="icon-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="submit" name="recover" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="icon-lightbulb"></i>
															Send Me!
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /widget-main -->

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												Back to login
												<i class="icon-arrow-right"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /forgot-box -->
								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="icon-group blue"></i>
												New User Registration
											</h4>
											<div class="space-6"></div>
											
											<p> Enter your details to begin: </p> 
											<form method="post" id="formregister">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" name="email"  placeholder="Email" required/>
															<i class="icon-envelope"></i>
														</span>
														<span id="email" style="color:#E74C3C"></span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="phone" placeholder="Phone" required/>
															<i class="icon-phone"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" required/>
															<i class="icon-user"></i>
														</span>
														<span id="username" style="color:#E74C3C"></span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="pass" placeholder="Password" required/>
															<i class="icon-lock"></i>
														</span>
														<span id="password" style="color:#E74C3C"></span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="captcha" placeholder="captcha code" required/>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<image id="captchaimage" src="captcha.php">
															<button type="button" id="updatecaptcha" class="width-50 pull-right btn btn-sm">
																Update Captcha
															</button>
														</span>
													</label>
													<div class="space-24"></div>
													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="icon-refresh"></i>
															Reset
														</button>
														<button type="button" id="register"class="width-65 pull-right btn btn-sm btn-success">
															Register
															<i class="icon-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>
										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												<i class="icon-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /signup-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
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

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>

		<!-- Funcionamiento de Captcha -->
		<script type="text/javascript">

		$(document).ready(function(){

			$('#register').on('click',function(){
				
				// Obtengo los valores del formulario
				var str = $('#formregister').serialize();
				
				// Tendrà la respuesta de la validacion del formulario
				var result="";
				// Limpio todos los errores que se mostraron previamente
				$('#username').html('');
      			$('#email').html('');
      			$('#password').html('');

		 		$.ajax({
				  	url: 'functions/new_register.php',
				  	type: 'POST',
				  	async: true,
				 	data: str ,
				  	success: function(data){	
			      		
			      		//alert(data);
			      		if(data==0){
			      			result='<span style="color:#E74C3C;font-size:18px"> the value of the captcha is incorrect</span>';
			      			$('#response').html(result);
			      		}else if(data==1){
			      			result='<span style="color:#2FA862;font-size:18px"> You have been successfully registered</span>';
			      			$('#response').html(result);
			      		}else if(data==2){
			      			result='<span style="color:#E74C3C;font-size:18px">Problems with registration. Try again</span>';
			      			$('#response').html(result);
			      		}
			      		else if(data==3){
			      			result='<span style="color:#E74C3C;font-size:18px">The user already exists. Try again</span>';
			      			$('#response').html(result);
			      		}else if(data==4){
			      			result='<span style="color:#E74C3C">Email is required</span>';
			      			$('#username').html('');
			      			$('#email').html(result);
			      			$('#password').html('');
			      		}else if(data==5){
			      			result='<span style="color:#E74C3C">Username is required</span>';
			      			$('#email').html('');
			      			$('#username').html(result);
			      			$('#password').html('');
			      		}else if(data==6){
			      			result='<span style="color:#E74C3C">Password is required</span>';
			      			$('#password').html(result);
			      			$('#username').html('');
			      			$('#email').html('');
			      		}else if(data==7){
			      			result='<span style="color:#E74C3C">Incorrect email format</span>';
			      			$('#password').html('');
			      			$('#username').html('');
			      			$('#email').html(result);
			      		}else if(data==8){
			      			result='<span style="color:#E74C3C;font-size:18px">Total of failed attempts. Contact the administrator of the page.</span>';
			      			
			      			$('#response').html(result);
			      			$("[name=email]").val('');
			      			$("[name=phone]").val('');
			      			$("[name=username]").val('');
			      			$("[name=pass]").val('');
			      			$("[name=captcha]").val('');
			      		}
			      		
				  	}
			  	});
			});
		});
		</script>
	</body>
</html>
