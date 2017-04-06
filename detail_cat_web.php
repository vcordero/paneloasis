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

$SQLsts = 	"SELECT * FROM cats WHERE id=" .$_REQUEST['id'] ;
$result = 	mysql_query($SQLsts);
//$row 	= 	mysql_fetch_row($result);


?>

<div class="page-header">
<h1 style="text-align:center">Category #<?php echo $_REQUEST['id']; ?></h1>

</div><!-- /.page-header -->

<div class="row">
<div class="col-xs-12">

	<div class="table-responsive">
		<form method="POST" action="functions/active_deactive_categories.php">
			<input type="hidden" value=<?php echo $_GET['id']?> name="cat_id">
			<table id="sample-table-2" class="table table-striped table-bordered table-hover">

				<thead>
					<tr>
						
						<th>
							<i class="icon-tags bigger-110 hidden-480"></i>
							Category Name
						</th>
						<th>
							<i class="icon-usd bigger-110 hidden-480"></i>
							Photo 
						</th>
		
					</tr>
				</thead>

				<tbody>
				<?php while($rows=mysql_fetch_array($result)): ?>

					<tr>
						<td><?php echo $rows['cat']; ?></td>
						<td>
							<input type="text" name="photo" style="width: 100%" value="<?php echo $rows['photo']; ?>">
						</td>
					</tr>

				<?php endwhile; ?>
				</tbody>
			</table>
		
			<div style="text-align:center;margin-top:20px;">
				<input type="submit" value="Update Photo" name="deletecat" class="btn btn-primary">
			</div>
		</form>
	</div>
								
<?php mysql_close($con); ?>
								