<?php


	if ($_SESSION['user'] == "") {
	
		header("Location: index.php");
	}

	include 'config.php';

?>


<div class="row">

	<div class="col-xs-11">

		<h3 class="header smaller lighter blue">Search Client</h3>
		
		<div class="table-header">
			Client Data
		</div>


		<div class="table-responsive">
			<table id="client-table" class="table table-striped table-bordered table-hover">
				<thead>

					<tr>						
						<th><i class="icon-file-text bigger-110 hidden-480"></i> ID</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> NUMBER</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> USER</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> TYPE</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> DATE</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> DESCRIPTION</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> CUSTOMER</th>	
						<th><i class="icon-file-text bigger-110 hidden-480"></i> ADDRESS</th>
						<th><i class="icon-file-text bigger-110 hidden-480"></i> PHONE(S)</th>					
					</tr>

				</thead>


				<!-- <tfoot>

					<tr>						
						<th> ID</th>
						<th> INVOICE NO</th>
						<th> USER</th>
						<th> </th>
						<th> </th>
						<th> </th>
						<th> CUSTOMER</th>	
						<th> ADDRESS</th>	
						<th> PHONE</th>				
					</tr>

				</tfoot> -->


				<tbody>

					<?php

						$query_all = $mysqli->query("select * from invoice group by invoice_id");
						while($row_all = $query_all->fetch_assoc())
						{
							
							$customer = $row_all['client_to'];	

							//Obteniendo el la posicion del ultimo caracter del nombre
							$limit_str = $pos = strpos($customer, "<");
							$client_name = substr($customer, 0, $limit_str);

							//Obteniendo la posicion del ultimo caracter de la direccion
							$limit_str_2 = $pos = strpos($customer, '+', $limit_str);
							$client_address = substr($customer, $limit_str + 5 , $limit_str_2 - ($limit_str + 5));

							//Obteniendo el telefono del cliente
							$client_phone = substr($customer, $limit_str_2 );

							$invoice_id = $row_all['invoice_id'];
							$invoice_no = $row_all['invoice_no'];
							$user = $row_all['representative'];
							$type = $row_all['type'];

							$date_tmp = date_create($row_all['Date']);
							$date = date_format($date_tmp,"F jS Y");

							$description = $row_all['description'];												

							echo "<tr>									
									<td>$invoice_id</td>
									<td>$invoice_no</td>
									<td>$user</td>
									<td>$type</td>
									<td>$date</td>		
									<td>$description</td>
									<td>$client_name</td>
									<td>$client_address</td>
									<td>$client_phone</td>
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


	 // $('#client-table tfoot th').each( function () {

	 // 	if($(this).index() != 2 && $(this).index() != 3 && $(this).index() != 4 && $(this).index() != 5)
	 // 	{
	 //        var title = $('#eclient-table thead th').eq( $(this).index() ).text();
	 //        $(this).html( '<div style="background:#bbb;width:160px;"><input type="text" style="margin-left:1px;" placeholder="search..." /></div>' );
	 //    }

  //   } );


	var table = $('#client-table').DataTable({
        "columnDefs": [
            {
                "targets": [ 2 ],
                "visible": false,
                "searchable": false
            },                       
            {
                "targets": [ 3 ],                
                "searchable": false
            },
            {
                "targets": [ 4 ],                
                "searchable": false
            },
            {
                "targets": [ 5 ],                
                "searchable": false
            }

        ]
        
    } );


    // table.columns().eq( 0 ).each( function ( colIdx ) {
    //     $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
    //         table
    //             .column( colIdx )
    //             .search( this.value )
    //             .draw();
    //     } );
    // } );




});

</script>