<?php
include('config.php');


        $mysqli->autocommit(FALSE);
    $id=$_GET['invoice_id'];
        
        $query=$mysqli->query("delete from invoice_supplier where type='bill' and invoice_id='$id'");
       
        if($query){
            
            $mysqli->commit();
            header("Location:dashboard.php?p=suppliers_bill&Smessage=Deleted");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:dashboard.php?dashboard.php?p=suppliers_bill&Emessage=Unable to Delete");
        }
        
 