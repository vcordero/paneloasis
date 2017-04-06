<?php

//session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where user='$user'");
$data=mysqli_fetch_assoc($query);
if($data['type']=='1'){ 
    
 

$SqlStat = "SELECT * FROM orders ORDER BY id DESC";
$result = mysql_query($SqlStat);

?>
								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">Orders List</h3>
										<div class="table-header">
											Orders
										</div>

										<div class="table-responsive">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>
														<i class="icon-archive bigger-110 hidden-480"></i>
														Item</th>
														<th>
														<i class="icon-plus bigger-110 hidden-480"></i>
														Quantity</th>
														<th>
														<i class="icon-dollar bigger-110 hidden-480"></i>
														Total Cost</th>
														<th>
														<i class="icon-male bigger-110 hidden-480"></i>
														Supplier</th>
														<th>
														<i class="icon-calendar bigger-110 hidden-480"></i>
														Issue Date</th>
														<th>
														<i class="icon-calendar bigger-110 hidden-480"></i>
														Receipt Date</th>

														<th></th>
													</tr>
												</thead>

												<tbody>
												<?php
												while($row = mysql_fetch_array($result))
												{
												 ?>
													<tr>
														<td><?php echo $row[7]; ?></td>
														<td><?php echo $row[8]; ?></td>
														<td><?php echo $row[10]; ?></td>
														<td><?php echo $row[1]; ?></td>
														<td><?php echo $row[2]; ?></td>
														<td><?php echo $row[3]; ?></td>

														<td>
															<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																
																<a class="blue" href="dashboard.php?p=view_order&id=<?php echo $row[0]; ?>">
																	<i class="icon-zoom-in bigger-130"></i>
																</a>

																<a class="red" href="functions/delete_order.php?id=<?php echo $row[0]; ?>">
																	<i class="icon-trash bigger-130"></i>
																</a>
															</div>

															<div class="visible-xs visible-sm hidden-md hidden-lg">
																<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																		<i class="icon-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																		<li>
																			<a href="dashboard.php?p=view_order&id=<?php echo $row[0]; ?>" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="icon-zoom-in bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="functions/delete_order.php?id=<?php echo $row[0]; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="icon-trash bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</td>
													</tr>
													<?php
													 }
													?> 
													
												</tbody>
											</table>
										</div>
									</div>
								</div>

<?php mysql_close($con); ?>
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->


		<!-- page specific plugin scripts -->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>


		<script type="text/javascript">
			jQuery(function($) {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
<?php }  else {
    
    echo '';
}
?>