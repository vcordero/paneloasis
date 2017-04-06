<div class="navbar navbar-default" id="navbar">

			<script type="text/javascript">

				try{ace.settings.check('navbar' , 'fixed')}catch(e){}

			</script>



			<div class="navbar-container" id="navbar-container">

				<div class="navbar-header pull-left">

					<a href="#" class="navbar-brand">

						<small>

							<i class="icon-archive"></i>

							

						</small>

					</a><!-- /.brand -->

				</div><!-- /.navbar-header -->



				<div class="navbar-header pull-right" role="navigation">

					<ul class="nav ace-nav">



						<li class="light-blue">

							<a data-toggle="dropdown" href="#" class="dropdown-toggle">

								<img class="nav-user-photo" src="assets/avatars/profile-pic.jpg" alt="Jason's Photo" />

								<span class="user-info">

									<small>Welcome,</small>

									<?= $_SESSION['user'] ?>

								</span>
<?php 
include_once ('config.php');
$userquery=$mysqli->query("select * from users where user='".$_SESSION['user']."'") or die($mysqli->error); 
$data=mysqli_fetch_assoc($userquery);

?>


								<i class="icon-caret-down"></i>

							</a>



							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li>

									<a href="dashboard.php?p=edit_password">

										<i class="icon-lock"></i>

										Edit Password

									</a>

								</li>



								<li class="divider"></li>



								<li>

									<a href="logout.php">

										<i class="icon-off"></i>

										Logout

									</a>

								</li>

							</ul>

						</li>

					</ul><!-- /.ace-nav -->

				</div><!-- /.navbar-header -->

			</div><!-- /.container -->

		</div>



		<div class="main-container" id="main-container">

			<script type="text/javascript">

				try{ace.settings.check('main-container' , 'fixed')}catch(e){}

			</script>



			<div class="main-container-inner">

				<a class="menu-toggler" id="menu-toggler" href="#">

					<span class="menu-text"></span>

				</a>



				<div class="sidebar" id="sidebar">

					<script type="text/javascript">

						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}

					</script>





					<ul class="nav nav-list">

						<li <?= isset($x1) ?>>

							<a href="dashboard.php">

								<i class="icon-dashboard"></i>

								<span class="menu-text"> Dashboard </span>

							</a>

						</li>



						<li <?= isset($xc2) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-exchange"></i>

								<span class="menu-text"> Inventory </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li>
									<a href="list_price_b.php">
										<i class="icon-double-angle-right"></i>
										Products: Price A
									</a>
								</li>
								<li>
									<a href="list_price_b.php">
										<i class="icon-double-angle-right"></i>
										Products: Price B
									</a>
								</li>
								<li>
									<a href="list_price_b.php">
										<i class="icon-double-angle-right"></i>
										Products: Price C
									</a>
								</li>


							</ul>

						</li>

						
<?php if($data['type']=='1'){ ?>
						<li <?= isset($xc4) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-money"></i>

								<span class="menu-text"> Profits </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li <?= isset($x8) ?>>

									<a href="dashboard.php?p=today_profit">

										<i class="icon-double-angle-right"></i>

										Today Profit

									</a>

								</li>

								

								<li <?= isset($x25) ?>>

									<a href="dashboard.php?p=yesterday_profit">

										<i class="icon-double-angle-right"></i>

										Yesterday Profit

									</a>

								</li>



								<li <?= isset($x9) ?>>

									<a href="dashboard.php?p=7days_profit">

										<i class="icon-double-angle-right"></i>

										Last 7 Days Profit

									</a>

								</li>

								

								<li <?= $x23 ?>>

									<a href="dashboard.php?p=this_month_profit">

										<i class="icon-double-angle-right"></i>

										This Month Profit

									</a>

								</li>

								

								<li <?= isset($x26) ?>>

									<a href="dashboard.php?p=last_month_profit">

										<i class="icon-double-angle-right"></i>

										Last Month Profit

									</a>

								</li>

								

								<li <?= isset($x27) ?>>

									<a href="dashboard.php?p=this_year_profit">

										<i class="icon-double-angle-right"></i>

										This Year Profit

									</a>

								</li>

								

							</ul>

						</li>

<?php } ?>

						<li <?= isset($xc3)?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-list"></i>

								<span class="menu-text"> Categories </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li <?= isset($x6) ?>>

									<a href="dashboard.php?p=new_cat">

										<i class="icon-double-angle-right"></i>

										New Category

									</a>

								</li>

