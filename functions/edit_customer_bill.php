<?php
session_start();

	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}

include('../config.php');
if(isset($_POST['id']) && isset($_POST['client_to']) 
    && isset($_POST['paymenttype']) && isset($_POST['job'])  && isset($_POST['deposit'])
 &&  isset($_POST['balance']) && isset($_POST['total'])     ){
    
    if(!empty($_POST['id']) && !empty($_POST['client_to']) && !empty($_POST['representative'])
    && !empty($_POST['paymenttype']) && !empty($_POST['job'])  && !empty($_POST['deposit'])
 &&  !empty($_POST['balance']) && !empty($_POST['total'])){
        $mysqli->autocommit(FALSE);
        $id=$_POST['id'];
        $client_to=$_POST['client_to'];
        $representative=$_POST['representative'];
        $paymenttype=$_POST['paymenttype'];
        $job=$_POST['job'];
        $deposit=$_POST['deposit'];
        $balance=$_POST['balance'];
        $total=$_POST['total'];
        $query=$mysqli->query("update invoice set client_to='$client_to' and representative='$representative'
          and type_of_payment='$paymenttype' and job='$job' and deposit='$deposit' and balance='$balance' and total='$total'");
       
        if($query){
            
            $mysqli->commit();
            header("Location:../dashboard.php?p=edit_customers_bill&id=$id&Smessage=Estimate Update");
            
        }
        
        else {
            
              $mysqli->rollback();
            header("Location:../dashboard.php?p=edit_customers_bill&id=$id&Emessage=Unable to Update Estimate");
        }
        
 } else {
     
     header("Location:../dashboard.php?p=edit_customers_bill&id=$id&Emessage=Please Fill All Details Correct");
 }
    
 }
 
 else {
     
      header("Location:../dashboard.php?p=edit_customers_bill&id=$id&Emessage=Please Fill All Details");
 }
