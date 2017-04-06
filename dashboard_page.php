<?php


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';
$user=$_SESSION['user'];
$query=$mysqli->query("select * from users where user='$user'");
$data=mysqli_fetch_assoc($query);
if($data['type']=='1'){
$SqlStat = "SELECT * FROM sales ORDER BY id DESC";
$result = mysql_query($SqlStat);
$num_rows = mysql_num_rows($result);

$SqlStat2 = "SELECT * FROM orders";
$result2 = mysql_query($SqlStat2);
$num_rows2 = mysql_num_rows($result2);

$SqlStat3 = "SELECT * FROM items";
$result3 = mysql_query($SqlStat3);
$num_rows3 = mysql_num_rows($result3);

$SqlStat4 = "SELECT * FROM customers";
$result4 = mysql_query($SqlStat4);
$num_rows4 = mysql_num_rows($result4);

$SqlStat5 = "SELECT * FROM suppliers";
$result5 = mysql_query($SqlStat5);
$num_rows5 = mysql_num_rows($result5);

?>

		<div class="col-sm-11 infobox-container">


			<div class="infobox infobox-red  ">
				<div class="infobox-icon">
					<i class="icon-chevron-up"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number"><?= $num_rows ?></span>
					<div class="infobox-content">Sales</div>
				</div>
			</div>
			
			<div class="infobox infobox-red  ">
				<div class="infobox-icon">
					<i class="icon-chevron-down"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number"><?= $num_rows2 ?></span>
					<div class="infobox-content">Orders</div>
				</div>
			</div>
			
			<div class="infobox infobox-red  ">
				<div class="infobox-icon">
					<i class="icon-archive"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number"><?= $num_rows3 ?></span>
					<div class="infobox-content">Items</div>
				</div>
			</div>
			
			<div class="infobox infobox-red  ">
				<div class="infobox-icon">
					<i class="icon-user"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number"><?= $num_rows4 ?></span>
					<div class="infobox-content">Customers</div>
				</div>
			</div>
			
			<div class="infobox infobox-red  ">
				<div class="infobox-icon">
					<i class="icon-male"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number"><?= $num_rows5 ?></span>
					<div class="infobox-content">Suppliers</div>
				</div>
			</div>

			
		</div>
									
		<div class="row">
			<div class="col-xs-12">
				<h3 class="header smaller lighter blue"></h3>
				<div class="table-header">
					Sales
				</div>

				<div class="table-responsive">
					<table id="sample-table-2" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>
								<i class="icon-archive bigger-110 hidden-480"></i>
								Item</th>
								<th>
								<i class="icon-plus bigger-110 hidden-480"></i>
								Quantity</th>
								<th>
								<i class="icon-dollar bigger-110 hidden-480"></i>
								Total Price</th>
								<th>
								<i class="icon-user bigger-110 hidden-480"></i>
								Customer</th>
								<th>
								<i class="icon-calendar bigger-110 hidden-480"></i>
								Sell Date</th>

								<th></th>
							</tr>
						</thead>

						<tbody>
						<?php
						while($row = mysql_fetch_array($result))
						{
						 ?>
							<tr>
								<td><?php echo $row[0]; ?></td>
								<td><?php echo $row[4]; ?></td>
								<td><?php echo $row[5]; ?></td>
								<td><?php echo $row[6]; ?></td>
								<td><?php echo $row[1]; ?></td>
								<td><?php echo $row[2]; ?></td>

								<td>
									<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
										
										<a class="blue" href="dashboard.php?p=view_sell&id=<?php echo $row[0]; ?>">
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
													<a href="dashboard.php?p=view_sell&id=<?php echo $row[0]; ?>" class="tooltip-info" data-rel="tooltip" title="View">
														<span class="blue">
															<i class="icon-zoom-in bigger-120"></i>
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
<?php } else {
    
    echo '';
}						