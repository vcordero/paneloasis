<?php
/*	Descomentar para trabajar Localmente */

//$dbhost = "localhost";  // Database Host
//$dbuser = "root";       // Database User Name
//$dbpassword = "";   // User Password
//$dbname = "ordenesfragan";       // Database Name
 
 
/*Datos Prestashop */
$dbhostpresta = "db.suranetworksolution.com";  // Database Host de Prestashop
$dbuserpresta = "fraganprest";       // Database User Name Prestashop
$dbpasswordpresta = "aleluya1";   // User Password Prestashop
$dbnamepresta = "c4fraganprest";       // Database Name Prestashop

/* Datos ftp */
$ftp_username="snetwork2";
$ftp_userpass="aleluya1";
$ftp_server = "ftp.fraganciasoasis.org";

/* Datos remotos */

$dbhost = "db.suranetworksolution.com";  // Database Host
$dbuser = "fragclientsynpro";       // Database User Name
$dbpassword = "aleluya1";   // User Password
$dbname = "c4fragclientsynpro";       // Database Name

$con=mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_select_db($dbname,$con) or die(mysql_error());
// Check connection
if (!$con)
  {
	  die('Could not connect: ' . mysql_error());
  }
  
  
  $mysqli=new mysqli($dbhost,$dbuser,$dbpassword,$dbname);
?>
