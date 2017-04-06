
							
<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"></h3>
		<div class="table-header">
			CVS: Upload Cvs File
		</div>

		<?php if(isset($_GET['message'])):
			if($_GET['message']==0):  ?>
				<div class="alert alert-success text-center" role="alert">
				  successful Upload ..
				</div>
		<?php elseif($_GET['message']==1): ?>
				<div class="alert alert-danger text-center" role="alert">
				  Error Uploading the file ..
				</div>
		<?php endif;endif; ?>
		<form role="form" action="functions/upload_catalog.php" method="post" enctype="multipart/form-data" parsley-validate>
			<!-- Opciones de Subida de Archivo -->
			<div class="col-xs-12" style="margin-bottom:20px;margin-top:20px">
				<div class="col-xs-5">
					<input type="radio" name="type" value="1" checked>Precio A
					<input type="radio" name="type" value="2">Precio B
					<input type="radio" name="type" value="3">Precio C		
				</div>
				<div class="col-xs-5">
					<input type="file" name="file_cvs">	
				</div>
				
				<div class="col-xs-2">
					<button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px">Submit</button>
				</div>
			</div>	
			
			<div class="table-responsive col-xs-12">
				<?php 
					$directorio = 'cvs'; // directorio donde guardo los .cvs
					if(count(glob($directorio.'/*.*'))==0): ?>
						<div class="alert alert-warning text-center" role="alert">
						  Sorry, there are no products ...
						</div>
					<?php  else: ?>
						<table id="sample-table-2" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>
										<i class="icon-archive bigger-110 hidden-480"></i>
										File Name
									</th>
									<th>
										<i class="icon-tags bigger-110 hidden-480"></i>
										Uploaded On
									</th>
									<th>
										<i class="icon-tags bigger-110 hidden-480"></i>
										Type
									</th>
									<th>
										<i class="icon-archive bigger-110 hidden-480"></i>
										Status
									</th>
									
								</tr>
							</thead>

							<tbody>
								
						<?php
							
							foreach(glob($directorio.'/*.*') as $file):
								    $save_file_name=explode("&",$file);
								    $save_file_type=explode("/",$save_file_name[0]); 
							?>
								<tr>
									<td>
									
									<?php echo $save_file_name[2]; ?>
								   </td>
								   <td>
								   <?php echo $save_file_name[1]; ?>
								   </td>
								   <?php if($save_file_type[1]==1): ?>
									   	<td>
									   		Precio A
									   	</td>
								   <?php elseif($save_file_type[1]==2): ?>
									   	<td>
									   		Precio B
									   	</td>
								   <?php elseif($save_file_type[1]==3): ?>
									   	<td>
									   		Precio C
									   	</td>
									<?php endif; ?>
								   
								   <td>Active</td>
								</tr>
							<?php	endforeach ?>

						</tbody>
						</table>
					<?php endif; ?>
			</div>
		</form>
	</div>
</div>
