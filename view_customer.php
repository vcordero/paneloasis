<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';


$SQLsts = 	"SELECT * FROM users WHERE id=" .$_REQUEST['id'];
$result = 	mysql_query($SQLsts);
$row 	= 	mysql_fetch_row($result);
$type 	=	"";
$role 	=	"";

// Identifico el tipo del usuario
 if($row[7]==1): 
    $type 	=	"Admin";
  else:
   $type 	= 	"Customer";
  endif;

// Identifico el rol del usuario
if($row[8]==1): 
    $role 	= 	"Customer A";
  elseif($row[8]==2):
    $role 	= 	"Customer B";
  else:
    $role 	= 	"Customer C";
  endif;

?>

<div class="page-header">
<h1>
	User Details
</h1>
</div><!-- /.page-header -->

<div class="row">
<div class="col-xs-12">

	<form class="form-horizontal" role="form">

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right">User</label>

			<div class="col-sm-9">
				<span class="input-icon">
					<input type="text" id="form-field-icon-1" placeholder="Customer, inc" name="customer" value="<?php echo $row[1]; ?>" disabled/>
					<i class="icon-building blue"></i>
				</span>
			</div>
		</div>

		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right">Email</label>

			<div class="col-sm-9">
				<span class="input-icon">
					<input type="text" id="form-field-icon-1" placeholder="supplier@gmail.com" name="email" value="<?php echo $row[3]; ?>" disabled/>
					<i class="icon-envelope blue"></i>
				</span>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right">Phone</label>

			<div class="col-sm-9">
				<span class="input-icon">
					<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="phone1" value="<?php echo $row[4]; ?>" disabled/>
					<i class="icon-phone blue"></i>
				</span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right">Type</label>

			<div class="col-sm-9">
				<span class="input-icon">
					<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="phone2" value="<?php echo $type; ?>" disabled/>
					<i class="icon-file-text blue"></i>
				</span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right">Role</label>

			<div class="col-sm-9">
				<span class="input-icon">
					<input type="text" id="form-field-icon-1" placeholder="+1 234 567 89" name="fax" value="<?php echo $role; ?>" disabled/>
					<i class="icon-file-text blue"></i>
				</span>
			</div>
		</div>
		

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right">Note</label>

			<div class="col-sm-9">
				<span class="input-icon">
					<textarea class="form-control" id="form-field-8" placeholder="Type customer note here" name="t1" disabled><?php echo $row[6]; ?></textarea>
				</span>
			</div>
		</div>

		</div>
	</form>
								
<?php mysql_close($con); ?>
								