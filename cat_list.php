<?php

//session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SqlStat = "SELECT * FROM cats";
$result = mysql_query($SqlStat);
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where user='$user'");
$data=mysqli_fetch_assoc($query);
if($data['type']=='1'){ 
    
  // header("Location:logout.php");

?>

<div class="page-header">
	<h1>
		Categories List
	</h1>
</div>

<div class="row">
									<div class="col-xs-7">
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Category</th>

														<th>Action</th>
													</tr>
												</thead>

												<tbody>
												<?php
												while($row = mysql_fetch_array($result))
												{
												 ?>
													<tr>

														<td><?php echo $row[1]; ?></td>
														
														<td><a href="functions/delete_cat.php?id=<?php echo $row[0]; ?>">Delete</a></td>

													</tr>
													<?php
													 }
													?> 
												</tbody>
											</table>
										</div><!-- /.table-responsive -->
									</div><!-- /span -->
								</div>
<?php } else { 
    
    
    echo '';
}
?>						
<?php mysql_close($con); ?>