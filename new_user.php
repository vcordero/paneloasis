
<div class="page-header">
	<h1>
		Add New User
	</h1>
</div><!-- /.page-header -->
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
		<form class="form-horizontal" role="form" action="functions/add_user.php" method="post" parsley-validate>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Username</label>
				<div class="col-sm-9">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" placeholder="User" name="user" required/>
						<i class="icon-building blue"></i>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Password</label>
				<div class="col-sm-9">
					<span class="input-icon">
                        <input type="password" id="form-field-icon-1" placeholder="Password" name="password" required/>
						<i class="icon-user blue"></i>
					</span>
				</div>
			</div>									
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Phone (Primary)</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" placeholder="234-567-8988" name="phone" required/>
						<i class="icon-phone blue"></i>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Email</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" placeholder="customer@gmail.com" name="email" parsley-type="email" required/>
						<i class="icon-envelope blue"></i>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Level</label>
				<div class="col-sm-9">
					<span class="input-icon">

                        <select id="type" name="type" required>
                            <option value="">-- Select Level --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
						<p class="help-block">Level 1: admin. Level 2: Customer</p>
					</span>
				</div>
			</div>
			
			<div class="form-group" id="category">
				<label class="col-sm-3 control-label no-padding-right">Category</label>
				<div class="col-sm-9">
					<span class="input-icon">
				        <select name="role" >
	                       	<option value="">-- Select Category --</option>
	                       	<option value="1">A</option>
	                       	<option value="2">B</option>
	                       	<option value="3">C</option>
	    	           	</select>
						<p class="help-block">only if the user is a customer.</p>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Note</label>

				<div class="col-sm-9">
					<span class="input-icon">
						<textarea class="form-control" id="form-field-8" placeholder="Comment about User here" name="t3"></textarea>
					</span>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="icon-ok bigger-110"></i>
						Submit
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="icon-undo bigger-110"></i>
						Reset
					</button>
				</div>
			</div>
		</form>
	</div>
</div>