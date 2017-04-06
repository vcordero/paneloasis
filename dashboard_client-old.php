<?php
    if(!isset($_SESSION)): 
        session_start(); 
    endif;
	if ($_SESSION['user'] == ""):
		header("Location: index.php");
	endif;
	
	include 'config.php';
	
	$user=$_SESSION['user'];
	$query=$mysqli->query("select * from users where user='$user'");
	$data=mysqli_fetch_assoc($query);
	
	//$role =1; //cableado para probar en servidor
	//$tipo=2; //cableado para probar en servidor
	
	if($data['type']=='2'): //real
	//	if($tipo=='2'){ //cableado
		
		if ($data['role']==1): //real
		//if ($role==1){ //cableado
			$SqlConsult2 = "select count(*) as Total 
						    from product 
						    where type = 1  AND category NOT LIKE 'CARTERAS%'
							 ";
		endif;
		if ($data['role']==2): //real
		//if ($role==1){ //cableado
			$SqlConsult2 = "select count(*) as Total 
						    from product 
						    where type = 2  AND category NOT LIKE 'CARTERAS%'
							 ";
		endif;
		if ($data['role']==3): //real
		//if ($role==1){ //cableado
			$SqlConsult2 = "select count(*) as Total 
						    from product 
						    where type = 3  AND category NOT LIKE 'CARTERAS%'
							 ";
		endif;
		$resultado = mysql_query($SqlConsult2);
		$datoss =mysql_fetch_array($resultado);
	//print_r($datoss)
?>
<?php	if(isset($_GET['Emessage'])):
		$mensaje = $_GET['Emessage'];
			if ($mensaje == "1"): ?>
				<div class="alert alert-success text-center" role="alert">
			  		the email, is sended correctly
				</div>
<?php 		elseif ($mensaje == "2"): ?>
				<div class="alert alert-danger text-center" role="alert">
					error, the email It could not be sent, try again later.				
				</div>
<?php 		endif;
		endif; ?>
<link rel="stylesheet" href="assets/css/responsive.css" />
	<div class="col-sm-11 infobox-container">
		<div class="infobox infobox-red  ">
			<div class="infobox-icon">
				<i class="icon-archive"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number"><?= $datoss['Total'] ?></span>
				<div class="infobox-content">Items</div>
			</div>
		</div>
	</div> 
	<form class="form-horizontal" role="form" action="functions/pruebacorreo.php" method="post" parsley-validate> 	

	<!-- Listado de Productos -->								
	<div>
		<div class="col-xs-12">
			<p style="color:green" class="hidden-md hidden-lg hidden-sm">
				Por favor si esta viéndolo en teléfono movil gire horizontalmente para ver los precios.
			</p>
			<h3 class="header smaller lighter blue"></h3>
			<?php if($datoss['Total']==0): ?>
				<div class="alert alert-warning text-center" role="alert">
				  Sorry, there are no products ...
				</div>
			<?php else: ?>
			
			<div class="table-header">
			<?php
				if ($data['role']==1): //real
				//if ($role==1){ //cableado
					echo 'Products: Category A';
				endif;
				if ($data['role']==2): //real
				//if ($role==1){ //cableado
					echo "Products: Category B";
				endif;
				if ($data['role']==3): //real
				//if ($role==1){ //cableado
					echo "Products: Category C";
				endif;
			
			?>

			</div>

			<div class="table-responsive">
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>
								<i class="icon-archive bigger-110 hidden-40"></i>
								Image
							</th>
							<th>
								<i class="icon-tags bigger-110 hidden-480"></i>
								Product
							</th>
							<th>
								<i class="icon-usd bigger-110 hidden-480"></i>
								Retail Price 
							</th>
							<th>
								<i class="icon-usd bigger-110 hidden-480"></i>
								Wholesale Price 
							</th>
							<th style="text-align:center">
								<i class="icon-archive bigger-110 hidden-480"></i>
								Order Qty
							</th>
						</tr>
					</thead>

					<tbody>

					<?php						
						//$datos =mysql_fetch_array($resultado);
						//print_r($datos);
						// REAL
						if ($data['role']==1):
							$SqlConsult = "SELECT * FROM product WHERE type = 1  AND category NOT LIKE 'CARTERAS%'";
						endif;
						if ($data['role']==2):
							$SqlConsult = "SELECT * FROM product WHERE type = 2  AND category NOT LIKE 'CARTERAS%'";
						endif;
						if ($data['role']==3):
							$SqlConsult = "SELECT * FROM product WHERE type = 3  AND category NOT LIKE 'CARTERAS%'";
						endif;
						
						//CABLEADO
						//$SqlConsult = "SELECT * FROM product WHERE type = 1";

						$resultado = mysql_query($SqlConsult);
						//$datos =mysql_fetch_array($resultado);
						//print_r($datos);
						$ordenes = array();


						while($rows=mysql_fetch_array($resultado)): 
								?>

						<tr>
							<?php
								$imagen = "'".$rows[1]."'"; 
							?>

							<td style="text-align: center"><img src= <?php echo $imagen ?>  class="tamanio"></td>
							<td><?php echo $rows[2]; ?></td>
							<td><?php echo $rows[3]; ?></td>
							<td><?php echo $rows[4]; ?></td>
							<?php
								$nombre = "totalselected-".$rows[0];
								array_push($ordenes, $nombre);
							?>
							<td style="text-align:center"><input type="number" size="5" name = <?php echo $nombre ?>></td>

				
						</tr>
						<?php
						 	
						 endwhile;
						 $_SESSION['pedido']=$ordenes;
						?> 
						
					</tbody>
				</table>
				<div id="lightbox">epaleeee</div>
			</div>

		</div>
	</div>
	<div>
		<div class="page-header col-lg-12">
			<h1>
				Order Now
			</h1>
		</div>
		<!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">															
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Contact Person</label>

					<div class="col-sm-9">
						<span class="input-icon">
							<input type="text" id="form-field-icon-1" placeholder="Jane Doe" name="cpname" required/>
							<i class="icon-male blue"></i>
						</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Email</label>

					<div class="col-sm-9">
						<span class="input-icon">
							<input type="text" id="form-field-icon-1" placeholder="supplier@gmail.com" name="email" parsley-type="email" required/>
							<i class="icon-envelope blue"></i>
						</span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Contact Number</label>

					<div class="col-sm-9">
						<span class="input-icon">
							<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="phone1" required/>
							<i class="icon-phone blue"></i>
						</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Comment</label>

					<div class="col-sm-9">
						<span class="input-icon">
							<textarea class="form-control" id="form-field-8" placeholder="Type supplier commets here" name="t1" required></textarea>
						</span>
					</div>
				</div>
				

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit" name ="send">
							<i class="icon-ok bigger-110"></i>
							Send Message
						</button>

					</div>
				</div>
			
			</div>
		</form>
		<?php
			endif;
			?>
<?php mysql_close($con); ?>
	<!-- basic scripts -->

	<!--[if !IE]> -->

	<script type="text/javascript">
		window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
	</script>

	<!-- <![endif]-->


	<!-- page specific plugin scripts -->

	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

<script>
	$(document).ready(function(){
		
		$("img").click(function(){
			var imgsrc = $(this).attr("src");
			$("#lightbox").toggle(200).html("<img src ="+imgsrc+">");
		});

		$("#lightbox").click(function(){
			$(this).hide(200);
		});


	});

	
</script>						
<?php 
else:
    echo '';
endif;


						