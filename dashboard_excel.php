
							
<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"></h3>
		<div class="table-header">
			Excel: Upload File - This process may take a few minutes.
		</div>

		<?php if(isset($_GET['message'])):
			if($_GET['message']==0):  ?>
				<div class="alert alert-success text-center" role="alert">
				  successful Upload ...
				</div>
		<?php elseif($_GET['message']==1): ?>
				<div class="alert alert-danger text-center" role="alert">
				  Error Uploading the file ...
				</div>
		<?php endif;endif; ?>
		<form role="form" action="functions/upload_excel.php" method="post" enctype="multipart/form-data" parsley-validate>
			
			<div class="col-xs-12" style="margin-bottom:20px;margin-top:20px">
				<div class="col-xs-5">
                    Select the file		
				</div>
				<div class="col-xs-5">
					<input type="file" name="file_xls">
				</div>
				
				<div class="col-xs-2">
					<button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px">Upload</button>
				</div>
			</div>
			
			<div class="table-responsive col-xs-12">
				<?php 
					$directorio = 'xls'; // directorio donde se guardan los archivos excel
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
								</tr>
							</thead>

							<tbody>
								
						<?php
							$directorio = 'xls'; // directorio donde se guardan los archivos excel
							foreach(glob($directorio.'/*.*') as $file):
 							        //$save_file_name=$file;
								    $save_file_name=explode("_",$file);
								    $save_file_date=explode("/",$save_file_name[0]); 
							?>
								<tr>
									<td>
									  <?php echo $save_file_name[1]; ?>
 								    </td>
								    <td>
								      <?php echo $save_file_date[1]; ?>
								    </td>
								</tr>
							<?php	endforeach ?>

						</tbody>
						</table>
					<?php endif; ?>
			</div>
		</form>
	</div>
</div>
