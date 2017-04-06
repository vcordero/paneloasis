<?php

session_start();

if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}


include 'config.php';

function get_users()
{
	$cmd='select id,user from users where user="'.$_SESSION['user'].'"   ';
	$res=mysql_query($cmd);

	$str='';
	while($row=mysql_fetch_array($res))
	{
		$str .= '<option value="'.$row['user'].'">'.$row['user'].'</option>';
	}

	return $str;
}
function get_categories()
{
	$cmd='select id,cat from cats order by cat ';
	$res=mysql_query($cmd);

	$str='';
	while($row=mysql_fetch_array($res))
	{
		$str .= '<option value="'.$row['cat'].'">'.$row['cat'].'</option>';
	}

	return $str;
}

function get_items()
{
	$cmd='select id,item,itdesc from items order by item ';
	$res=mysql_query($cmd);

	$str="<option value=' '>Please Select</option>";
	while($row=mysql_fetch_array($res))
	{
            $item=$row['item'];
		$str .= "<option value='$item'>".$row['itdesc']."</option>";
	}

	return $str;
}

function get_customers()
{
	$cmd='select * from customers order by customer ';
	$res=mysql_query($cmd);

	$str='';
	while($row=mysql_fetch_array($res))
	{
		$addr = $row['cpname']."<br/>\n". $row['customer']."<br/>\n".$row['baddress']."<br/>\n".$row['phone1'] ."<br/>\n". $row['phone2'] ;
		$str .= '<option value="'.$addr.'">'.$row['customer'].'</option>';
	}

	return $str;
}

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
$query=$mysqli->query('select * from salestax');
$data1=mysqli_fetch_assoc($query);

?>

 <link href="css/bootstrap.css"  rel="stylesheet">
	<script type="text/javascript" src='assets/js/jquery.js'></script> 
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
function invoice(a,b,c,d,e,f){
  
   
    var a = document.getElementById("quantity").value;
     var b=document.getElementById("price").value;
     document.getElementById("total").value=a*b;
    var c= document.getElementById("subtotal").value=a*b;
     var d=document.getElementById("salestax").value= document.getElementById("subtotal").value * <?php echo $data1['sales_tax'];?>;
     var e=document.getElementById("totalbalance").value=c+d ;
     var f=document.getElementById("deposit").value;
     
     document.getElementById("balance").value=e-f;
      document.getElementById("gtotal").value = document.getElementById("balance").value;
     
     
       <?php   
       for($counter=1; $counter<=100; $counter+=6){
        
        ?>
document.getElementsByName("total<?php echo $counter; ?>")[0].value= document.getElementById("quantity<?php echo $counter; ?>").value * document.getElementById("price<?php echo $counter; ?>").value;
    document.getElementById("subtotal").value = Number(document.getElementById("subtotal").value) + Number(document.getElementsByName("total<?php echo $counter; ?>")[0].value ) 
    
     document.getElementById("salestax").value= document.getElementById("subtotal").value * <?php echo $data1['sales_tax'];?>; 
       document.getElementById("totalbalance").value = Number(document.getElementById("subtotal").value) + Number(document.getElementById("salestax").value);
      document.getElementById("balance").value=Number(document.getElementById("totalbalance").value)-Number(document.getElementById("deposit").value);
      document.getElementById("gtotal").value = document.getElementById("balance").value;

      <?php } ?>
           document.getElementById("subtotal").value = document.getElementById("total").value + document.getElementById("total1").value
         
    }
          
  </script>

<script>

function estimate() {
    
     document.getElementById("description").value=document.getElementById("desc").value;
 }
 <?php   
       for($counter=1; $counter<=90; $counter++){
        
        ?>
 function estimate<?php echo $counter;?>(){
    
          document.getElementById("description<?php echo $counter; ?>").value = document.getElementById("desc<?php echo $counter; ?>").value;
}
       <?php } ?>




