<?php

session_start();

if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}


include 'config.php';
function get_company()
{
	$cmd='select * from company limit 1';
	$res=mysql_query($cmd);

	$str='';
	while($row=mysql_fetch_array($res))
	{
		$str .= $row['cname'] ."<br/>\n" . $row['caddress']."<br/>\n" . $row['phone1']."<br/>\n" . $row['email'];
	}

	return $str;
}


$cmd=$mysqli->query('select * from company limit 1');
$company=mysqli_fetch_assoc($cmd);


if(isset($_GET['invoice_id'])){
    $invoiceid=$_GET['invoice_id'];
}
    $query=$mysqli->query("select * from invoice where invoice_id='$invoiceid'");
    $data=  mysqli_fetch_assoc($query);
     
$mysqli->autocommit(FALSE);
               
               if(isset($_POST['convert-to-bill'])) {                 



               $invoice_id=$_POST['invoice_id'];
               $query1=$mysqli->query("select * from invoice where invoice_id='$invoice_id'");
               $dataitem=mysqli_fetch_assoc($query1);
               $description=$dataitem['description'];
               $invoice_to = $dataitem['client_to'];
               $query2=$mysqli->query("select quantity from items where item='$description'");
           $data1=mysqli_fetch_assoc($query2);
               $bill=$_POST['bill'];

          // $query1=$mysqli->query("select distinct invoice_no from invoice order by id desc limit 2");
          // $row=mysqli_fetch_assoc($query1);
          // $invoice_no=$row['invoice_no'];
          // $inv_no=$invoice_no+1;

            //Funcion para autoincrementar el ultimo registro del invoice_number
            $my_query = $mysqli->query("SELECT MAX( invoice_no + 1 ) AS new_invoice_number FROM invoice WHERE type='bill' or type='invoice' limit 1");
            $fields = mysqli_fetch_assoc($my_query);
            
            if($fields["new_invoice_number"] == null )
            {
                $new_invoice_number = 1;
            }
            else
            {
                $new_invoice_number = $fields["new_invoice_number"];
            }



            $user=$_SESSION['user'];
            $quote_date=date('Y-m-d');

              //Actualizando el historial del usuario
              $myquery = $mysqli->query("insert into user_record(invoice_id,invoice_number,user,date,type,description,customer)
                                       values('$invoice_id','$new_invoice_number','$user','$quote_date','$bill','$description','$invoice_to')");



 
              $query=$mysqli->query("update invoice set invoice_no='$new_invoice_number',type='$bill' where invoice_id='$invoice_id'");
              $rows=mysqli_num_rows($query2);
              if(mysqli_num_rows($query2)>0){


 $quantity=$data1['quantity'];
$quantity1=$dataitem['quantity'];
$quantity2=$quantity-$quantity1;

$qurey3=$mysqli->query("update items set quantity='$quantity2' where item='$description'");
}
              if($query){
                  $mysqli->commit();                  
                 header("Location:dashboard.php?p=customers_listbill");
                 
              }
              
              else {
                  $mysqli->rollback();
                  header("Location:dashboard.php?p=convert-to-bill&invoice_id=$invoice_id&Emessage=Unable to Convert");
              }
            


           }
?>
 <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
	<script type="text/javascript" src='assets/js/jquery.js'></script> 
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
        function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
   //  var originalContents = document.body.innerHTML;

 var docprint=window.open();
   docprint.document.open();
   docprint.document.write('<html><head><title></title>');
 docprint.document.write("<link rel='stylesheet' href='assets/css/bootstrap.min.css'>");
 docprint.document.write("<link rel='stylesheet' href='css/PrintReceipt.css'>"); 
   docprint.document.write("</head><body onLoad='self.print()'>");

    docprint.document.write("<style type='text/css'>table tr:nth-child(odd) td {background-color: #D1E6E6;}table tr:nth-child(even) td {background-color: #f6f6f6;}.header-invoice{background:#6DA4A9;color: #ffffff;}.table-cell{border: solid 1px #bbb;}.table-empty-cell{border: solid 1px #ccc;min-height: 30px;}.table-total-cell{background-color: #D1E6E6;}</style>");
   docprint.document.write("<style>#btnPrint, #btnConvert{display:none;}</style>");

   docprint.document.write(printContents);
   docprint.document.write("</body></html>");
   docprint.document.close();
  // docprint.focus();

}
        </script>


         


       <div id="container">
             <?php  
         if(isset($_GET['Emessage']))
    {
           print "<div class='alert alert-dismissable alert-danger'><a class='close' data-dismiss='alert'>&times;</a>";
           
print $_GET['Emessage'];
     unset($_GET['Emessage']);
  print  "</div>";
    }
          
         if(isset($_GET['Smessage']))
    {
          print "<div class='alert alert-dismissable alert-success'><a class='close' data-dismiss='alert'>&times;</a>";
print $_GET['Smessage'];
     unset($_GET['Smessage']);
  print  "</div>";
    } 
       	  
          ?>

