<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SQLsts = "SELECT * FROM items WHERE id=" . $_SESSION['page'];
$result = mysql_query($SQLsts);
$row = mysql_fetch_row($result);

$SqlStat2 = "SELECT * FROM cats";
$result2 = mysql_query($SqlStat2);

$SqlStat3 = "SELECT * FROM unitmeasure";
$result3 = mysql_query($SqlStat3);

$SqlStat4 = "SELECT * FROM suppliers";
$result4 = mysql_query($SqlStat4);

?>

				<div class="page-header">
							<h1>
								Edit Item
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<form class="form-horizontal" role="form" action="functions/save_item.php?id=<?= $_SESSION['page']; ?>" method="post" parsley-validate>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Name</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="Item Name Here" name="item" value="<?php echo $row[1]; ?>" required/>
												<i class="icon-archive blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Code</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="99mx" name="itcode" value="<?php echo $row[2]; ?>" required/>
												<i class="icon-barcode blue"></i>
											</span>
										</div>
									</div>

									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Unit Cost</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="19.50" name="uncost" value="<?php echo $row[3]; ?>" parsley-type="number" required/>
												<i class="icon-dollar blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Unit Price</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="20.90" name="unprice" value="<?php echo $row[4]; ?>" parsley-type="number" required/>
												<i class="icon-dollar blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Category &nbsp;</label>
											<span class="input-icon">
											<select name="cat">
												<option><?php echo $row[5]; ?></option>
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
										<label class="col-sm-3 control-label no-padding-right">Item Description</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<textarea class="form-control" id="form-field-8" placeholder="Type item description here" name="t1" required><?php echo $row[6]; ?></textarea>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Item Website</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1" placeholder="http://" name="itweb" value="<?php echo $row[7]; ?>" parsley-type="url"/>
												<i class="icon-link blue"></i>
											</span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Unite Measure &nbsp;</label>
											<span class="input-icon">
											<select name="unmeasure">
												<option ><?php echo $row[8]; ?></option>
												<option >N/A</option>
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
										<label class="col-sm-3 control-label no-padding-right">Default Supplier &nbsp;</label>
											<span class="input-icon">
											<select name="supplier">
												<option ><?php echo $row[9]; ?></option>
												<?php
												while($row4 = mysql_fetch_array($result4))
												{
												 ?>
												<option><?php echo $row4[1]; ?></option>
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
												<textarea class="form-control" id="form-field-8" placeholder="Type notes here" name="t2"><?php echo $row[10]; ?></textarea>
											</span>
										</div>
									</div>
									
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												Save
											</button>

										</div>
									</div>
								</form>