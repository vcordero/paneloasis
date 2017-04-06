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
$SqlStat = "SELECT distinct invoice_id,invoice_no,representative,Date,type,client_to FROM invoice";
$result = mysql_query($SqlStat);
$num_record = mysql_num_rows($result);
$display=10;
if(isset($_GET['page']))
                {
$currentPage=$_GET['page'];
}
else{
$currentPage = 1;
}


$lastPage = ceil($num_record/$display);

$limitQ = 'LIMIT ' .($currentPage - 1) * $display .',' .$display;
$sql=mysql_query("SELECT distinct invoice_id,invoice_no,representative,Date,type,client_to FROM invoice order by id desc $limitQ");
?>
								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">Invoice by users</h3>
										<div class="table-header">
										Invoice by users	
										</div>

										<div class="table-responsive">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														
                                                                                                                <th>Invoice Number</th>
														
														<th>
														<i class="icon-user bigger-110 hidden-480"></i>
														User</th>
														<th>
														
														<i class="icon-phone bigger-110 hidden-480"></i>
														Date</th>
														<th>
														<i class="icon-file-text bigger-110 hidden-480"></i>
														 Type</th>
                                                        
                                                        <th>
															<i class="icon-file-text bigger-110 hidden-480"></i>
															Customer Name
														</th>

														<th>
															<i class="icon-file-text bigger-110 hidden-480"></i>
															Action
														</th>
														
													</tr>				
												</thead>

												<tbody>
												<?php
												while($row = mysql_fetch_array($sql))
												{
												 
													$originalDate=$row['Date'];
                                                                                                    $newDate = date("d-m-Y", strtotime($originalDate));
												 ?>
													<tr>
                                                                                                            
                                                                                                            <td><?php echo $row['invoice_no']; ?></td>
														
														<td><?php echo $row['representative']; ?></td>
														
														
														<td><?php echo $newDate; ?></td>
														
                                                                                                                 <td><?php echo $row['type']; ?></td>
                                                                                                                
                                                                                                                 <td><?php echo $row['client_to']; ?></td>

														<td>
																			<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																
																<a class="blue" href="dashboard.php?p=customers-estimates&invoice_id=<?php echo $row['invoice_id']; ?>">
																	<i class="icon-zoom-in bigger-130"></i>
																</a>
																
																
 	

																	
															
														</div>

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
                                                                                    
                                                                                    <center>
                   <nav>
  <ul class="pagination">
      <?php if($currentPage>1){ 
print   ' <li>
      <a href="dashboard.php?p=user_byusers&page=1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
      </li>'; 


$previousPage = $currentPage-1;
//echo "<li><a href='storelist.php?page=$previousPage'><</a></li> ";
      }
        $range = 3;
        
        for ($x = ($currentPage - $range); $x < (($currentPage+ $range)  + 1); $x++) {
        // if it's a valid page number...
        if (($x > 0) && ($x <= $lastPage)) {
        // if we're on current page...
            if ($x == $currentPage) {
            // 'highlight' it but don't make a link
                echo '<li class="active"><a href="#">'.$x.'<span class="sr-only">(current)</span></a><li>';
        // if not current page...
        }
        else {
            // make it a link
            echo "<li> <a href='dashboard.php?p=user_byusers&page=$x'>$x</a> </li>";
        } // end else
    } // end if 
} 
 if ($currentPage != $lastPage) {
        // get next page
        $nextpage = $currentPage + 1;
        // echo forward link for next page 
      //  echo "<li> <a href='{$_SERVER['PHP_SELF']}?page=$nextpage'<span aria-hidden='true'>&raquo;</span></a></li> ";
        // echo forward link for lastpage
       echo "<li> <a href='dashboard.php?p=user_byusers&page=$lastPage'<span aria-hidden='true'>&raquo;</span></a> </li>";
     }
?>
   
  </ul>
</nav> </center>
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
}?>


<!-- Funcion para retornar JSON -->
<?php 

	

	if(isset($_GET['json']))
	{
		$query_json = $mysqli->query("select * from user_record where type='estimate'");
		$row_json = $query_json->fetch_assoc();

		echo json_encode($row_json);
	}
	else
	{


?>


<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">Invoice by users</h3>



		<div class="table-header">Invoice by users</div>

		<div class="table-responsive">
			<table id="user-record" class="table table-striped table-bordered table-hover">
				<thead>

					<tr>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> Details</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> User</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> Date</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> Type</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> Description</th>
					</tr>

				</thead>

				<tbody>

					<?php

						// $query_all = $mysqli->query("select * from user_record where type='estimate'");
						// while($row_all = $query_all->fetch_assoc())
						// {
							
						// 	$user = $row_all['user'];
						// 	$date = $row_all['date'];
						// 	$type = $row_all['type'];
						// 	$description = $row_all['description'];

						// 	echo "<tr>
						// 			<td><a href='' class='tooltip-info' data-rel='tooltip' id='view'><span class='blue'><i class='icon-zoom-in bigger-120'></i></span></a></td>
						// 			<td>$user</td>
						// 			<td>$date</td>
						// 			<td>$type</td>
						// 			<td>$description</td>
						// 		  </tr>
								  
						// 	";
						// }

					 ?>

				</tbody>

			</table>
		</div>



	</div>
</div>


<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">

function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.user+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.type+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}



$(document).ready(function() {

	var table = $('#user-record').DataTable({
		"ajax": "dashboard.php?dashboard.php?p=user_byusers&json=true",
		"processing": true,
		"columns": [
            { "data": null },
            { "data": "user" },
            { "data": "date" },
            { "data": "contact.1" },
            { "data": "hr.start_date" },
            { "data": "hr.salary" }
        ]
	});


	$('#user-record tbody').on('click', '#view', function (e) {

		e.preventDefault()

        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );



});


</script>


<?php } ?>