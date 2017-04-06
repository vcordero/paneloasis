<?php

//session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

?>

									<div class="col-sm-9">
										<div class="widget-box">
											<div class="widget-header">
												<h4>Add New Category</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form action="functions/add_cat.php" method="post" parsley-validate>
														<!-- <legend>Form</legend> -->

														<fieldset>
															<label>Category name : </label>

															<input type="text" placeholder="Type category name" name="cat" required/>

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