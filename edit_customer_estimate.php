<?php
session_start();

	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}

include('config.php');
if(isset($_POST['invoice_id']) && isset($_POST['invoice_to']) 
     && isset($_POST['job'])  && isset($_POST['deposit'])
 &&  isset($_POST['balance'])      ){
    
    if($_POST['invoice_id'] !="" && $_POST['invoice_to'] !="" && $_POST['user'] !=""
     && $_POST['job'] !=""  && $_POST['deposit'] !=""
 &&  $_POST['balance'] !="" ){
        $mysqli->autocommit(FALSE);
        $id=$_POST['invoice_id'];
        $client_to=$_POST['invoice_to'];
       
        $user=$_POST['user'];
        $paymenttype=$_POST['type_payment'];
        $job=$_POST['job'];
        $deposit=$_POST['deposit'];
        $balance=$_POST['balance'];
        $total=$_POST['total'];
        $user=$_SESSION['user'];
     // Function to get the client IP address

    
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
  


$estimate_date=date("Y-m-d h:i:s");
$log_date=date("Y-m-d h:i:s");
foreach($_POST['quantity'] as $a){
    $id=$_POST['invoice_id'];
        $client_to=$_POST['invoice_to'];
       
        $user=$_POST['user'];
        $paymenttype=$_POST['type_payment'];
        $job=$_POST['job'];
        $deposit=$_POST['deposit'];
        $balance=$_POST['balance'];
        $total=$_POST['gtotal'];
     $inv_id=$_POST['id'];
        $query=$mysqli->query("update invoice set client_to='$client_to',representative='$user'
          ,type_of_payment='$paymenttype',job='$job', deposit='$deposit', balance='$balance',total='$total', quantity='$a' where invoice_id='$id' and id='$inv_id'") or die($mysqli->error);
}
        $query2=$mysqli->query("insert into logs(user,ip,estimate_date,log_date)values('$user','$ipaddress','$estimate_date','$log_date')");
        if($query && $query2){
            
            $mysqli->commit();
            header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Smessage=Estimate Update");
            
        }
        
        else {
            
              $mysqli->rollback();
          //  header("Location:../dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Emessage=Unable to Update Estimate");
        }
        
 } else {
      
     header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Emessage=Please Fill All Details Correct");
 }
    
 }
 
 else {
         
      header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Emessage=Please Fill All Details");
 }
