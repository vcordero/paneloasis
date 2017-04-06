<?php

//session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SqlStat = "SELECT * FROM cats";
$result = mysql_query($SqlStat);

$SqlStat2 = "SELECT * FROM unitmeasure";
$result2 = mysql_query($SqlStat2);

$SqlStat3 = "SELECT * FROM suppliers";
$result3 = mysql_query($SqlStat3);

?>

				<div class="page-header">
							<h1>
								Add New Item
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<form class="form-horizontal" role="form" action="functions/add_item.php" method="post" parsley-validate>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Name</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="Item Name Here" name="item" required/>
												<i class="icon-archive blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Code</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="99mx" name="itcode" required/>
												<i class="icon-barcode blue"></i>
											</span>
										</div>
									</div>
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Quantity</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1"  name="quantity" required/>
												<i class="icon-barcode blue"></i>
											</span>
										</div>
									</div>

									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Unit Cost</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="19.50" name="uncost" parsley-type="number" required/>
												<i class="icon-dollar blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Unit Price</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="20.90" name="unprice" parsley-type="number" required/>
												<i class="icon-dollar blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Category &nbsp;</label>
											<span class="input-icon">
											<select name="cat">
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
										<label class="col-sm-3 control-label no-padding-right">Item Description</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" placeholder="Type item description here" name="t1" required></textarea>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Website</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="http://" name="itweb" parsley-type="url"/>
												<i class="icon-link blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Unite Measure &nbsp;</label>
											<span class="input-icon">
											<select name="unmeasure">
												<option value="">N/A</option>
												<?php
												while($row2 = mysql_fetch_array($result2))
												{
												 ?>
												<option><?php echo $row2[1]; ?></option>
												<?php
												 }
												?>				
											</select>
											</span>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Default Supplier &nbsp;</label>
											<span class="input-icon">
											<select name="supplier">
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
										<label class="col-sm-3 control-label no-padding-right">Item Note</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" placeholder="Type notes here" name="t2"></textarea>
											</span>
										</div>
									</div>
									
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
								</form>