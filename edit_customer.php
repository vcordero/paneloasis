<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';
if (isset($_REQUEST['id'])){
	$SQLsts = "SELECT * FROM users WHERE id=" .$_REQUEST['id'];
	//var_dump($SQLsts);exit();
	$result = mysql_query($SQLsts);
	$row = mysql_fetch_row($result);
}
?>

<div class="page-header">
	<h1>
		Edit User
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
	

		
		<form class="form-horizontal" role="form" action="functions/save_customer.php" method="post" parsley-validate>
			<div class="form-group">
				<?php	if(isset($_REQUEST['Emessage'])):
					$mensaje = $_REQUEST['Emessage']; ?>
						<div class="alert alert-success text-center" role="alert">
					  		User updated successfully
						</div>
				<?php  endif; ?>
				<label class="col-sm-3 control-label no-padding-right">User</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" placeholder="Username"  value="<?php echo $row[1]; ?>" disabled />
						<i class="icon-building blue"></i>
					</span>
				</div>
			</div>
			
			<div class="form-group">
				
			</div>
			<?php

			if (isset($_REQUEST['id'])){
				$_SESSION['newid'] = $_REQUEST['id'];}
			?>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Phone</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="phone" value="<?php echo $row[4]; ?>" required/>
						<i class="icon-phone blue"></i>
					</span>
				</div>
			</div>
			
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Email</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" placeholder="user@gmail.com" name="email" value="<?php echo $row[3]; ?>" parsley-type="email" required/>
						<i class="icon-envelope blue"></i>
					</span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Category</label>
				<div class="col-sm-9">
					<span class="input-icon">
				        <select name="group2">
	                       	<option value="">-- Select Category --</option>
	                       	<?php if($row[8]==1): ?>
	                       		<option value="1" selected>A</option>
	                       	<?php else: ?>
	                       		<option value="1">A</option>
	                       	<?php endif; ?>	
	                       	<?php if($row[8]==2): ?>
	                       		<option value="2" selected>B</option>
	                       	<?php else: ?>
	                       		<option value="2">B</option>
	                       	<?php endif; ?>	
	                       	<?php if($row[8]==3): ?>
	                       		<option value="3" selected>C</option>
	                       	<?php else: ?>
	                       		<option value="3">C</option>
	                       	<?php endif; ?>	
	                       	
	    	           	</select>
					</span>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Note</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<textarea class="form-control" id="form-field-8" placeholder="Type customer note here" name="t3"><?php echo $row[6]; ?></textarea>
					</span>
				</div>
			</div>
			
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="icon-ok bigger-110"></i>
						Save
					</button>

				</div>
			</div>
		</form>
				
<?php mysql_close($con); ?>
								