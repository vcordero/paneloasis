
							
<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"></h3>
		<div class="table-header">
			Extra products: Upload File
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
		<?php elseif($_GET['message']==2): ?>
				<div class="alert alert-success text-center" role="alert">
				  successful Delete ...
				</div>
		<?php endif;endif;?>
		<form role="form" action="functions/upload_extraproducts.php" method="post" enctype="multipart/form-data" parsley-validate>
			
			<div class="col-xs-12" style="margin-bottom:20px;margin-top:20px">
				<div class="col-xs-2">
                    Select the file		
				</div>
				<div class="col-xs-5">
					<input type="file" name="file_xls">
				</div>
				
				<div class="col-xs-1">
					<button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px">Load</button>
				</div>

				<div class="col-xs-2">
                    <a href="xlssample/PRODUCTEXTRA SAMPLE-1.xls">Download Sample</a>			
                    <!--<button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px" name="SAMPLE-1" id="s1">Sample 1</button>-->
				</div>

				<!--<div class="col-xs-2">
					<button type="submit" class="btn btn-primary" style="border-radius:9px;padding:0 12px" name="SAMPLE-2">Sample 2</button>
					<a href="xlssample/PRODUCTEXTRA SAMPLE-2.xls">Download Sample 2</a>
				</div>-->
			</div>
			
			<div class="table-responsive col-xs-12">
				<?php 
					$directorio = 'xlsextra'; // directorio donde se guardan los archivos excel
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
										Option
									</th>
								</tr>
							</thead>

							<tbody>
								
						<?php
							$directorio = 'xlsextra'; // directorio donde se guardan los archivos excel
							foreach(glob($directorio.'/*.*') as $file):
 							        //$save_file_name=$file;
								    $file_delete = explode("/",$file);
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
								    <td>
								      <a href="functions/upload_extraproducts.php?p=<?php echo($file_delete[1])?>">Delete</a>
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
