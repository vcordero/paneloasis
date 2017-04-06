

<?php

//session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}

	include 'config.php';



?>


<div class="row">
	<div class="col-xs-11">
		<h3 class="header smaller lighter blue">Invoice by users</h3>



		<div class="table-header">Invoice by users</div>

		<div class="table-responsive">
			<table id="user-record" class="table table-striped table-bordered table-hover">
				<thead>

					<tr>						
						<th><i class="icon-file-text bigger-110 hidden-480"></i> ID</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> INVOICE NO</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> USER</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> TYPE</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> DATE</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> DESCRIPTION</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> CUSTOMER</th>						
					</tr>

				</thead>

				<tbody>

					<?php

						$query_all = $mysqli->query("select * from user_record");
						while($row_all = $query_all->fetch_assoc())
						{
							
							$invoice_id = $row_all['invoice_id'];
							$invoice_no = $row_all['invoice_number'];
							$user = $row_all['user'];
							$type = $row_all['type'];

							$date_tmp = date_create($row_all['date']);
							$date = date_format($date_tmp,"F jS Y");

							$description = $row_all['description'];	
							$customer = $row_all['customer'];					

							echo "<tr>									
									<td>$invoice_id</td>
									<td>$invoice_no</td>
									<td>$user</td>
									<td>$type</td>
									<td>$date</td>		
									<td>$description</td>
									<td>$customer</td>
								  </tr>
								  
							";
						}

					 ?>

				</tbody>

			</table>
		</div>



	</div>
</div>


<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">



$(document).ready(function() {

	var table = $('#user-record').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 4 }
        ],
        "order": [[ 4, 'desc' ]],        
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(4, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr><td colspan="5" style="font-weight:bold;color:blue;font-size:14px;">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );




});


</script>


