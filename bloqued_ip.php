<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
    
    header("Location: index.php");
}


include 'config.php';
// Busco todas las Ip' Bloqueadas
$SqlStat = "SELECT * from registeraccess where access_number =3";
$result = mysql_query($SqlStat);

// Desbloquea la ip seleccionada
if(isset($_GET['id'])){
	$SQLSt = "DELETE FROM registeraccess WHERE id = " . $_GET['id'];
	$result = mysql_query($SQLSt);

	header('Location: dashboard.php?p=bloqued_ip');
}
?>
							
<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"></h3>
		<div class="table-header">
			Bloqued IP
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
			
			<div class="table-responsive col-xs-12">
			
					
						<table id="sample-table-2" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>
										<i class="icon-archive bigger-110 hidden-480"></i>
										IP Number
									</th>
									<th>
										<i class="icon-tags bigger-110 hidden-480"></i>
										Access Number
									</th>
									<th>
										<i class="icon-tags bigger-110 hidden-480"></i>
										Site
									</th>
									<th>
										<i class="icon-tags bigger-110 hidden-480"></i>
										Date
									</th>
									<th>
										<i class="icon-tags bigger-110 hidden-480"></i>
										Action
									</th>
									
								</tr>
							</thead>

							<tbody>
							
							<?php while($row = mysql_fetch_array($result)): ?>
								<tr>
									<td><?php echo $row['ip_numer']; ?></td>
									<td><?php echo $row['access_number']; ?></td>
									<?php if($row['site']=='login'): ?>
										<td>Login</td>
									<?php else: ?>
										<td>New Register</td>
									<?php endif; ?>
									<?php $fecha = explode(' ', $row['date'])?>
									<td><?php echo '<b>Date: </b>'.$fecha[0].' '.'<b>Hour: </b>'.$fecha[1]; ?></td>

									<td><a class="blue" href="dashboard.php?p=bloqued_ip&id=<?php echo $row['id']; ?>">Unlock</a></td>
								</tr>
							<?php endwhile; ?>
						
						</tbody>
					</table>
					
			</div>
		</form>
	</div>
</div>
