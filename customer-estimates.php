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
    $query=$mysqli->query("select * from invoice where invoice_id='$invoiceid'");
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
<div id="logo">
Company Logo
 
</div>        <form  id="myform" action="invoice.php" method="post" onsubmit="changeid()">
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
    $query2=$mysqli->query("select id,invoice_id,quantity,description,price from invoice where invoice_id='$invoiceid'") or die($mysqli->error);
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
       
      <?php $query3=$mysqli->query("select id,invoice_id,deposit,balance,total from invoice where invoice_id='$invoiceid'"); 
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

     
</form>


       
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




