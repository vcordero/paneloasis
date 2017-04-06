<?php

//session_start();
if ($_SESSION['user'] == "") {
	header("Location:index.php");
}
include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where user='$user'");
$data=mysqli_fetch_assoc($query);
if($data['type']=='1'){ 
    
   

$SqlStat = "SELECT * FROM locations";
$result = mysql_query($SqlStat);

$SqlStat2 = "SELECT * FROM shipping";
$result2 = mysql_query($SqlStat2);

$SqlStat3 = "SELECT * FROM customers";
$result3 = mysql_query($SqlStat3);

$SqlStat4 = "SELECT * FROM items";
$result4 = mysql_query($SqlStat4);

if ($_SESSION['sellitm'] != "") {
	$SqlStat5 = "SELECT * FROM items WHERE id =" . $_SESSION['sellitm'];
	$result5 = mysql_query($SqlStat5);
	$rowx = mysql_fetch_row($result5);
}


?>

				<div class="page-header">
							<h1>
								Sell
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<form class="form-horizontal" role="form" action="functions/add_sell.php" method="post" parsley-validate>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item &nbsp;</label>
											<span class="input-icon">
											<select name="item" onchange="window.location='dashboard.php?p=sell&itemid=' + this.value;" required>
												<option></option>
												<?php
												while($row4 = mysql_fetch_array($result4))
												{
												 ?>
												<option value="<?php echo $row4[0]; ?>" 
												<?php 
												if ($row4[0] == $rowx[0]) {
													echo("selected");
												}
												 ?>
												 >
												 <?php echo $row4[1]; ?></option>
												<?php
												 }
												?>				
											</select>
											</span>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Quantity</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="25" name="quantity" parsley-type="digits" parsley-range="[1, <?= $rowx[11]; ?>]" required 
												<?php 
												if ($rowx[11] < 1) {
													echo("disabled");
												}
												 ?> /> Max Value <?= $rowx[11]; ?>
												<i class="icon-plus blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Customer &nbsp;</label>
											<span class="input-icon">
											<select name="customer">
												<?php
												while($row3 = mysql_fetch_array($result3))
												{
												 ?>
												<option><?php echo $row3[1]; ?></option>
												<?php
												 }
												?>				
											</select>
											</span>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Sell Date</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="YYYY-MM-DD" name="selldate" parsley-type="dateIso" required/>
												<i class="icon-calendar blue"></i>
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Sell from location &nbsp;</label>
											<span class="input-icon">
											<select name="location">
												<?php
												while($row = mysql_fetch_array($result))
												{
												 ?>
												<option><?php echo $row[1]; ?></option>
												<?php
												 }
												?>			
											</select>
											</span>
									</div>

									

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Sell Note</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" placeholder="Type order note here" name="t1"></textarea>
											</span>
										</div>
									</div>
									
									
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												Sell
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
	
                                                                
                                                                </form>
<?php } else {
    echo '';
}
?>