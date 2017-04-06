

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
						<th><i class="icon-file-text bigger-110 hidden-480"></i> DETAILS</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> USER</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> TYPE</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> DATE</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> CUSTOMER</th>						
					</tr>

				</thead>

				<tbody>

					<?php

						// $query_all = $mysqli->query("select * from user_record where type='estimate'");
						// while($row_all = $query_all->fetch_assoc())
						// {
							
						// 	$invoice_id = $row_all['invoice_id'];
						// 	$user = $row_all['user'];
						// 	$date = $row_all['date'];
						// 	$type = $row_all['type'];							

						// 	echo "<tr>
						// 			<td><a href='' class='tooltip-info' data-rel='tooltip' id='view'><span class='blue'><i class='icon-zoom-in bigger-120'></i></span></a></td>
						// 			<td>$invoice_id</td>
						// 			<td>$type</td>
						// 			<td>$user</td>
						// 			<td>$date</td>									
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

	    
    $.get( "json_user_record.php?invoice_id="+d.invoice_id, function( data ) {
    	$( "#detail" ).html('');
	  	$( "#detail" ).html(data);	  
	});

	return '<div id="detail"><strong>LOADING DATA...</strong></div>';
}



$(document).ready(function() {

	var table = $('#user-record').DataTable(
	{
		"ajax": "json_user_record.php?json=true",
		"proccessing":true,
		"columns": [
            {                
                "orderable":      false,
                "data":           null,
                "defaultContent": "<a href='' class='tooltip-info' data-rel='tooltip' id='view'><span class='blue'><i class='icon-zoom-in bigger-120'></i></span></a>"
            },
            { "data": "user" },
            { "data": "type" },
            { "data": "date" },
            { "data": "customer" }
        ]
	});


	$('#user-record tbody').on('click', '#view', function (e) {

		e.preventDefault()

        var tr = $(this).closest('tr');              
        var row = table.row(tr);
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data())).show();
            tr.addClass('shown');
        }
    } );



});


</script>


