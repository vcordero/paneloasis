<?php
include('config.php');

    function random($length) {
  $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZ";
  $string = "";
  for ($x = 0; $x < $length; $x++):
    $string .= $characters[mt_rand(0, strlen($characters))];
  endfor;
  return $string;
}
 

   $mysqli->autocommit(FALSE);
  $invoiceid= random(5);

  if(isset($_POST['invoice_to']) && isset($_POST['job']) && isset($_POST['balance']) && isset($_POST['gtotal']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['quantity_type']) ){

      if($_POST['invoice_to'] != "" && $_POST['job'] != "" && $_POST['balance'] != "" && $_POST['gtotal'] != "" && $_POST['description'] != "" && $_POST['price'] != "" && $_POST['quantity_type'] != "" ){
        $invoice_to=$_POST['invoice_to'];
        $user=$_POST['user'];
        $job=$_POST['job'];
        $type_payment=$_POST['type_payment'];
        $quote_date=date('Y-m-d');
        $deposit=$_POST['deposit'];
        $balance=$_POST['balance'];
        $total=$_POST['gtotal'];
        $type='estimate';
        $col_total=$_POST['total'];
        $sub_total=$_POST['subtotal'];
        $salestax=$_POST['salestax'];
        $totalbalance=$_POST['totalbalance'];
            
            $description=$_POST['description'];
        $price=$_POST['price'];
        $quantity_type=$_POST['quantity_type'];
         foreach($_POST['quantity'] as $quantity=>$n )  { 
            
            $qty=$n.$quantity_type[$quantity];

            

            $query=  $mysqli->query("insert into invoice(invoice_id,type,client_to,representative,job,type_of_payment,date,quantity,description,price,deposit,balance,total,col_total,subtotal,salestax,total_balance)
                values('$invoiceid','$type','$invoice_to','$user','$job','$type_payment','$quote_date','$qty','$description[$quantity]','$price[$quantity]','$deposit','$balance','$total','$col_total[$quantity]','$sub_total','$salestax','$totalbalance')");
             

            $myquery = $mysqli->query("insert into user_record(invoice_id,invoice_number,user,date,type,description,customer)
                                       values('$invoiceid',0,'$user','$quote_date','$type','$description[$quantity]','$invoice_to')");

         }
        
     
       
     
         
     
 
      

     
    
   

    
  
      if($query) {
           $mysqli->commit();
           header('Location:dashboard.php?p=customers_estimates&Smessage=Database Updated');
       }
       else {
           $mysqli->rollback();
            header('Location:dashboard.php?p=customers_estimates&Emessage=Error');
        
       }
    
    }
      else {
                
         header('Location:dashboard.php?p=customers_estimates&Emessage=Please Fill All Details Correct');
      }


}
else {
            
    header('Location:dashboard.php?p=customers_estimates&Emessage=Please Fill All Details');
}


