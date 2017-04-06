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
               
    if(isset($_POST['convert-to-invoice'])) {
        $invoice_id=$_POST['invoice_id'];
        $query1=$mysqli->query("select * from invoice where invoice_id='$invoice_id'");
        $data1=  mysqli_fetch_assoc($query1);
        $invoice=$_POST['invoice'];
         
        if($data1['total'] <='0'){ 
            $query=$mysqli->query("update invoice set type='$invoice' where invoice_id='$invoice_id'");


            $description = $data1['description'];
            $invoice_number = $data1['invoice_no'];
            $user=$_SESSION['user'];
            $invoice_to = $data1['client_to'];


            $quote_date=date('Y-m-d');

              //Actualizando el historial del usuario
              $myquery = $mysqli->query("insert into user_record(invoice_id,invoice_number,user,date,type,description,customer)
                                       values('$invoice_id','$invoice_number','$user','$quote_date','invoice','$description','$invoice_to')");


            
              if($query){
                  $mysqli->commit();
                  header("Location:dashboard.php?p=customers_listinvoice");
              }
              
              else {
                  $mysqli->rollback();
                  header("Location:dashboard.php?p=convert-to-invoice&invoice_id=$invoice_id&Emessage=Unable to Convert");
              }
               
        }
           
        else {              
              header("Location:dashboard.php?p=edit_customers_bill&invoice_id=$invoice_id&Emessage=Before to convert this bill Please Pay In Full in this page. Thanks!");
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
  docprint.document.write("<style>#logoImage{display:none;}</style>");

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
<div id="printableArea" class="col-xs-11">  
    
  
  
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

<table class="table">

        
                
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
    $query2=$mysqli->query("select id,invoice_id,quantity,description,price,total_balance,col_total from invoice where invoice_id='$invoiceid'") or die($mysqli->error);
    while($row=mysqli_fetch_assoc($query2)){
    ?>
	<tr>
    <td class="table-cell"><?php echo $row['quantity'];?></td>
	  <td class="table-cell"><?php echo  $row['description'];?></td>
    <td class="table-cell">$ <?php echo $row['price'];?></td>
    <td class="table-cell" style="background-color: #D1E6E6;">$ <?php echo $row['col_total'];?></td>     
    

  </tr>  

    <?php } 

      

    ?>
        
             
      <?php $query3=$mysqli->query("select id,invoice_id,deposit,balance,total_balance,total from invoice where invoice_id='$invoiceid'"); 
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

            <button id="btnPrint" class="btn btn-primary" onclick="printDiv('printableArea')" style="float:left; margin-right:20px;"><i class="icon-print"></i> Print</button> 

               <form action="convert-to-invoice.php" method="post">
                   <input type="hidden" value="invoice" name="invoice">
               <input type="hidden" name="invoice_id" value="<?php echo $invoiceid;?>">
               <input id="btnConvert" type="submit" name="convert-to-invoice" value="Convert" class="btn btn-primary">
           </form>

          </td>                 
          <td style="background:#ffffff;border:none;"></td>
          <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Balance</td>
          <td style='background-color: #D1E6E6;' class="table-cell"><strong>$ <?php echo $row1['total']; ?></sctrong></td>                
                       
                  
        </tr>
               



              
              

            </table>
            <?php if($row1['deposit'] <= 0){echo "<div class='alert alert-dismissable alert-danger'>The customer does not  have complete the deposit. Before convert the bill, you have to complete the deposit and return to this page. Click in Convert to complete the deposit.<a class='close' data-dismiss='alert'>&times;</a></div>";}?>
               
</div>
           
           
            

</div>

       
       
    

                 
                   
                  
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




