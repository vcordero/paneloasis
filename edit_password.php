<div class="page-header">
<div class="col-sm-9">
	<div class="widget-box">
		<div class="widget-header">
			<h4>Edit Password</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main no-padding">
				<form action="functions/save_password.php" method="post" parsley-validate>
					<!-- <legend>Form</legend> -->

					<fieldset>
						<label>Change Password : </label>

						<input type="password" placeholder="Type new password" name="password" required/>

					</fieldset>
					
					<fieldset>
						<label>Re-type Password : </label>

						<input type="password" placeholder="Re-Type password again" name="repassword" required/>

					</fieldset>

					<div class="form-actions center">
						<button type="submit" class="btn btn-sm btn-success">
							Save
							<i class="icon-arrow-right icon-on-right bigger-110"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