<?php if($data['type']=='1') {?>

								<li <?= isset($x7) ?>>

									<a href="dashboard.php?p=cat_list">

										<i class="icon-double-angle-right"></i>

										Categories List

									</a>

								</li>
<?php } ?>
							</ul>

						</li>



						

						<li <?= isset($xc5) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-male"></i>

								<span class="menu-text"> Suppliers </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li <?= isset($x10) ?>>

									<a href="dashboard.php?p=new_supplier">

										<i class="icon-double-angle-right"></i>

										New Supplier

									</a>

								</li>

<?php if($data['type']=='1') {?>

								<li <?= isset($x11) ?>>

									<a href="dashboard.php?p=suppliers_list">

										<i class="icon-double-angle-right"></i>

										Suppliers List

									</a>

								</li>
<?php } ?>
                                                                <li <?= isset($x12) ?>>

									<a href="dashboard.php?p=suppliers_estimates">

										<i class="icon-double-angle-right"></i>

										Make Bill

									</a>

								</li>

                                                                

                                 <li <?= isset($x13) ?>>

									<a href="dashboard.php?p=suppliers_bill">

										<i class="icon-double-angle-right"></i>

										List of Bills

									</a>

								</li>

                                <li <?= isset($x14) ?>>

									<a href="dashboard.php?p=supplierlist_invoice">

										<i class="icon-double-angle-right"></i>

										Supplier Invoices

									</a>

								</li>

							</ul>

						</li>

						

						<li <?= isset($xc6) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-group"></i>

								<span class="menu-text"> Customers </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li <?= isset($x14) ?>>

									<a href="dashboard.php?p=new_customer">

										<i class="icon-double-angle-right"></i>

										New Customer

									</a>

								</li>


<?php if($data['type']=='1') {?>
								<li <?= isset($x15) ?>>

									<a href="dashboard.php?p=customers_list">

										<i class="icon-double-angle-right"></i>

										Customers List

									</a>

								</li>
<?php } ?>
                                <li <?= isset($x16) ?>>

									<a href="dashboard.php?p=customers_estimates">

										<i class="icon-double-angle-right"></i>

										Estimates

									</a>

								</li>

                                <li <?= isset($x17) ?>>

									<a href="dashboard.php?p=customers_listestimates">

										<i class="icon-double-angle-right"></i>

										List of Pendin Jobs

									</a>

								</li>

                                <li <?= isset($x18) ?>>

									<a href="dashboard.php?p=customers_listbill">

										<i class="icon-double-angle-right"></i>

										List of Bills

									</a>

								</li>

                                 <li <?= isset($x18) ?>>

									<a href="dashboard.php?p=customers_listinvoice">

										<i class="icon-double-angle-right"></i>

										List of Invoice

									</a>

								</li>



								<!-- Mi nuevo codigo para busque de clientes -->
								<li <?= isset($x18) ?>>

									<a href="dashboard.php?p=search_client">

										<i class="icon-double-angle-right"></i>

										Search Client

									</a>

								</li>




							</ul>

						</li>
