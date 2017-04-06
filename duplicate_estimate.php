<?php

if(isset($_GET["invoice_id"]))
{
	$invoice_id = $_GET["invoice_id"];

	$new_invoiceid = $invoice_id."-DU";

	$query =$mysqli->query("insert into invoice select '',invoice_no,CONCAT(invoice_id,'-DU') as invoice_id,type,unit_id,client_to,representative,type_of_payment,Date,quantity,description,price,deposit,balance,total,job,col_total,subtotal,salestax,total_balance from invoice where invoice_id='$invoice_id'");
	if($query)
	{
		header("Location:dashboard.php?p=customers_listestimates");
	}
	else
	{
		echo "<div class='alert alert-dismissable alert-danger'>".$mysqli->error."<a class='close' data-dismiss='alert'>&times;</a>";
	}
}