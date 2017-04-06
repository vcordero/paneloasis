<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where user='$user'");
$data=mysqli_fetch_assoc($query);
if($data['type']=='1'){ 
$SqlStat = "SELECT * FROM unitmeasure";
$result = mysql_query($SqlStat);

?>

									<div class="col-xs-7">
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Units of Measurement</th>

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
														
														<td><a href="functions/delete_unit.php?id=<?php echo $row[0]; ?>">Delete</a></td>

													</tr>
													<?php
													 }
													?> 
												</tbody>
											</table>
										</div><!-- /.table-responsive -->
									</div>
									
									<div class="col-sm-7">

										<div class="widget-box">
											<div class="widget-header">
												<h4>Add New Unit</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form action="functions/add_unit.php" method="post" parsley-validate>
														<!-- <legend>Form</legend> -->

														<fieldset>
															<label>Unit name : </label>

															<input type="text" placeholder="kilogram" name="measure" required/>

														</fieldset>

														<div class="form-actions center">
															<button type="submit" class="btn btn-sm btn-success">
																Submit
																<i class="icon-arrow-right icon-on-right bigger-110"></i>
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
<?php } else {
    
    echo '';
}