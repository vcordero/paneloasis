<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SqlStat = "SELECT * FROM sales WHERE id=" . $_SESSION['page'];;
$result = mysql_query($SqlStat);
$row = mysql_fetch_row($result);

?>

				<div class="page-header">
							<h1>
								Sell Details
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<form class="form-horizontal" role="form" action="functions/add_order.php" method="post">

									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Customer</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1"  name="suppliers" value="<?php echo $row[1]; ?>" disabled/>
													<i class="icon-user blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Sell Date</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="issuedate" value="<?php echo $row[2]; ?>" disabled/>
												<i class="icon-calendar blue"></i>
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Sell from location</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1" name="location" value="<?php echo $row[3]; ?>" disabled/>
													<i class="icon-map-marker blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1" name="item" value="<?php echo $row[4]; ?>" disabled/>
													<i class="icon-archive blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Quantity</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="quantity" value="<?php echo $row[5]; ?>" disabled/>
												<i class="icon-plus blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Total Price</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="quantity" value="<?php echo $row[6]; ?>" disabled/>
												<i class="icon-dollar blue"></i>
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Sell Note</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" name="t1" disabled><?php echo $row[7]; ?></textarea>
											</span>
										</div>
									</div>

								</form>