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
$estimate_date=date("Y-m-d h:i:s");
$log_date=date("Y-m-d h:i:s");

       
        $query=$mysqli->query("delete from invoice where type='estimate' and invoice_id='$id'");
       $query2=$mysqli->query("insert into logs(user,ip,estimate_date,log_date)values('$user','$ipaddress','$estimate_date','$log_date')");
        
        if($query && $query2){
            
            $mysqli->commit();
            header("Location:dashboard.php?p=customers_listestimates&Smessage=Deleted");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:dashboard.php?dashboard.php?p=customers_listestimates&Emessage=Unable to Delete");
        }
        
 