<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SQLsts = "SELECT * FROM suppliers WHERE id=" . $_SESSION['page'];
$result = mysql_query($SQLsts);
$row = mysql_fetch_row($result);

?>

				<div class="page-header">
							<h1>
								Supplier Details
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<form class="form-horizontal" role="form">

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Supplier</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="Supplier, inc" name="supplier" value="<?php echo $row[1]; ?>" disabled/>
												<i class="icon-building blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Contact Person</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="Jane Doe" name="cpname" value="<?php echo $row[2]; ?>" disabled/>
												<i class="icon-male blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Address</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" placeholder="Type location address here" name="t1" disabled><?php echo $row[3]; ?></textarea>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Phone (Primary)</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="phone1" value="<?php echo $row[4]; ?>" disabled/>
												<i class="icon-phone blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Phone (Alternative)</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="phone2" value="<?php echo $row[5]; ?>" disabled/>
												<i class="icon-phone blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Fax</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="fax" value="<?php echo $row[6]; ?>" disabled/>
												<i class="icon-file-text blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Email</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="supplier@gmail.com" name="email" value="<?php echo $row[7]; ?>" disabled/>
												<i class="icon-envelope blue"></i>
											</span>
										</div>
									</div>

									</div>
								</form>
								
<?php mysql_close($con); ?>
								