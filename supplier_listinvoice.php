<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';
$userquery=$mysqli->query("select * from users where user='".$_SESSION['user']."'") ; 
$data=mysqli_fetch_assoc($userquery);
$SqlStat = "SELECT * FROM invoice_supplier where type='invoice' ORDER BY id DESC";
$result = mysql_query($SqlStat);

?>
								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">List of pending jobs</h3>
										<div class="table-header">
											Suppliers
										</div>

										<div class="table-responsive">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Invoice ID</th>
														
														<th>
														<i class="icon-user bigger-110 hidden-480"></i>
														Client To</th>
														<th>
														
														<i class="icon-phone bigger-110 hidden-480"></i>
														Representative</th>
														<th>
														<i class="icon-file-text bigger-110 hidden-480"></i>
														Payment Type</th>
                                                                                                                <th>
														<i class="icon-file-text bigger-110 hidden-480"></i>
														Job</th>

														<th><i class="icon-file-text bigger-110 hidden-480"></i>
														Date</th>
                                                                                                                
                                                                                                                <th><i class="icon-file-text bigger-110 hidden-480"></i>
														Deposit</th>
                                                                                                                <th><i class="icon-file-text bigger-110 hidden-480"></i>
														Balance</th>
                                                                                                                <th><i class="icon-file-text bigger-110 hidden-480"></i>
														Total</th>
													</tr>				</thead>

												<tbody>
												<?php
												while($row = mysql_fetch_array($result))
												{
												 
													$originalDate=$row['Date'];
                                                                                                    $newDate = date("d-m-Y", strtotime($originalDate));
												 ?>
													<tr>
                                                                                                            <td><?php echo $row['invoice_id']; ?></td>
														<td><?php echo $row['client_to']; ?></td>
														<td><?php echo $row['representative']; ?></td>
														<td><?php echo $row['type_of_payment']; ?></td>
														<td><?php echo $row['job']; ?></td>
														<td><?php echo $newDate; ?></td>
														
                                                                                                                 <td><?php echo $row['deposit']; ?></td>
                                                                                                                 <td><?php echo $row['balance']; ?></td>
                                                                                                                 <td><?php echo $row['total']; ?></td>

														<td>
																			<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																
																<a class="blue" href="dashboard.php?p=suppliers-bill&invoice_id=<?php echo $row['invoice_id']; ?>">
																	<i class="icon-zoom-in bigger-130"></i>
																</a>
																
<?php if($data['type']=='1'){?>																	
 <script type="text/javascript">
            function deleteBill(){
                
                if (confirm("Do you Really want to Delete This Estimate?"))
  {
  return true;
  }
else
    {
        //document.getElementById('submit').style.visibility = 'visible';

    return false;
    }
}
            
</script>	
<a class="red" href="deletesupplierbill.php?id=<?php echo $row['id']; ?>" onclick="deleteBill();">
																	<i class="icon-trash bigger-130"></i>
																</a>
  <?php } ?>
															</div>
<a class="blue" href="dashboard.php?p=suppliers-bill-invoice&invoice_id=<?php echo $row['invoice_id']; ?>">
																	<i class="icon-eye-open bigger-130"></i>
																</a>
															<div class="visible-xs visible-sm hidden-md hidden-lg">
																<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																		<i class="icon-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																		<li>
																			<a href="dashboard.php?p=view_customer&id=<?php echo $row[0]; ?>" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="icon-zoom-in bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="dashboard.php?p=edit_customer&id=<?php echo $row[0]; ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="icon-edit bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="functions/delete_customer.php?id=<?php echo $row[0]; ?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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

		<!--<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->


		<!-- page specific plugin scripts -->

		<!--<script src="assets/js/jquery.dataTables.min.js"></script>
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
		</script>-->