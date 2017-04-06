<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('../class.phpmailer.php');

$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host       = "stmp.gmail.com"; // SMTP server

$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)

// 1 = errors and messages

// 2 = messages only

$mail->SMTPAuth   = true;                  // enable SMTP authentication

$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username   = "scstestmail1@gmail.com";  // GMAIL username

$mail->Password   = "Iipl_954";            // GMAIL password

$mail->SetFrom('scstestmail1@gmail.com', 'test');

//$mail->AddReplyTo("vishalkumar@gmail.com","test");

$mail->Subject    = "Hey, check out http://www.vishalkumar.in";

$mail->AltBody    = "Hey, check out this new post on www.vishalkumar.in"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "scstestmail1@gmail.com";

$mail->AddAddress($address, "test");
if(!$mail->Send()) 
{
  echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
  echo "<h3>Message sent!</h3>";exit;
}

?>

</body>
</html>
