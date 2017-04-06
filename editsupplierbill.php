<?php
include('config.php');
 $id=$_POST['id'];
if( isset($_POST['invoice_to']) 
    && isset($_POST['type_payment']) && isset($_POST['job'])  && isset($_POST['deposit'])
 &&  isset($_POST['balance']) && isset($_POST['gtotal'])     ){
    
    if(  !empty($_POST['invoice_to']) 
    && !empty($_POST['type_payment']) && !empty($_POST['job'])  && !empty($_POST['deposit'])
 &&  !empty($_POST['balance']) && !empty($_POST['gtotal'])){
        $mysqli->autocommit(FALSE);
   
        $client_to=$_POST['invoice_to'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $description=$_POST['description'];
        $representative=$_POST['representative'];
        $paymenttype=$_POST['type_payment'];
        $job=$_POST['job'];
        $deposit=$_POST['deposit'];
        $balance=$_POST['balance'];
        $total=$_POST['gtotal'];
        date_default_timezone_set("America/New_York");
$bill_date=date("Y-m-d h:i:s");
$log_date=date("Y-m-d h:i:s");
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

        $query=$mysqli->query("update invoice_supplier set description='$description',quantity='$quantity',price='$price',client_to='$client_to',representative='$representative'
          ,type_of_payment='$paymenttype', job='$job',deposit='$deposit',balance='$balance', total='$total' where invoice_id='$id'");
    
        
        $query2=$mysqli->query("insert into logs(user,ip,supplierbill,log_date)values('$user','$ipaddress','$bill_date','$log_date')");
        if($query){
            
            $mysqli->commit();
            header("Location:dashboard.php?p=edit_supplier_bill&invoice_id=$id&Smessage=Estimate Update");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:dashboard.php?p=edit_supplier_bill&invoice_id=$id&Emessage=Unable to Update Estimate");
        }
        
 } else {
     
     header("Location:dashboard.php?p=edit_supplier_bill&invoice_id=$id&Emessage=Please Fill All Details Correct");
 }
    
 }
 
 else {
     
      header("Location:dashboard.php?p=edit_supplier_bill&invoice_id=$id&Emessage=Please Fill All Details");
 }
