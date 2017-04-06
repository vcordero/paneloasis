<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where user='$user'");
$data=mysqli_fetch_assoc($query);
if($data['type']=='1'){ 


?>
	
<div class="row">
     <?php  
         if(isset($_GET['Emessage']))
    {
           print "<div class='alert alert-dismissable alert-danger'><a class='close' data-dismiss='alert'>&times;</a>";
           
print $_GET['Emessage'];
     unset($_GET['Emessage']);
  print  "</div>";
    }
          
         if(isset($_GET['Smessage']))
    {
          print "<div class='alert alert-dismissable alert-success'><a class='close' data-dismiss='alert'>&times;</a>";
print $_GET['Smessage'];
     unset($_GET['Smessage']);
  print  "</div>";
    } 
       	  
          ?>
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">User Logs</h3>
										<div class="table-header">
											User Logs
										</div>

										<div class="table-responsive">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Log Date and Time</th>
														
														<th>
														<i class="icon-user bigger-110 hidden-480"></i>
														user</th>
														<th>
														
														<i class="icon-phone bigger-110 hidden-480"></i>
														ip</th>
														<th>
														<i class="icon-file-text bigger-110 hidden-480"></i>
														Estimate Modification Date and Time</th>
                                                                                                                <th>
														<i class="icon-file-text bigger-110 hidden-480"></i>
														Bill Modification Date and Time</th>

														<th><i class="icon-file-text bigger-110 hidden-480"></i>
														Invoice Modification Date and Time</th>
                                                                                                                
                                                                                                                <th><i class="icon-file-text bigger-110 hidden-480"></i>
														Supplier Bill</th>
                                                                                                                <th><i class="icon-file-text bigger-110 hidden-480"></i>
														Supplier Invoice</th>
                                                                                                                
													</tr>
												</thead>

												<tbody>
												<?php
                                                                                                $SqlStat = "SELECT * FROM logs ORDER BY id DESC";
                                                                                                 $result = mysql_query($SqlStat);
												while($row = mysql_fetch_assoc($result))
												{
                                                                                                    
												 ?>
													<tr>
                                                                                                            <td><?php echo $row['log_date']; ?></td>
														<td><?php echo $row['user']; ?></td>
														<td><?php echo $row['ip']; ?></td>
														<td><?php echo $row['estimate_date']; ?></td>
														<td><?php echo $row['bill_date']; ?></td>
														<td><?php echo $row['invoice_date']; ?></td>
                                                                                                                <td><?php echo $row['supplierbill']; ?></td>
                                                                                                                <td><?php echo $row['suplierinvoice']; ?></td>
														
                                                                                                                 

														
															
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
                
<?php } else {
    
    echo '';
}

?>