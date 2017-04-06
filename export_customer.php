
							
<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"></h3>
		<div class="table-header">
			Export Customers
		</div>

		<?php if(isset($_GET['message'])):
			if($_GET['message']==0):  ?>
				<div class="alert alert-success text-center" role="alert">
				  successful Download ..
				</div>
		<?php elseif($_GET['message']==1): ?>
				<div class="alert alert-danger text-center" role="alert">
				  Error Downloading the file ..
				</div>
		<?php endif;endif; ?>
		<form role="form" action="functions/download_customer.php" method="post" enctype="multipart/form-data" parsley-validate>
			<!-- Opciones de Subida de Archivo -->
			<div class="table-responsive col-xs-12">
				
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th colspan="3" class="text-center">
								Select a Category
							</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td style="width:35%"><input type="radio" name="type" value="1" checked>Customer Category A</td>
							<td><input type="radio" name="type" value="2">Customer Category B</td>
							<td><input type="radio" name="type" value="3">Customer Category C</td>
						</tr>
						<tr>
							<th colspan="3" class="text-center">
								Export the File
							</th>
						</tr>
						<tr>
							<td colspan="3" class="text-center"><button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px">Submit</button></td>
						</tr>
					</tbody>
				</table>
			</div>		
		</form>
	</div>
</div>
