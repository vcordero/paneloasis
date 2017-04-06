<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
        if(isset($_POST['id'])){
	$id=$_POST['id'];
        }

        if(isset($_FILES['file_logo']['name']))
        {

        	$uploaddir = '../assets/images/';
			$uploadfile = $uploaddir . basename($_FILES['file_logo']['name']);	
			$path = substr($uploadfile,3);		

        	if (move_uploaded_file($_FILES['file_logo']['tmp_name'], $uploadfile)) {

        		$SQLSt = "UPDATE company SET cname = '"
				. $_REQUEST['cname'] . "', caddress = '" 
				. mysql_real_escape_string($_REQUEST['t1']) . "', phone1 = '" 
				. $_REQUEST['phone1'] . "', phone2 = '" 
				. $_REQUEST['phone2'] . "', fax = '" 
				. $_REQUEST['fax'] . "', email = '"	
				. $_REQUEST['email'] . "', logo = '".$path."'";

			    //header("Location: ../dashboard.php?p=settings_general&message=Your data has been update!");
			} else {
			    header("Location: ../dashboard.php?p=settings_general&message=Error trying to load logo!");
			}

        	
        }
        else
        {
        	$SQLSt = "UPDATE company SET cname = '"
			. $_REQUEST['cname'] . "', caddress = '" 
			. mysql_real_escape_string($_REQUEST['t1']) . "', phone1 = '" 
			. $_REQUEST['phone1'] . "', phone2 = '" 
			. $_REQUEST['phone2'] . "', fax = '" 
			. $_REQUEST['fax'] . "', email = '"	
			. $_REQUEST['email'] . "', logo = 'assets/images/noimage.png'";
        }
	
		
	mysql_query($SQLSt);
        $sales_tax=$_POST['salestax'];
        $query=mysql_query("update salestax set sales_tax='$sales_tax' where id='$id'");

	mysql_close($con);

	header("Location: ../dashboard.php?p=settings_general");
?>