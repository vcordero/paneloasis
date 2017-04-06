<?php
include('config.php');


        $mysqli->autocommit(FALSE);
    $id=$_GET['invoice_id'];
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

        $query=$mysqli->query("delete from invoice where type='bill' and invoice_id='$id'");
       $query2=$mysqli->query("insert into logs(user,ip,bill_date,log_date)values('$user','$ipaddress','$bill_date','$log_date')");
        if($query && $query2){
            
            $mysqli->commit();
            header("Location:dashboard.php?p=customers_listbill&Smessage=Deleted");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:dashboard.php?dashboard.php?p=customers_listbill&Emessage=Unable to Delete");
        }
        
 