<?php

//session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SqlStat = "SELECT * FROM locations ORDER BY id DESC";
$result = mysql_query($SqlStat);

?>

<div class="page-header">
	<h1>
		Locations List
	</h1>
</div>

<div class="row">
									<div class="col-xs-7">
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Location</th>
														<th>Address</th>
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
														<td><?php echo $row[2]; ?></td>
														
														<td><a href="functions/delete_location.php?id=<?php echo $row[0]; ?>">Delete</a></td>

													</tr>
													<?php
													 }
													?> 
												</tbody>
											</table>
										</div><!-- /.table-responsive -->
									</div><!-- /span -->
								</div>
								
<?php mysql_close($con); ?>