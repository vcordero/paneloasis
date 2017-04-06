<?php

//session_start();

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
	$cmd='select * from items order by item ';
	$res=mysql_query($cmd);

	$str="<option value=' '>Please Select</option>";
  

	while($row=mysql_fetch_array($res))
	{
            $item=$row['item'];
		$str .= "<option value='$item'>".$row['item']."</option>";     
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

$cmd=$mysqli->query('select * from company limit 1');
$company=mysqli_fetch_assoc($cmd);

$query=$mysqli->query('select * from salestax');
$data=mysqli_fetch_assoc($query);


?>

<input type="hidden" id="tax_val" value="<?php echo $data['sales_tax'];?>"/>


 <link href="css/bootstrap.css"  rel="stylesheet">
	<script type="text/javascript" src='assets/js/jquery.js'></script> 
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
function invoice(a,b,c,d,e,f){
  
   
    var a = document.getElementById("quantity").value;
     var b=document.getElementById("price").value;
     document.getElementById("total").value=a*b;
    var c= document.getElementById("subtotal").value=a*b;

    var subtotal = document.getElementById("subtotal").value;
    var tax = <?php echo $data['sales_tax'];?>;

    var total_tax = subtotal * tax;

     var d=document.getElementById("salestax").value= parseFloat(total_tax).toFixed(2);

     var balance = c + d;

     var e=document.getElementById("totalbalance").value=parseFloat(balance).toFixed(2);
     var f=document.getElementById("deposit").value;
     
     document.getElementById("balance").value=e-f;
      document.getElementById("gtotal").value = document.getElementById("balance").value;
      
     
       <?php   
       for($counter=1; $counter<=99; $counter++){
        
        ?>
document.getElementById("total<?php echo $counter; ?>").value= document.getElementById("quantity<?php echo $counter; ?>").value * document.getElementById("price<?php echo $counter; ?>").value;
    document.getElementById("subtotal").value = Number(document.getElementById("subtotal").value) + Number(document.getElementById("total<?php echo $counter; ?>").value );     
    
      var sub = document.getElementById("subtotal").value;
      var tax1 = <?php echo $data['sales_tax'];?>;
      total_tax1 = sub * tax1;

     document.getElementById("salestax").value= parseFloat(total_tax1).toFixed(2); 

     var balance1 = Number(document.getElementById("subtotal").value) + Number(document.getElementById("salestax").value);
       document.getElementById("totalbalance").value = parseFloat(balance1).toFixed(2);

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
          document.getElementById("price<?php echo $counter; ?>").value = prices[document.getElementById("desc<?php echo $counter; ?>").value]
}
       <?php } ?>




</script>


          
          <script>
           
            var counter = 0;

           $(document).ready(function(){
    

    $('#btn').click(function(){

      ++counter;
     
     $('#div1').append("<tr style='border-top:none;' id='row-"+counter+"'><td><input type='text' name='description[]' value='' id='description"+ (counter) +"'><select id='desc"+ (counter) +"' onchange='\estimate"+ (counter) +"(this)' name='desc'><?php echo get_items(); ?></select></td>\n\
      <td><input type='text' name='quantity[]' id='quantity"+ (counter) +"' onkeyup='invoice(this)' ><select  name='quantity_type[]' id='quantitytype' >\n\
    <option value=''>--</option><option value='RE'>RE</option><option value='SF'>SF</option></select></td>\n\
    <td><input type='text' name='price[]' id='price"+ (counter) +"' onkeyup='invoice(this)'></td><td><input type='text' name='total[]' id='total"+ (counter) +"' ><button class='del-row' style='margin-left:4px;padding:1px;' id='delete-"+counter+"'><span class='red'><i class='icon-trash bigger-120'></i></span></button></td></tr>");
 });

$('#btn_1').click(function(){
     
     $('#div1').append("<tr><td><input type='text' name='quantity[]' id='quantity"+ (++counter) +"' onkeyup='invoice(this)' ><select  name='quantity_type[]' id='quantitytype' >\n\
<option value=''>--</option><option value='RE'>RE</option><option value='SF'>SF</option></select></td>\n\
<td><input type='text' name='description[]' value='' id='description"+ (++counter-1) +"'><select id='desc"+ (++counter-2) +"' onchange='\estimate"+ (++counter-3) +"(this)' name='desc'><?php echo get_items(); ?></select></td>\n\
<td><input type='text' name='price[]' id='price"+ (++counter-4) +"' onkeyup='invoice(this)'></td><td><input type='text' name='total[]' id='total"+ (++counter-5) +"' ></td></tr>");
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
<div id="logo" style="position:absolute;margin:10px 150px;">
<img src="<?php echo $company['logo']; ?>" width="110"></img>
 
</div>        

<div id="invoice_from">
<?php echo get_company(); ?>
   
</div>

<form  id="myform" action="invoice.php" method="post" onsubmit="changeid()">

<div id="invoice_to" style="float:right;margin:-45px 20px 12px 0;">            
    To: <select name="invoice_to" > <?php echo get_customers(); ?> </select>
</div>



<table class="table" id="div1" border="0">
           


        
                
<tr style="background:#D1E6E6;">
	<th> Representative</th>
	<th> Job</th>
	<th> Type of Payment</th>
	<th> Quote Date</th>
</tr>

<tr>
	<td><select name="user"><?php echo get_users(); ?></select></td>
	<td><select name="job"><?php echo get_categories(); ?></select></td>
	<td><input name="type_payment" ></td>
        <td><input name="quote_date" value="<?php echo date('Y-m-d');?>"></td>
</tr>



<tr style="background:#D1E6E6;">  
	<th> Description</th>
	<th> Quantity</th>
	<th> Price</th>
	<th> Total</th>
</tr>

<tr>

	       <td><input name="description[]" id="description" ><select id="desc" name="desc_selector" onchange="estimate(this)"> <?php echo get_items(); ?> </select></td>
    <td><input name="quantity[]" id="quantity" onkeyup="invoice(this)">&nbsp;&nbsp;<select name="quantity_type[]"><option value="SF">SF</option><option value="RE">RE</option></select></td>
	
        <td><input name="price[]" id="price" onkeyup="invoice(this)" autocomplete="on"></td>
        <td><input name="total[]" id="total" autocomplete="off" ></td>
</tr>

             </table>         
               
        <table><tr><td><a class="btn btn-primary" id="btn" style="margin-top:20px;"  >Add Row</a></td></tr>         </table>           
    <table align="right" style="margin-right:6%;" border="0">
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
                  <td>Sales Tax "<?php echo $data['sales_tax'];?>"</td>
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
                  <td>Total</td>
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
                  <td>Total Balance</td>
                  <td><input type="text" name="balance" id="balance" onkeyup="invoice(this)" autocomplete="off"></td>
           
                </tr>
                <!-- <tr>
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
                 
                       
                  
                </tr> --><input type="hidden" name="gtotal" id="gtotal" autocomplete="off">
               


</tbody>
              
                      

            </table>

    <input type="submit" value="submit" name="submit" class="btn btn-primary" style="float:right;margin-top:120px;">  
</form>


       
       </div>
    



<!-- Mis funciones para retornar le precio del producto automaticamente -->
                 

<script type="text/javascript"> var prices = new Array() </script>
<?php    
    

    include 'config.php'; 
    
    
    $query_item = mysqli_query($mysqli,"select * from items ") or die(mysqli_error($mysqli));               
    while ($items = $query_item->fetch_assoc()) {
      
      $item = $items['item'];
      $price = $items['unprice'];

?>
    <script> prices['<?php echo $item; ?>']=<?php echo $price; ?> </script>

<?php  } ?>


<script type="text/javascript">


$(document).ready(function(){

  $('#desc').on('change', function() {      
    
    $("#price").val(prices[$(this).val()]);
    //alert(prices[$(this).val()]);
  });


  $("#div1").on("click", 'button[class^="del-row"]', function() {
    var delID = $(this).attr('id');
    var dl_id = delID.split("-");
    var row = "row-"+dl_id[1];      

    var id_total = "total"+dl_id[1];

    var total_row = $("#"+id_total).val();
    var subtotal = $("#subtotal").val();
    var tax_val = $("#tax_val").val();

    subtotal -= total_row;
    $("#subtotal").val(subtotal);

    tax = subtotal * tax_val;
    $("#salestax").val(parseFloat(tax).toFixed(2));

    var totalbalance = subtotal + tax;
    $("#totalbalance").val(parseFloat(totalbalance).toFixed(2));

    var deposit = $("#deposit").val();

    if(deposit > 0 || deposit !=null)
    {
      var balance_final = totalbalance - deposit;
      $("#balance").val(parseFloat(balance_final).toFixed(2));
    }
    else
    {
      var balance_final = parseFloat(totalbalance).toFixed(2);
      $("#balance").val(balance_final);
    }

    $("#"+row).remove();
    counter--;
    //alert(parseFloat(counter).toFixed(2));

    

    return false;
  });

});

</script>
								