<?php if($data['type']=='1') {?>
						<li <?= isset($xc7) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-bar-chart"></i>

								<span class="menu-text"> Users </span>



								<b class="arrow icon-angle-down"></b>

							</a>

                            <ul class="submenu">
                            	<li <?= isset($newuser) ?>>
									<a href="dashboard.php?p=user_new">
										<i class="icon-double-angle-right"></i>
										New User
									</a>
								</li>

								<li <?= isset($x19) ?>>

									<a href="dashboard.php?p=user_new">

										<i class="icon-double-angle-right"></i>

										New User

									</a>

								</li>

                                <li <?= isset($x20) ?>>

									<a href="dashboard.php?p=user_list">

										<i class="icon-double-angle-right"></i>

										User List and Deleted

									</a>

								</li>

                                 <li <?= $x21 ?>>

									<a href="dashboard.php?p=user_byusers">

										<i class="icon-double-angle-right"></i>

										Invoices by Users

									</a>

								</li>

                                 <li <?= isset($x21) ?>>

									<a href="dashboard.php?p=user_logs">

										<i class="icon-double-angle-right"></i>

										User Logs

									</a>

								</li>

</ul>

                            </li>
<?php } 
 if($data['type']=='1') {

?>
                            <li <?= isset($xc8) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-bar-chart"></i>

								<span class="menu-text"> Payroll </span>



								<b class="arrow icon-angle-down"></b>

							</a>

                            </li>
 <?php } ?>
                              <li <?= isset($xc9) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-bar-chart"></i>

								<span class="menu-text"> Apoinments </span>



								<b class="arrow icon-angle-down"></b>

							</a>

                             <ul class="submenu">

								<li <?= isset($x22) ?>>

									<a href="dashboard.php?p=apointments">

										<i class="icon-double-angle-right"></i>

										New Apointments

									</a>

								</li>

                                </ul>

                            </li>
<?php if($data['type']=='1') {?>
						<li <?= isset($xc10) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-bar-chart"></i>

								<span class="menu-text"> Reports </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li <?= isset($x23) ?>>

									<a href="dashboard.php?p=report_sales">

										<i class="icon-double-angle-right"></i>

										Sales By Customer

									</a>

								</li>

								

								<li <?= isset($x24) ?>>

									<a href="dashboard.php?p=report_supplier">

										<i class="icon-double-angle-right"></i>

										Orders By Supplier

									</a>

								</li>

								

								<li <?= isset($x25) ?>>

									<a href="dashboard.php?p=item_sales">

										<i class="icon-double-angle-right"></i>

										Item Sales

									</a>

								</li>

								

								<li <?= isset($x26) ?>>

									<a href="dashboard.php?p=item_orders">

										<i class="icon-double-angle-right"></i>

										Item Orders

									</a>

								</li>

								

							</ul>

						</li>

<?php } 

if($data['type']=='1') {
?>	

						<li <?= isset($xc7) ?>>

							<a href="#" class="dropdown-toggle">

								<i class="icon-gears"></i>

								<span class="menu-text"> Settings </span>



								<b class="arrow icon-angle-down"></b>

							</a>



							<ul class="submenu">

								<li <?= isset($x27) ?>>

									<a href="dashboard.php?p=settings_general">

										<i class="icon-double-angle-right"></i>

										General

									</a>

								</li>

								

								<li <?= isset($x28) ?>>

									<a href="dashboard.php?p=edit_password">

										<i class="icon-double-angle-right"></i>

										Edit Password

									</a>

								</li>



								<li <?= isset($x29) ?>>

									<a href="dashboard.php?p=settings_shipping">

										<i class="icon-double-angle-right"></i>

										Shipping Carriers

									</a>

								</li>

								

								<li <?= isset($x30) ?>>

									<a href="dashboard.php?p=settings_units">

										<i class="icon-double-angle-right"></i>

										Unit of Measurement

									</a>

								</li>

								

							</ul>

<?php } ?>	

							<li>

								<a href="logout.php">

									<i class="icon-off"></i>

									<span class="menu-text"> Logout </span>

								</a>

							</li>

							

						</li>

						

						<!-- /.nav-list -->



					<div class="sidebar-collapse" id="sidebar-collapse">

						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>

					</div>



					<script type="text/javascript">

						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}

					</script>

				</div>