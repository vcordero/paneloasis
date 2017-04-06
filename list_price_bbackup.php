<?php
	
	// Verifica si un usuario iniciò sesion
    if(!isset($_SESSION)):
        session_start(); 
    endif;

	if($_SESSION['user'] == ""):
		header("Location: index.php");
	endif;

	include 'config.php';
	/*$user 	=	$_SESSION['user'];
	$query 	=	$mysqli->query("select * from users where user='$user'");
	$data 	=	mysqli_fetch_assoc($query);*/
	
	// Obtengo el total de items
	$SqlConsult2 = "select count(*) as Total from product where type = ".$_GET['type']." AND category NOT LIKE 'CARTERAS%'";
	$resultado = mysql_query($SqlConsult2);
	$total = mysql_fetch_array($resultado);

?>
	<!-- Total de items que tiene el listado de productos -->
	<div class="col-sm-11 infobox-container">
		<div class="infobox infobox-red  ">
			<div class="infobox-icon">
				<i class="icon-archive"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number"><?php echo $total['Total'] ?></span>
				<div class="infobox-content">Items</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb -->
	<ol class="breadcrumb">
	  <li><a href="dashboard.php">Home</a></li>
	  <li class="active">Products Category</li>
	</ol>
	<!-- Listado de Productos -->								
	<div class="row">
		<div class="col-xs-12">
			<h3 class="header smaller lighter blue"></h3>
			<!-- Si no hay productos muestra mensaje -->
			<?php if($total['Total']==0): ?>
				<div class="alert alert-warning text-center" role="alert">
				  Sorry, there are no products ...
				</div>
			<?php else: ?>
				<!-- Identifica el tipo de productos -->
				<div class="table-header">
				<?php
					if ($_GET['type']==1):
						echo 'Products: Category A';
					elseif ($_GET['type']==2):
						echo "Products: Category B";
					elseif ($_GET['type']==3):
						echo "Products: Category C";
					endif;
				?>
			</div>
			<!-- Hago consulta segun el tipo de producto -->
			<div class="table-responsive">
				<?php
					$resultado="";
					if($_GET['type']==1):
						//SELECT DISTINCT fecha FROM usuarios USE INDEX (nombre_indice_fecha) ORDER BY fecha
						//$SqlConsult = "SELECT * FROM product USE INDEX (type) WHERE type = 1";
						$SqlConsult = "SELECT * FROM product WHERE type = 1 AND category NOT LIKE 'CARTERAS%'";
						$resultado = mysql_query($SqlConsult);
					elseif($_GET['type']==2):
						$SqlConsult = "SELECT * FROM product WHERE type = 2 AND category NOT LIKE 'CARTERAS%'";
						$resultado = mysql_query($SqlConsult);
					elseif($_GET['type']==3):
						$SqlConsult = "SELECT * FROM product WHERE type = 3 AND category NOT LIKE 'CARTERAS%'";
						$resultado = mysql_query($SqlConsult);
					endif;
				?>
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>
								<i class="icon-archive bigger-110 hidden-480"></i>
								Image
							</th>
							<th>
								<i class="icon-tags bigger-110 hidden-480"></i>
								Product
							</th>
							<th>
								<i class="icon-usd bigger-110 hidden-480"></i>
								Price Retail
							</th>
							<th>
								<i class="icon-usd bigger-110 hidden-480"></i>
								Wholesale Price 
							</th>
							
						</tr>
					</thead>
					<tbody>
					<?php while($rows=mysql_fetch_array($resultado)): ?>
						<tr>
							<td style="text-align: center"><img src="<?php echo $rows[1]; ?>" style="width: 115px"></td>
							<td><?php echo $rows[2]; ?></td>
							<td><?php echo $rows[3]; ?></td>
							<td><?php echo $rows[4]; ?></td>
						</tr>
					<?php endwhile; ?> 
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>

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
								