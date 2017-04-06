<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SqlStat = "SELECT * FROM orders WHERE id=" . $_SESSION['page'];;
$result = mysql_query($SqlStat);
$row = mysql_fetch_row($result);

?>

				<div class="page-header">
							<h1>
								Order Details
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<form class="form-horizontal" role="form" action="functions/add_order.php" method="post">

									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Order Supplier</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1"  name="suppliers" value="<?php echo $row[1]; ?>" disabled/>
													<i class="icon-male blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Issue Date</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="issuedate" value="<?php echo $row[2]; ?>" disabled/>
												<i class="icon-calendar blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Expected Receipt Date</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="receiptdate" value="<?php echo $row[3]; ?>" disabled/>
												<i class="icon-calendar blue"></i>
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Ship to location</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1" name="location" value="<?php echo $row[4]; ?>" disabled/>
													<i class="icon-map-marker blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Tracking Ref #</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="trackref" value="<?php echo $row[5]; ?>" disabled/>
												<i class="icon-barcode blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Shipped By</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1" name="shipby" value="<?php echo $row[6]; ?>" disabled/>
													<i class="icon-fighter-jet blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item</label>
											<div class="col-sm-9">
												<span class="input-icon">
													<input type="text" id="form-field-icon-1" name="item" value="<?php echo $row[7]; ?>" disabled/>
													<i class="icon-archive blue"></i>
												</span>
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Quantity</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="quantity" value="<?php echo $row[8]; ?>" disabled/>
												<i class="icon-plus blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Total Cost</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" name="quantity" value="<?php echo $row[10]; ?>" disabled/>
												<i class="icon-dollar blue"></i>
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Order Note</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" name="t1" disabled><?php echo $row[9]; ?></textarea>
											</span>
										</div>
									</div>

								</form>