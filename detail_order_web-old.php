<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

//$nombre 			= '';
//$correo 			= '';
//$telefono 			= '';
$detail_price 		= 0;
$wholesale_price 	= 0;
$quantity 			= 0;

$_SESSION['id'] = $_REQUEST['id']; // Variable de sesion para generar el reporte excel

$SQLsts = 	"SELECT * FROM order_web WHERE order_number=" .$_REQUEST['id'] ;
$result_name = 	mysql_query($SQLsts);
$result = 	mysql_query($SQLsts);
//$row 	= 	mysql_fetch_row($result);
while($rows=mysql_fetch_array($result_name)){
	$_SESSION['nombre'] 	= $rows['name'];
	$_SESSION['correo'] 	= $rows['email'];
	$_SESSION['telefono'] 	= $rows['phone'];
	$_SESSION['comments'] 	= $rows['comments'];
}



?>

<div class="page-header">
<h1 style="text-align:center">Order #<?php echo $_REQUEST['id']; ?></h1>
<p style="text-align:center;font-size:14px">
	<span><b>Name:</b> <?php echo $_SESSION['nombre'] ?></span>
	<span><b>Email:</b> <?php echo $_SESSION['correo'] ?></span>
	<span><b>Phone:</b> <?php echo $_SESSION['telefono'] ?></span>
</p>
<p style="text-align:center;font-size:14px">
	<?php if($_SESSION['comments']!=''): ?>
		<span><b>Comments:</b> <?php echo $_SESSION['comments'] ?></span>
	<?php endif; ?>
</p>
</div><!-- /.page-header -->
<div class="col-xs-12">
	<p style="text-align:right"><a href="reporteexcel.php"><img src="assets/img/excel.png">Get Report</a></p>
</div>
<div class="row">
<div class="col-xs-12">

	<div class="table-responsive">
		<table id="sample-table-2" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					
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
			<?php while($rows=mysql_fetch_array($result)): ?>

				<tr>
					<td><?php echo $rows['description']; ?></td>
					<td><?php echo $rows['retail_price']; ?></td>
					<td><?php echo $rows['wholesale_price']; ?></td>
					<td><?php echo $rows['quantity']; ?></td>
				</tr>
				<?php $detail_price = $detail_price + $rows['retail_price']; ?>
				<?php $wholesale_price = $wholesale_price + $rows['wholesale_price']; ?>
				<?php $quantity = $quantity + $rows['quantity']; ?>
			<?php endwhile; ?>
				<tr>
					<td></td>
					<td><b>Total:</b> <?php echo $detail_price; ?></td>
					<td><b>Total:</b> <?php echo $wholesale_price; ?></td>
					<td><b>Total:</b> <?php echo $quantity; ?></td>
				</tr>
			</tbody>
		</table>
		<div style="text-align:center;margin-top:20px;">
			<form method="POST" action="functions/appove_order.php">
				<input type="hidden" value=<?php echo $_GET['id']?> name="order_id">
				<input type="submit" value="Dispenser" name="order" class="btn btn-primary">
				
			</form>
			  
		</div>
		
	</div>
								
<?php mysql_close($con); ?>
								