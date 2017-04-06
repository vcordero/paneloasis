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
    $invoiceid=  $_POST['billno'];
    if(isset($_POST['invoice_to'])  
            && isset($_POST['balance']) && isset($_POST['gtotal']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['quantity_type']) ){
    if(!empty($_POST['invoice_to']) 
            && !empty($_POST['balance']) && !empty($_POST['gtotal']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['quantity_type']) ){
    $invoice_to=$_POST['invoice_to'];
    $user=$_POST['user'];
   // $job=$_POST['job'];
    $type_payment=$_POST['type_payment'];
    $quote_date=date('Y-m-d');
    $deposit=$_POST['deposit'];
    $balance=$_POST['balance'];
    $total=$_POST['gtotal'];
  $type='bill';
/* Image resize
 * @param int $width
 * @param int $height
 */
function resize($width, $height){
  /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['files']['tmp_name']);
  /* calculate new image size with ratio */
  $ratio = max($width/$w, $height/$h);
  $h = ceil($height / $ratio);
  $x = ($w - $width / $ratio) / 2;
  $w = ceil($width / $ratio);
  /* new file name */
  $path = "upload/".$_FILES['files']['name'];
  
  
  /* read binary data from image file */
  $imgString = file_get_contents($_FILES['files']['tmp_name']);
  /* create image from string */
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($width, $height);
  imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
  /* Save image */
  switch ($_FILES['files']['type']) {
    case 'image/jpeg':
      imagejpeg($tmp, $path, 100);
      break;
    case 'image/png':
      imagepng($tmp, $path, 0);
      break;
    case 'image/gif':
      imagegif($tmp, $path);
      break;
    default:
      exit;
      break;
  }
  return $path;
  /* cleanup memory */
  imagedestroy($image);
  imagedestroy($tmp);
}
// settings
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 1024*100; //100 kb
$path = "upload/"; // Upload directory
$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
           
	}
}		
    
      
        //echo $_FILES['files']['name'] [1];
        $description=$_POST['description'];
    $price=$_POST['price'];
    $quantity_type=$_POST['quantity_type'];
     foreach($_POST['quantity'] as $quantity=>$n )  { 
    $qty=$n.$quantity_type[$quantity];
         $query=  $mysqli->query("insert into invoice_supplier(invoice_id,client_to,type,representative,type_of_payment,date,quantity,description,price,deposit,balance,total,image_invoice)
            values('$invoiceid','$invoice_to','$type','$user','$type_payment','$quote_date','$qty','$description[$quantity]','$price[$quantity]','$deposit','$balance','$total','$name')") or die($mysqli->error);
         
     }
      
     
       
     
         
     
 
      

     
    
   

    
  
  if($query) {
       $mysqli->commit();
      // header('Location:dashboard.php?p=suppliers_estimates&Smessage=Database Updated');
   }
   else {
       $mysqli->rollback();
        header('Location:dashboard.php?p=suppliers_estimates&Emessage=Error');
    
   }
    
            }
            else {
                
                 header('Location:dashboard.php?p=suppliers_estimates&Emessage=Please Fill All Details Correct');
            }


            }
            else {
                
                header('Location:dashboard.php?p=suppliers_estimates&Emessage=Please Fill All Details');
            }


