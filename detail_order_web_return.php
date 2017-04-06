<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$nombre 			= '';
$correo 			= '';
$telefono 			= '';
$detail_price 		= 0;
$wholesale_price 	= 0;
$quantity 			= 0;

$SQLsts = 	"SELECT * FROM order_web WHERE order_number=" .$_REQUEST['id'] ;
$result_name = 	mysql_query($SQLsts);
$result = 	mysql_query($SQLsts);
//$row 	= 	mysql_fetch_row($result);
while($rows=mysql_fetch_array($result_name)){
	$nombre 	= $rows['name'];
	$correo 	= $rows['email'];
	$telefono 	= $rows['phone'];
}

?>

<div class="page-header">
<h1 style="text-align:center">Order #<?php echo $_REQUEST['id']; ?></h1>
<p style="text-align:center;font-size:14px">
	<span><b>Name:</b> <?php echo $nombre ?></span>
	<span><b>Email:</b> <?php echo$correo ?></span>
	<span><b>Phone:</b> <?php echo $telefono ?></span>
</p>
</div><!-- /.page-header -->

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
						Order Qty / Color
					</th>
				</tr>
			</thead>

			<tbody>
			<?php while($rows=mysql_fetch_array($result)): ?>

				<tr>
					<td><?php echo $rows['description']; ?></td>
					<td><?php echo $rows['retail_price']; ?></td>
					<td><?php echo $rows['wholesale_price']; ?></td>
					<td>
						<?php if($rows['color']!='NA'): ?>
							<?php echo $rows['color']; ?>
						<?php else: ?>
							<?php echo $rows['quantity']; ?>
						<?php endif; ?>
					</td>
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
				<input type="submit" value="Reinstate" name="reinstate" class="btn btn-primary">
			</form>
			  
		</div>
		
	</div>
								
<?php mysql_close($con); ?>
								