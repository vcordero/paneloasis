<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

if($_REQUEST['p'] == "")
{
	$x1 = "class=\"active\"";
	$xc1 = "class=\"active open\"";
}

if($_REQUEST['p'] == "new_item")
{
	$x2 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "order")
{
	$x3 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}


if($_REQUEST['p'] == "sell")
{
	$x5 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "new_cat")
{
	$x6 = "class=\"active\"";
	$xc3 = "class=\"active open\"";
}

if($_REQUEST['p'] == "cat_list")
{
	$x7 = "class=\"active\"";
	$xc3 = "class=\"active open\"";
}

if($_REQUEST['p'] == "today_profit")
{
	$x8 = "class=\"active\"";
	$xc4 = "class=\"active open\"";
}

if($_REQUEST['p'] == "7days_profit")
{
	$x9 = "class=\"active\"";
	$xc4 = "class=\"active open\"";
}

if($_REQUEST['p'] == "this_month_profit")
{
	$x23 = "class=\"active\"";
	$xc4 = "class=\"active open\"";
}

if($_REQUEST['p'] == "last_month_profit")
{
	$x26 = "class=\"active\"";
	$xc4 = "class=\"active open\"";
}

if($_REQUEST['p'] == "yesterday_profit")
{
	$x25 = "class=\"active\"";
	$xc4 = "class=\"active open\"";
}

if($_REQUEST['p'] == "this_year_profit")
{
	$x27 = "class=\"active\"";
	$xc4 = "class=\"active open\"";
}

if($_REQUEST['p'] == "new_supplier")
{
	$x10 = "class=\"active\"";
	$xc5 = "class=\"active open\"";
}
if($_REQUEST['p'] == "suppliers_estimates")
{
	$x11 = "class=\"active\"";
	$xc5 = "class=\"active open\"";
}
if($_REQUEST['p'] == "suppliers_list")
{
	$x11 = "class=\"active\"";
	$xc5 = "class=\"active open\"";
}

if($_REQUEST['p'] == "view_supplier")
{
	$x11 = "class=\"active\"";
	$xc5 = "class=\"active open\"";
}

if($_REQUEST['p'] == "edit_supplier")
{
	$x11 = "class=\"active\"";
	$xc5 = "class=\"active open\"";
}


if($_REQUEST['p'] == "new_customer")
{
	$x12 = "class=\"active\"";
	$xc6 = "class=\"active open\"";
}

if($_REQUEST['p'] == "customers_list")
{
	$x13 = "class=\"active\"";
	$xc6 = "class=\"active open\"";
}

if($_REQUEST['p'] == "edit_customer")
{
	$x13 = "class=\"active\"";
	$xc6 = "class=\"active open\"";
}

if($_REQUEST['p'] == "view_customer")
{
	$x13 = "class=\"active\"";
	$xc6 = "class=\"active open\"";
}

if($_REQUEST['p'] == "settings_general")
{
	$x14 = "class=\"active\"";
	$xc7 = "class=\"active open\"";
}

if($_REQUEST['p'] == "settings_shipping")
{
	$x17 = "class=\"active\"";
	$xc7 = "class=\"active open\"";
}

if($_REQUEST['p'] == "settings_units")
{
	$x18 = "class=\"active\"";
	$xc7 = "class=\"active open\"";
}

if($_REQUEST['p'] == "edit_password")
{
	$x19 = "class=\"active\"";
	$xc7 = "class=\"active open\"";
}

if($_REQUEST['p'] == "orders_list")
{
	$x15 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "sales_list")
{
	$x16 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "items_list")
{
	$x17 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "edit_item")
{
	$x17 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "view_item")
{
	$x17 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "view_order")
{
	$x15 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "view_sell")
{
	$x16 = "class=\"active\"";
	$xc2 = "class=\"active open\"";
}

if($_REQUEST['p'] == "report_sales")
{
	$x19 = "class=\"active\"";
	$xc8 = "class=\"active open\"";
}

