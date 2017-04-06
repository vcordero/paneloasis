<?php
session_start();

	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}

include('config.php');
if(isset($_POST['invoice_id']) && isset($_POST['invoice_to']) 
     && isset($_POST['job'])  && isset($_POST['deposit'])
 &&  isset($_POST['balance'])      ){
    
    if($_POST['invoice_id'] !="" && $_POST['user'] !="" && $_POST['job'] !=""  && $_POST['deposit'] !="" ){
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
  

date_default_timezone_set("America/New_York");
$bill_date=date("Y-m-d h:i:s");
$log_date=date("Y-m-d h:i:s");

        $client_to=$_POST['invoice_to'];
       // $quantity=$_POST['quantity'];
         $user=$_POST['user'];
        $paymenttype=$_POST['type_payment'];
        $job=$_POST['job'];
        $deposit=$_POST['deposit'];
        $balance=$_POST['balance'];
        $total=$_POST['gtotal'];
        $price=$_POST['price'];
        $description=$_POST['description'];
foreach($_POST['quantity'] as $a=>$n){
    
  $inv_id=$_POST['id'];

        $desc = $description[$a];
        $pric = $price[$a];

        $query=$mysqli->query("update invoice set client_to='$client_to',representative='$user'
          ,type_of_payment='$paymenttype',job='$job', deposit='$deposit', balance='$balance',total='$total',description='$desc', price='$pric',quantity='$n' where invoice_id='$id' and id='$inv_id'");

        
}
        $query2=$mysqli->query("insert into logs(invoice_id,user,ip,bill_date,log_date)values('$id','$user','$ipaddress','$bill_date','$log_date')") or die($mysqli->error);
        if($query && $query2){
            
            $mysqli->commit();
         header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Smessage=Estimate Update");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Emessage=Unable to Update Estimate");
        }
        
 } else {
      

      $id = $_POST["user"];
     header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Emessage=Please Fill All Details Correct&inv=$id");
 }
    
 }
 
 else {
         
      header("Location:dashboard.php?p=edit_customers_bill&invoice_id=".$_POST['invoice_id']."&Emessage=Please Fill All Details");
 }
