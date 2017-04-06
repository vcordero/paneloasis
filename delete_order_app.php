<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$nombre 	= '';
$correo 	= '';
$telefono 	= '';

$SQLsts = 	"SELECT * FROM order_app WHERE order_number=" .$_REQUEST['id'] ;
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
			<?php endwhile; ?>
			</tbody>
		</table>
		<div style="text-align:center;margin-top:20px;">
			<form method="POST" action="functions/appove_order.php">
				<input type="hidden" value=<?php echo $_GET['id']?> name="order_id">
				<input type="submit" value="Delete Order" name="deleteorderapp" class="btn btn-primary">
			</form>
			  
		</div>
		
	</div>
								
<?php mysql_close($con); ?>
								