if($_REQUEST['p'] == "report_supplier")
{
	$x20 = "class=\"active\"";
	$xc8 = "class=\"active open\"";
}

if($_REQUEST['p'] == "item_sales")
{
	$x21 = "class=\"active\"";
	$xc8 = "class=\"active open\"";
}

if($_REQUEST['p'] == "item_orders")
{
	$x22 = "class=\"active\"";
	$xc8 = "class=\"active open\"";
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>The Greatrock</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
               						

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<!-- ace styles -->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/parsley.js"></script>
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-archive"></i>
							MC Inventory Manager
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
						<li <?= $x1 ?>>
							<a href="dashboard.php">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> Dashboard </span>
							</a>
						</li>

						<li <?= $xc2 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-exchange"></i>
								<span class="menu-text"> Inventory </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x2 ?>>
									<a href="dashboard.php?p=new_item">
										<i class="icon-double-angle-right"></i>
										New Item
									</a>
								</li>
								
								<li <?= $x17 ?>>
									<a href="dashboard.php?p=items_list">
										<i class="icon-double-angle-right"></i>
										Items List
									</a>
								</li>

								<li <?= $x3 ?>>
									<a href="dashboard.php?p=order">
										<i class="icon-double-angle-right"></i>
										Order
									</a>
								</li>
								
								<li <?= $x15 ?>>
									<a href="dashboard.php?p=orders_list">
										<i class="icon-double-angle-right"></i>
										Orders List
									</a>
								</li>


								<li <?= $x5 ?>>
									<a href="dashboard.php?p=sell">
										<i class="icon-double-angle-right"></i>
										Sell
									</a>
								</li>
								
								<li <?= $x16 ?>>
									<a href="dashboard.php?p=sales_list">
										<i class="icon-double-angle-right"></i>
										Sales List
									</a>
								</li>
							
							</ul>
						</li>
						
						<li <?= $xc4 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-money"></i>
								<span class="menu-text"> Profits </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x8 ?>>
									<a href="dashboard.php?p=today_profit">
										<i class="icon-double-angle-right"></i>
										Today Profit
									</a>
								</li>
								
								<li <?= $x25 ?>>
									<a href="dashboard.php?p=yesterday_profit">
										<i class="icon-double-angle-right"></i>
										Yesterday Profit
									</a>
								</li>

								<li <?= $x9 ?>>
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
								
								<li <?= $x26 ?>>
									<a href="dashboard.php?p=last_month_profit">
										<i class="icon-double-angle-right"></i>
										Last Month Profit
									</a>
								</li>
								
								<li <?= $x27 ?>>
									<a href="dashboard.php?p=this_year_profit">
										<i class="icon-double-angle-right"></i>
										This Year Profit
									</a>
								</li>
								
							</ul>
						</li>

						<li <?= $xc3 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text"> Categories </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x6 ?>>
									<a href="dashboard.php?p=new_cat">
										<i class="icon-double-angle-right"></i>
										New Category
									</a>
								</li>

								<li <?= $x7 ?>>
									<a href="dashboard.php?p=cat_list">
										<i class="icon-double-angle-right"></i>
										Categories List
									</a>
								</li>
							</ul>
						</li>

						
						<li <?= $xc5 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-male"></i>
								<span class="menu-text"> Suppliers </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x10 ?>>
									<a href="dashboard.php?p=new_supplier">
										<i class="icon-double-angle-right"></i>
										New Supplier
									</a>
								</li>

								<li <?= $x11 ?>>
									<a href="dashboard.php?p=suppliers_list">
										<i class="icon-double-angle-right"></i>
										Suppliers List
									</a>
								</li>
                                                                <li <?= $x12 ?>>
									<a href="dashboard.php?p=suppliers_estimates">
										<i class="icon-double-angle-right"></i>
										Make Bill
									</a>
								</li>
                                                                
                                 <li <?= $x13 ?>>
									<a href="dashboard.php?p=suppliers_bill">
										<i class="icon-double-angle-right"></i>
										List of Bills
									</a>
								</li>
                                <li <?= $x14 ?>>
									<a href="dashboard.php?p=supplierlist_invoice">
										<i class="icon-double-angle-right"></i>
										Supplier Invoices
									</a>
								</li>
							</ul>
						</li>
						
						<li <?= $xc6 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-group"></i>
								<span class="menu-text"> Customers </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x15 ?>>
									<a href="dashboard.php?p=new_customer">
										<i class="icon-double-angle-right"></i>
										New Customer
									</a>
								</li>

								<li <?= $x16 ?>>
									<a href="dashboard.php?p=customers_list">
										<i class="icon-double-angle-right"></i>
										Customers List
									</a>
								</li>
                                <li <?= $x17 ?>>
									<a href="dashboard.php?p=customers_estimates">
										<i class="icon-double-angle-right"></i>
										Estimates
									</a>
								</li>
                                <li <?= $x18 ?>>
									<a href="dashboard.php?p=customers_listestimates">
										<i class="icon-double-angle-right"></i>
										List of Pendin Jobs
									</a>
								</li>
                                <li <?= $x19 ?>>
									<a href="dashboard.php?p=customers_listbill">
										<i class="icon-double-angle-right"></i>
										List of Bills
									</a>
								</li>
                                 <li <?= $x20 ?>>
									<a href="dashboard.php?p=customers_listinvoice">
										<i class="icon-double-angle-right"></i>
										List of Invoice
									</a>
								</li>
							</ul>
						</li>
						<li <?= $xc7 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-bar-chart"></i>
								<span class="menu-text"> Users </span>

								<b class="arrow icon-angle-down"></b>
							</a>
                            <ul class="submenu">
								<li <?= $x21 ?>>
									<a href="dashboard.php?p=user_new">
										<i class="icon-double-angle-right"></i>
										New User
									</a>
								</li>
                                <li <?= $x22 ?>>
									<a href="dashboard.php?p=user_list">
										<i class="icon-double-angle-right"></i>
										User List and Deleted
									</a>
								</li>
                                 <li <?= $x23 ?>>
									<a href="dashboard.php?p=user_byusers">
										<i class="icon-double-angle-right"></i>
										Invoices by Users
									</a>
								</li>
                                 <li <?= $x24 ?>>
									<a href="dashboard.php?p=user_logs">
										<i class="icon-double-angle-right"></i>
										User Logs
									</a>
								</li>
</ul>
                            </li>
                            <li <?= $xc8 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-bar-chart"></i>
								<span class="menu-text"> Payroll </span>

								<b class="arrow icon-angle-down"></b>
							</a>
                            </li>
                              <li <?= $xc9 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-bar-chart"></i>
								<span class="menu-text"> Apoinments </span>

								<b class="arrow icon-angle-down"></b>
							</a>
                             <ul class="submenu">
								<li <?= $x25 ?>>
									<a href="dashboard.php?p=apointments">
										<i class="icon-double-angle-right"></i>
										New Apointments
									</a>
								</li>
                                </ul>
                            </li>
						<li <?= $xc10 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-bar-chart"></i>
								<span class="menu-text"> Reports </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x26 ?>>
									<a href="dashboard.php?p=report_sales">
										<i class="icon-double-angle-right"></i>
										Sales By Customer
									</a>
								</li>
								
								<li <?= $x27 ?>>
									<a href="dashboard.php?p=report_supplier">
										<i class="icon-double-angle-right"></i>
										Orders By Supplier
									</a>
								</li>
								
								<li <?= $x28 ?>>
									<a href="dashboard.php?p=item_sales">
										<i class="icon-double-angle-right"></i>
										Item Sales
									</a>
								</li>
								
								<li <?= $x29 ?>>
									<a href="dashboard.php?p=item_orders">
										<i class="icon-double-angle-right"></i>
										Item Orders
									</a>
								</li>
								
							</ul>
						</li>
						
						<li <?= $xc7 ?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-gears"></i>
								<span class="menu-text"> Settings </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li <?= $x30 ?>>
									<a href="dashboard.php?p=settings_general">
										<i class="icon-double-angle-right"></i>
										General
									</a>
								</li>
								
								<li <?= $x31 ?>>
									<a href="dashboard.php?p=edit_password">
										<i class="icon-double-angle-right"></i>
										Edit Password
									</a>
								</li>

								<li <?= $x32 ?>>
									<a href="dashboard.php?p=settings_shipping">
										<i class="icon-double-angle-right"></i>
										Shipping Carriers
									</a>
								</li>
								
								<li <?= $x33 ?>>
									<a href="dashboard.php?p=settings_units">
										<i class="icon-double-angle-right"></i>
										Unit of Measurement
									</a>
								</li>
								
							</ul>
							
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

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-chevron-up green home-icon"></i>
								<a href="dashboard.php?p=sell">New Sell</a>
							</li>

							<li>
								<i class="icon-chevron-down green home-icon"></i>
								<a href="dashboard.php?p=order">New Order</a>
							</li>
							
							<li>
								<i class="icon-archive green home-icon"></i>
								<a href="dashboard.php?p=new_item">New Item</a>
							</li>
							
							<li>
								<i class="icon-user green home-icon"></i>
								<a href="dashboard.php?p=new_customer">New Customer</a>
							</li>
							
							<li>
								<i class="icon-male green home-icon"></i>
								<a href="dashboard.php?p=new_supplier">New Supplier</a>
							</li>
							
						</ul><!-- .breadcrumb -->

					</div>

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php
								
								if($_REQUEST['p'] == "")
								{
									include 'dashboard_page.php';
								}
								
								if($_REQUEST['p'] == "new_item")
								{
									include 'new_item.php';
								}
								
								if($_REQUEST['p'] == "items_list")
								{
									include 'items_list.php';
								}
								
								if($_REQUEST['p'] == "order")
								{
									include 'order.php';
								}
								
								if($_REQUEST['p'] == "orders_list")
								{
									include 'orders_list.php';
								}
								
								if($_REQUEST['p'] == "sell")
								{
									$_SESSION['sellitm'] = $_REQUEST['itemid'];
									include 'sell.php';
								}
								
								if($_REQUEST['p'] == "sales_list")
								{
									include 'sales_list.php';
								}
								
								if($_REQUEST['p'] == "new_cat")
								{
									include 'new_cat.php';
								}
								
								if($_REQUEST['p'] == "cat_list")
								{
									include 'cat_list.php';
								}
								
								if($_REQUEST['p'] == "new_location")
								{
									include 'new_location.php';
								}
								
								if($_REQUEST['p'] == "location_list")
								{
									include 'location_list.php';
								}
								
								if($_REQUEST['p'] == "new_supplier")
								{
									include 'new_supplier.php';
								}
								
								if($_REQUEST['p'] == "suppliers_list")
								{
									include 'suppliers_list.php';
								}
								if($_REQUEST['p'] == "suppliers_estimates")
								{
									include 'suppliers_estimates.php';
								}
                                                                
									if($_REQUEST['p'] == "suppliers_invoice")
								{
									include 'suppliers_invoice.php';
								}
								if($_REQUEST['p'] == "suppliers_bill")
								{
									include 'supplier_listbill.php';
								}
                                                                if($_REQUEST['p'] == "suppliers-bill")
								{
									include 'suppliers_bill.php';
								}
                                                                if($_REQUEST['p'] == "edit_supplier_bill")
								{
									include 'edit_supplier_bill.php';
								}
								if($_REQUEST['p'] == "supplierlist_invoice")
								{
									include 'supplier_listinvoice.php';
								}
								if($_REQUEST['p'] == "new_customer")
								{
									include 'new_customer.php';
								}
								
								if($_REQUEST['p'] == "customers_list")
								{
									include 'customers_list.php';
								}
									if($_REQUEST['p'] == "customers_estimates")
								{
									include 'customers_estimates.php';
								}
                                                                if($_REQUEST['p'] == "customers-estimates")
								{
									include 'customers-estimates.php';
								}
									if($_REQUEST['p'] == "customers_listestimates")
								{
									include 'customers_listestimates.php';
								}
								if($_REQUEST['p'] == "customers_bill")
								{
									include 'customers_bill.php';
								}
								if($_REQUEST['p'] == "edit_customers_bill")
								{
									include 'edit_customers_bill.php';
								}
								if($_REQUEST['p'] == "customers_listbill")
								{
									include 'customers_listbill.php';
								}
									if($_REQUEST['p'] == "customers_listinvoice")
								{
									include 'customers_listinvoice.php';
								}
									if($_REQUEST['p'] == "customers_listbill")
								{
									include 'customers_listbill.php';
								}
									if($_REQUEST['p'] == "user_new")
								{
									include 'user_new.php';
								}
									if($_REQUEST['p'] == "user_list")
								{
									include 'user_list.php';
								}
									if($_REQUEST['p'] == "user_byusers")
								{
									include 'user_byusers.php';
								}
								if($_REQUEST['p'] == "apointments")
								{
									include 'apointments.php';
								}
								if($_REQUEST['p'] == "settings_shipping")
								{
									include 'settings_shipping.php';
								}
								
								if($_REQUEST['p'] == "settings_units")
								{
									include 'settings_units.php';
								}
								
								if($_REQUEST['p'] == "edit_password")
								{
									include 'edit_password.php';
								}
								
								if($_REQUEST['p'] == "settings_general")
								{
									include 'settings_general.php';
								}
								
								if($_REQUEST['p'] == "report_sales")
								{
									$_SESSION['customer'] = $_REQUEST['customer'];
									include 'report_sales.php';
								}
								
								if($_REQUEST['p'] == "report_supplier")
								{
									$_SESSION['supplier'] = $_REQUEST['supplier'];
									include 'report_supplier.php';
								}
								
								if($_REQUEST['p'] == "edit_supplier")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'edit_supplier.php';
								}
								
								if($_REQUEST['p'] == "view_supplier")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'view_supplier.php';
								}
								
								if($_REQUEST['p'] == "edit_customer")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'edit_customer.php';
								}
								
								if($_REQUEST['p'] == "view_customer")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'view_customer.php';
								}
								
								if($_REQUEST['p'] == "edit_item")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'edit_item.php';
								}
								
								if($_REQUEST['p'] == "view_item")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'view_item.php';
								}
								
								if($_REQUEST['p'] == "view_order")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'view_order.php';
								}
								
								if($_REQUEST['p'] == "view_sell")
								{
									$_SESSION['page'] = $_REQUEST['id'];
									include 'view_sell.php';
								}
								
								if($_REQUEST['p'] == "item_sales")
								{
									$_SESSION['item'] = $_REQUEST['item'];
									include 'item_sales.php';
								}
								
								if($_REQUEST['p'] == "item_orders")
								{
									$_SESSION['item'] = $_REQUEST['item'];
									include 'item_orders.php';
								}
								
								if($_REQUEST['p'] == "today_profit")
								{
									include 'today_profit.php';
								}
								
								if($_REQUEST['p'] == "7days_profit")
								{
									include '7days_profit.php';
								}
								
								if($_REQUEST['p'] == "this_month_profit")
								{
									include 'this_month_profit.php';
								}
								
								if($_REQUEST['p'] == "last_month_profit")
								{
									include 'last_month_profit.php';
								}
								
								if($_REQUEST['p'] == "yesterday_profit")
								{
									include 'yesterday_profit.php';
								}
								
								if($_REQUEST['p'] == "this_year_profit")
								{
									include 'this_year_profit.php';
								}
								
								?>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		
	</body>
</html>