<div class="row">

<div id="printableArea"  class="col-xs-11">
    
  <table class="table">

    <div id="invoice_to" class="col-md-6" style="float: right;text-align:right;padding:6px;">
            
        <strong>To:</strong> <?php echo $data['client_to'] ?>
     </div>

    <div id="invoice_from" class="col-md-6">
       <div id="logo">
          Company Logo
      </div>   
      <?php echo get_company(); ?>   
    </div>

<div id="logoImage" style="position:absolute;margin:20px 0 0 150px; ">
  <img src="<?php echo $company['logo']; ?>" width="110"></img>
</div>

        
                
<tr class="header-invoice">
	<th> Representative</th>
	<th> Job</th>
	<th> Type of Payment</th>
	<th> Quote Date</th>
</tr>

<tr>
	<td class="table-cell"><?php echo $data['representative'] ?></td>
	<td class="table-cell"><?php echo $data['job']; ?></td>
	<td class="table-cell"><?php echo $data['type_of_payment']; ?></td>
  <td class="table-cell"><?php echo $data['Date']; ?></td>
</tr>


<tr><td style="background:#ffffff;"></td></tr>


<tr class="header-invoice">
	<th> Quantity</th>
	<th> Description</th>
	<th> Price</th>
	<th> Sub Total</th>
</tr>


    <?php 
    $query2=$mysqli->query("select id,invoice_id,quantity,description,price,subtotal,col_total from invoice where invoice_id='$invoiceid'") or die($mysqli->error);
    while($row=mysqli_fetch_assoc($query2)){
    ?>
	<tr>
    <td class="table-cell"><?php echo $row['quantity'];?></td>
	   <td class="table-cell"><?php echo  $row['description'];?></td>
    <td class="table-cell"><?php echo $row['price'];?></td>
    <td class="table-cell" style="background-color: #D1E6E6;"><?php echo $row['col_total'];?></td>
       
</tr>
    <?php } 


     

    ?>
        
    
      <?php $query3=$mysqli->query("select id,invoice_id,deposit,balance,total,total_balance from invoice where invoice_id='$invoiceid'"); 
      $row1=  mysqli_fetch_assoc($query3);
      
      ?>          
             
        <tr>                   
                  
          <td style="background:#ffffff;border:none;"></td>                 
          <td style="background:#ffffff;border:none;"></td>
          <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Total</td>
          <td style='background-color: #D1E6E6;' class="table-cell">$ <?php echo $row1['total_balance']; ?></td>
           
        </tr>

        <tr>              
                 
          <td style="background:#ffffff;border:none;"></td>
                  
          <td style="background:#ffffff;border:none;"></td>
          <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Deposit</td>
          <td style='background-color: #D1E6E6;' class="table-cell">$ <?php echo $row1['deposit']; ?></td>
           
        </tr>
        
        <tr>
                    
            
          <td style="background:#ffffff;border:none;">

            <button id="btnPrint" class="btn btn-primary" onclick="printDiv('printableArea')"><i class="icon-print" style="float:left; margin-right:2px;"></i> Print</button> 

             <form action="convert-to-bill.php" method="post" style="float:right; margin-right:20px;">
                   <input type="hidden" value="bill" name="bill">
               <input type="hidden" name="invoice_id" value="<?php echo $invoiceid;?>">
               <input id="btnConvert" type="submit" name="convert-to-bill" value="Convert" class="btn btn-primary">
           </form>

          </td>
          <td style="background:#ffffff;border:none;" ></td>
          <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Balance</td>
          <td style='background-color: #D1E6E6;' class="table-cell">$ <?php echo $row1['total']; ?></td>
                 
                       
                  
        </tr>
               


</tbody>
              
              

            </table>
               
              
</div>
      
           
</div>            



  <style type="text/css">

/* para las filas impares */
table tr:nth-child(odd) td {
    background-color: #D1E6E6;
}

/* para las filas paras */
table tr:nth-child(even) td {
    background-color: #f6f6f6;
}

.header-invoice{
  background:#6DA4A9;
  color: #ffffff;
}

.table-cell{
  border: solid 1px #bbb;
}

.table-empty-cell{
  border: solid 1px #ccc;
  min-height: 30px;  
}

.table-total-cell{
  background-color: #D1E6E6;
}

</style>     
       
    

                 
                   
                  
 <!--<script type="text/javascript"> 
	 $('select[name="desc_selector"]').change(function() {  
								var str = "";

								$( "select[name=desc_selector] option:selected" ).each(function() {

								str += $( this ).text() + " ";

								}); 
								console.log(str);
								$('#description').val(str);  
						})
						.change();
	</script>-->




