<?php
include('config.php');


        $mysqli->autocommit(FALSE);
    $id=$_GET['invoice_id'];
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
$invoice_date=date("Y-m-d h:i:s");
$log_date=date("Y-m-d h:i:s");

       
        $query=$mysqli->query("delete from invoice where type='invoice' and invoice_id='$id'");
       $query2=$mysqli->query("insert into logs(user,ip,invoice_date,log_date)values('$user','$ipaddress','$invoice_date','$log_date')");
        if($query && $query2){
            
            $mysqli->commit();
            header("Location:dashboard.php?p=customers_listinvoice&Smessage=Deleted");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:dashboard.php?dashboard.php?p=customers_listinvoice&Emessage=Unable to Delete");
        }
        
 