<?php 

session_start();

include '../config.php';

$SQLsts = "SELECT * FROM users";
$result = mysql_query($SQLsts);
$row = mysql_fetch_row($result);
$myrows = mysql_num_rows($result);

$SQLsts2 = "SELECT * FROM company";
$result2 = mysql_query($SQLsts2);
$row2 = mysql_fetch_row($result2);


if ($row2[6] == $_REQUEST['email']) {

	 $email = $row2[6];
	 $password = $row[2];
	 $username = $row[1];
	 
	 // Email Data
	$msg = "Your Password : ";
	$msg .= $password;

	 // Send Email
	 $subject = "Your Password";
	 mail($email,$subject,$msg,$email);
	 
	 header("Location: ../password_recovered.php");
	
}
else {
	
	 header("Location: ../invalid_email.php");
}


?>