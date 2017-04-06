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
$_SESSION['user'] ='admin';
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


?>
 <link href="css/bootstrap.css"  rel="stylesheet">
	<script type="text/javascript" src='assets/js/jquery.js'></script> 
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>



         


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

     
  <table class="table">
    
    <div id="invoice_to" class="col-md-6" style="float: right;text-align:right;padding:6px;">
            
        <strong>To:</strong> <?php echo $data['client_to'] ?>
     </div>

     <div id="invoice_from" class="col-md-6">
       <div id="logo">
          <strong>Logo Company</strong>
      </div>   
      <?php echo get_company(); ?>   
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
	<td class="table-cell" ><?php echo $data['type_of_payment']; ?></td>
  <td class="table-cell"><?php echo $data['Date']; ?></td>
</tr>

<tr><td style="background:#ffffff;"></td></tr>

<tr class="header-invoice">
	<th> Quantity</th>
	<th> Description</th>
	<th> Price</th>
	<th> Subtotal</th>
</tr>


    <?php 
    $query2=$mysqli->query("select id,invoice_id,quantity,description,price from invoice_supplier where invoice_id='$invoiceid'") or die($mysqli->error);
    while($row=mysqli_fetch_assoc($query2)){
    ?>
	<tr>
    <td><?php echo $row['quantity'];?></td>
	  <td><?php echo  $row['description'];?></td>
    <td><?php echo $row['price'];?></td>
    <td><?php $subtotal = $row['price'] * $row['quantity']; echo $subtotal;?></td>    
</tr>
    <?php } ?>
        
             
       
      <?php $query3=$mysqli->query("select id,invoice_id,deposit,balance,total from invoice_supplier where invoice_id='$invoiceid'"); 
      $row1=  mysqli_fetch_assoc($query3);
      
      ?>          
               
          <tr>                   
                  
            <td style="background:#ffffff;border:none;"></td>                 
            <td style="background:#ffffff;border:none;"></td>
            <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Deposit</td>
            <td style='background-color: #D1E6E6;' class="table-cell">$ <?php echo $row1['deposit']; ?></td>
           
          </tr>      
           <tr>                   
                  
            <td style="background:#ffffff;border:none;"></td>                 
            <td style="background:#ffffff;border:none;"></td>
            <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Balance</td>
            <td style='background-color: #D1E6E6;' class="table-cell">$ <?php echo $row1['balance']; ?></td>
           
          </tr>    
          <tr>                   
                  
            <td style="background:#ffffff;border:none;"></td>                 
            <td style="background:#ffffff;border:none;"></td>
            <td style="background:#ffffff;text-align:right;font-weight:bold;border:none;">Total</td>
            <td style='background-color: #D1E6E6;' class="table-cell">$ <?php echo $row1['total']; ?></td>
           
          </tr> 






</tbody>
              
                      

            </table>

     



       
       </div>
    

                 
</div></div>         
                  
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




