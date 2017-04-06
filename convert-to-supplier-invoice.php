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



if(isset($_GET['invoice_id'])){
    $invoiceid=$_GET['invoice_id'];
}
    $query=$mysqli->query("select * from invoice_supplier where invoice_id='$invoiceid'");
    $data=  mysqli_fetch_assoc($query);


$mysqli->autocommit(FALSE);
               
               if(isset($_POST['convert-to-supplier-invoice'])) {
               $invoice_id=$_POST['invoice_id'];
            $invoice=$_POST['invoice'];
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
$estimate_date=date("Y-m-d h:i:s");
$log_date=date("Y-m-d h:i:s");
if($data['total']=='0'){ 
              $query=$mysqli->query("update invoice_supplier set type='$invoice' where invoice_id='$invoice_id'");
              $query2=$mysqli->query("insert into logs(user,ip,suplierinvoice,log_date)values('$user','$ipaddress','$estimate_date','$log_date')");
              if($query && $query2){
                  $mysqli->commit();
                  header("Location:dashboard.php?p=supplierlist_invoice");
              }
              
              else {
                  $mysqli->rollback();
                  header("Location:dashboard.php?p=convert-to-supplier-invoice&invoice_id=$invoice_id&Emessage=Unable to Convert");
              }
} else {
    
    header("Location:dashboard.php?p=convert-to-supplier-invoice&invoice_id=$invoice_id&Emessage=Please Pay In Full");
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
           <div id="printableArea">
<div id="logo">
Company Logo
 
</div>      
             <table class="table">
           <div id="invoice_to" class="col-md-6" style="float: right;">
            
               To : 
 <?php echo $data['client_to'] ?>
</div>
<div id="invoice_from">
<?php echo get_company(); ?>
   
</div>


        
                
<tr>
	<th> Representative</th>
	<th> Job</th>
	<th> Type of Payment</th>
	<th> Quote Date</th>
</tr>

<tr>
	<td><?php echo $data['representative'] ?></td>
	<td><?php echo $data['job']; ?></td>
	<td><?php echo $data['type_of_payment']; ?></td>
        <td><?php echo $data['Date']; ?></td>
</tr>



<tr>
	<th> Quantity</th>
	<th> Description</th>
	<th> Price</th>
	
</tr>


    <?php 
    $query2=$mysqli->query("select id,invoice_id,quantity,description,price from invoice_supplier where invoice_id='$invoiceid'") or die($mysqli->error);
    while($row=mysqli_fetch_assoc($query2)){
    ?>
	<tr>
    <td><?php echo $row['quantity'];?></td>
	<td><?php echo  $row['description'];?></td>
        <td><?php echo $row['price'];?></td>
       
</tr>
    <?php } ?>
        
             </table>         
                   
    <table class="table">
       
      <?php $query3=$mysqli->query("select id,invoice_id,deposit,balance,total from invoice_supplier where invoice_id='$invoiceid'"); 
      $row1=  mysqli_fetch_assoc($query3);
      
      ?>          
               
                
                <tr>
                    
                   
                 
            <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                    <td></td>
                  <td></td>
                  <td>Deposit</td>
                  <td><?php echo $row1['deposit']; ?></td>
           
                </tr>
                <tr>
                   
                  
            <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                    <td></td>
                  <td></td>
                  <td>Balance</td>
                  <td><?php echo $row1['balance']; ?></td>
           
                </tr>
                <tr>
                    
            <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                    <td></td>
                  <td></td>
                  <td>Total</td>
                  <td><?php echo $row1['total']; ?></td>
                 
                       
                  
                </tr>
               


</tbody>
              
              

            </table>
               
               <form action="convert-to-supplier-invoice.php" method="post" style="float:right; margin-right:20px;">
                   <input type="hidden" value="invoice" name="invoice">
               <input type="hidden" name="invoice_id" value="<?php echo $invoiceid;?>">
               <input type="submit" name="convert-to-supplier-invoice" value="Convert" class="btn btn-primary">
           </form>
</div>
           
           
   <button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="icon-print"></i> Print</button>          



       
       
    

                 
                   
                  
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




