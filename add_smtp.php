
<div class="page-header">
	<h1>
		SMTP configuration
	</h1>
</div><!-- /.page-header -->
<?php

if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

    $SQLsts1="SELECT * FROM smtp_config WHERE id='1'";
	$result2 = mysql_query($SQLsts1);
    $row = mysql_fetch_array($result2);

?>
<?php
    
	if(isset($_GET['message'])):
		$mensaje = $_GET['message'];
		if ($mensaje == "1"): ?>
			<div class="alert alert-success text-center" role="alert">
		  		The user is registered correctly.
			</div>
  	<?php elseif($mensaje == "2"): ?>
			<div class="alert alert-danger text-center" role="alert">
				Error: User Already Exists, try another.					
			</div>
	<?php elseif($mensaje == "3"): ?>
			<div class="alert alert-danger text-center" role="alert">
				Error: User Already Exists, try another.					
			</div>
	<?php
		endif;
	endif;
    
?>
<div class="row">
	<div class="col-xs-12">
		<form class="form-horizontal" role="form" action="functions/add_smtp_config.php" method="post" name="frm_SMTPCONFIG" id="frm_SMTPCONFIG" parsley-validate>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Host Name</label>
				<div class="col-sm-9">
					<span class="input-icon">
						<input style="width: 300px;padding-right: 10px !important;" type="text" id="form-field-icon-1" placeholder="Host Name" name="host_name" value="<?php echo $row[1]; ?>" required/>
						<i class="icon-home blue"></i>
					</span>
				</div>
			</div>
												
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Port</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input style="width: 300px;padding-right: 10px !important;" type="text" id="form-field-icon-1" placeholder="00" value="<?php echo $row[2]; ?>" name="port" required/>
						<i class="icon- blue"></i>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">From E-Mail</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input style="width: 300px;padding-right: 10px !important;" type="text" id="form-field-icon-1" placeholder="customer@gmail.com" value="<?php echo $row[4]; ?>" name="from_email" parsley-type="email" required/>
						<ul id="email_validations_u" class="parsley-error-list" style="display: none;">
                            <li class="type" id="email_validations_li">
                                This value should be a valid email.
                            </li>
                        </ul>
                        <i class="icon-envelope blue"></i>
					</span>
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">To Admin</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input style="width: 300px;padding-right: 10px !important;" type="text" id="form-field-icon-1" placeholder="customer@gmail.com" value="<?php echo $row[5]; ?>" name="to_admin" parsley-type="email" required/>
                        <ul id="email_validations_ul" class="parsley-error-list" style="display: none;">
                            <li class="type" id="email_validations_li">
                                This value should be a valid email.
                            </li>
                        </ul>
						<i class="icon-envelope blue"></i>
					</span>
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">From Name</label>
				<div class="col-sm-9">
					<span class="input-icon">
						<input style="width: 300px;padding-right: 10px !important;" type="text" id="form-field-icon-1" placeholder="Name" value="<?php echo $row[6]; ?>" name="from_name" required/>
						<i class="icon-user blue"></i>
					</span>
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Username</label>
				<div class="col-sm-9">
					<span class="input-icon">
						<input style="width: 300px;padding-right: 10px !important;" type="text" id="form-field-icon-1" placeholder="User" value="<?php echo $row[9]; ?>" name="user_name" required/>
						<i class="icon-user blue"></i>
					</span>
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Password</label>
				<div class="col-sm-9">
					<span class="input-icon">
                        <input style="width: 300px;padding-right: 10px !important;" type="password" id="form-field-icon-1" value="<?php echo $row[10]; ?>" placeholder="Password" name="password" required/>
						<i class="icon-key blue"></i>
					</span>
				</div>
			</div>
			<!--div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Level</label>
				<div class="col-sm-9">
					<span class="input-icon">

                        <select id="type" name="type" required>
                            <option value="">-- Select Level --</option>
                            <!--option value="1">1</option>
                            <option value="2">2</option>
                        </select>
						<p class="help-block">Level 1: admin. Level 2: Customer</p>
					</span>
				</div>
			</div-->
			
			<!--div class="form-group" id="category">
				<label class="col-sm-3 control-label no-padding-right">Category</label>
				<div class="col-sm-9">
					<span class="input-icon">
				        <select name="role" >
	                       	<option value="">-- Select Category --</option>
	                       	<!--option value="1">A</option>
	                       	<option value="2">B</option>
	                       	<option value="3">C</option>
	    	           	</select>
						<p class="help-block">only if the user is a customer.</p>
					</span>
				</div>
			</div-->
			<!--div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Note</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<textarea class="form-control" id="form-field-8" placeholder="Comment about User here" name="t3"></textarea>
					</span>
				</div>
			</div-->
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit" onclick="return checkEmailAddresses();">
						<i class="icon-ok bigger-110"></i>
						Submit
					</button>
					&nbsp; &nbsp; &nbsp;
					<!--button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i>
						Reset
					</button-->
				</div>
			</div>
		</form>
	</div>
</div>