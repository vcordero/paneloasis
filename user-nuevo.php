
	<div class="page-header">
			<h1>
				Add New User
			</h1>
		</div><!-- /.page-header -->

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
                                                                            <select name="type">
                                                                                <option value="">--Select Level--</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                            </select>
								
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

					