</script>

          <script>
           

           $(document).ready(function(){
    var counter = 0;
$('#btn').click(function(){
     
     $('#div1').append("<tr><td><input type='text' name='quantity[]' id='quantity"+ (++counter) +"' onkeyup='invoice(this)' ><select  name='quantity_type[]' id='quantitytype' >\n\
<option value=''>--</option><option value='RE'>RE</option><option value='SF'>SF</option></select></td><td>\n\
<input type='text' name='description[]' value='' id='description"+ (++counter-1) +"'><select id='desc"+ (++counter-2) +"' onchange='\estimate"+ (++counter-3) +"(this)' name='desc'><?php echo get_items(); ?></select>\n\
<td><input type='text' name='price[]' id='price"+ (++counter-4) +"' onkeyup='invoice(this)'></td><td><input type='text' name='total"+ (++counter-5) +"' id='total' ></td></tr>");
 });
});


   function changeid ()
   
{
     <?php  for($counter=1; $counter<=100; $counter+=6){ ?>
var e = document.getElementById("quantity<?php echo $counter; ?>");
e.id = "quantity";
return true;
    <?php } ?>
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
<div id="logo">

 
</div>        <form  id="myform" action="invoicesupplier.php" method="post" enctype="multipart/form-data" onsubmit="changeid()">
             <table class="table">
           <div id="invoice_to" class="col-md-6">
            
            From : 
<select name="invoice_to" > <?php echo get_customers(); ?> </select>
<label>Bill No</label>
                 <input type="text" name="billno">
</div>
<div id="invoice_from">

    
</div>
                

        
                
<tr>
	<th> Representative</th>

	<th> Type of Payment</th>
	<th> Quote Date</th>
</tr>

<tr>
	<td><select name="user"><?php echo get_users(); ?></select></td>
	
	<td><input name="type_payment" ></td>
        <td><input name="quote_date" value="<?php echo date('Y-m-d');?>"></td>
</tr>



<tr>
	<th> Quantity</th>
	<th> Description</th>
	<th> Price</th>
	<th> Total</th>
</tr>

<tr>
	
    <td><input name="quantity[]" id="quantity" onkeyup="invoice(this)">&nbsp;&nbsp;<select name="quantity_type[]"><option value="SF">SF</option><option value="RE">RE</option></select></td>
	<td><input name="description[]" id="description" ><select id="desc" name="desc_selector" onchange="estimate(this)"> <?php echo get_items(); ?> </select></td>
        <td><input name="price[]" id="price" onkeyup="invoice(this)" autocomplete="off"></td>
        <td><input name="total" id="total" autocomplete="off" ></td>
</tr>

             </table>         
      <table id="div1" class="table">
   
        </table>            
        <table><tr><td><a class="btn btn-primary" id="btn" style="margin-top:20px;"  >Add More Rows</a></td></tr>         </table>           
    <table class="table"
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
                  <td>Subtotal</td>
                  <td><input type="text" name="subtotal" id="subtotal" onkeyup="invoice(this)" autocomplete="off"></td>
           
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
                  <td>Sales Tax "<?php echo $data1['sales_tax'];?>"</td>
                  <td><input type="text" name="salestax" id="salestax" onkeyup="invoice(this)" autocomplete="off"></td>
           
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
                  <td>Customer Total Balance</td>
                  <td><input type="text" name="totalbalance" id="totalbalance" onkeyup="invoice(this)" autocomplete="off"></td>
           
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
                  <td><input type="text" name="deposit" id="deposit"  onkeyup="invoice(this)" autocomplete="off"></td>
           
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
                  <td><input type="text" name="balance" id="balance" onkeyup="invoice(this)" autocomplete="off"></td>
           
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
                  <td><input type="text" name="gtotal" id="gtotal" autocomplete="off"></td>
                 
               
                  
                </tr>
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
                  <td>Upload Invoice</td>
                
                 
                  <td><input type="file" name="files[]"  multiple="multiple" id="files"></td>    
                  
                </tr>


</tbody>
              
                      

            </table>

    <input type="submit" value="submit" name="submit" class="btn btn-primary" style="float:right; margin-right:30%;">
     
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




