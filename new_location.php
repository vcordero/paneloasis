<?php

//session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

?>

									<div class="col-sm-9">
										<div class="widget-box">
											<div class="widget-header">
												<h4>Add New Location</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form action="functions/add_location.php" method="post" parsley-validate>
														<!-- <legend>Form</legend> -->

														<fieldset>
															<label>Location </label>

															<input type="text" placeholder="Type location name" name="location" required/>

														</fieldset>
														
														<fieldset>
															<label for="form-field-9">Address</label>

															<textarea class="form-control" id="form-field-8" placeholder="Type location address here" name="t1" required></textarea>
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