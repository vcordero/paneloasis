<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include("class.phpmailer.php");
include("class.smtp.php");
include '../config.php';

	
	if(isset($_POST['send']))
    {
    	$productosSeleccionados = array();
  
    	$intento = "";
    	$name = "fail";
    	$seleccionados = array();
  		$prueba =$_SESSION['pedido']; //guardo en prueba el valor del array. 
  									//si hago var_dump de $prueba, me muestra totalselected4..totalselectedn
    	foreach ($prueba as $detail ){ //recorro el arreglo
    		//echo $detail;
    		if (isset($_POST[$detail])){
    			$separado = explode("-", $detail);
    			if ($_POST[$detail] != NULL){
    				$dato =$separado[1]."-".$_POST[$detail];
	    			array_push($seleccionados,$dato);

				}
    		}
    		
    		
    	}
    	//print_r($seleccionados);
    	$html = "";
		$html .= "<table border=1 cellspacing=0 cellpadding=2 bordercolor='666633'>";
		$html .= "<tr>";
		$html .= "  <td><strong>Name Product</strong></td>";
		$html .= "  <td><strong>Retail Price</strong></td>";
		$html .= "  <td><strong>Sale Price</strong></td>";
		$html .= "  <td><strong>Quantity</strong></td>";
		$html .= "  <td><strong>Total Retail Price</strong></td>";
		$html .= "  <td><strong>Total Sale Price</strong></td>";
		$html .= "</tr>";
		
		$sumret = 0;
		$sumsale = 0;
		foreach ($seleccionados as $producto ){
			//aqui hago la consulta y bla bla
			$detallado = explode("-", $producto);
			$SqlConsult = "select * from product where id_product =".$detallado[0]."";
			$resultado = mysql_query($SqlConsult);
			$datos =mysql_fetch_array($resultado)or die("Error en: $resultado: " . mysql_error());;
			$html .= "<tr>";
			$html .= "  <td><strong>".$datos['description']."</strong></td>";
			$html .= "  <td><strong>".$datos['retail_price']."</strong></td>";
			$html .= "  <td><strong>".$datos['wholesale_price']."</strong></td>";
			$html .= "  <td><strong>".$detallado[1]."</strong></td>";
			$totalret = $datos['retail_price'] * $detallado[1];
			$sumret = $sumret + $totalret;
			$html .= "  <td><strong>".$totalret."</strong></td>";
			$totalsale = $datos['wholesale_price'] * $detallado[1];
			$sumsale = $sumsale + $totalsale;
			$html .= "  <td><strong>".$totalsale."</strong></td>";
			$html .= "</tr>";
			//$query=$mysqli->query("select * from product where id =".$detallado[0]."");
			//$data=mysqli_fetch_assoc($query);
			//print_r($datos);exit();


		}
		$html.="<tr>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td><strong>TOTAL</strong></td>";
		$html.="  <td><strong>TOTAL</strong></td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td><strong>".$sumret."</strong></td>";
		$html.="  <td><strong>".$sumsale."</strong></td>";
		$html.="</tr>";
		$html .= "</table>";

		
    	//exit();
    	$name = $_POST['cpname'];
    	$correo = $_POST['email'];
    	$phone = $_POST['phone1'];
    	$coment = $_POST['t1'];
		//$correo=$_POST['correo_usuario'];
		

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "mail.ntchosting.com";
		$mail->Port = 25;
		$mail->Username = "silma.natera@venezuelansmind.com";/*Tiene que ser una cuenta del dominio*/
		$mail->Password = "s0336644";/* clave de Jhohan o maria alejandra */

		$mail->From = "silma.natera@venezuelansmind.com";
		$mail->FromName = "Fragan orders";

		$mail->AddAddress("jesustrejo10@gmail.com");// Direccion de correo del señor
        //$mail->AddAddress("iipl.ashishd@gmail.com");// Direccion de correo del señor






		$mail->AddAddress("".$correo."");// Correo a otra persona
		$mail->IsHTML(true);
		$mail->Subject = "New Order.";
		$cuerpo="Hello <br><br>";




		$cuerpo.="we have received a new order from<br>";
		$cuerpo.="<Strong> ".$name."</Strong><br>";
		$cuerpo.="His email is <Strong>".$correo." </Strong><br>";
		$cuerpo.="His phone number <Strong>".$phone."</Strong><br>";
		$cuerpo.="and the following comment.<br>";
		$cuerpo.="'".$coment."'<br><br>";
		$cuerpo.="below you will find a summary of this order <br><br>";
		$cuerpo.= $html;
		$cuerpo.="<br><br>-- WARNING --<br>";
		$cuerpo.="This is a automatic email, please dont reply this or send any mensaje to this email.<br>";
		
		$SqlConsult2 = "select * from mail";
		$result = mysql_query($SqlConsult2);		
		//$emails =mysql_fetch_array($result)or die("Error en: $resultado: " . mysql_error());;
		//print_r($emails);
		while($rows=mysql_fetch_array($result)){

			//print_r($rows['description']);
			$mail->AddAddress($rows['description']);// Correo a otra persona
			$mail->Body=$cuerpo;
			//echo $cuerpo;exit();
			if(!$mail->Send()) {
				$_SESSION['pedido']= NULL;
				header("Location:../dashboard.php?&Emessage=2");
			} 
		}
			$_SESSION['pedido']= NULL;
							
			header("Location:../dashboard.php?&Emessage=1");	

			
		/*
		$mail->AddAddress("".$correo."");// Correo a otra persona
		$mail->Body=$cuerpo;
		echo $cuerpo;exit();
		if(!$mail->Send()) {
			print "<script>alert('Hubo un error enviando el correo, intenta luego.')</script>";
		} else {
			$_SESSION['pedido']= NULL;
			print "<script>alert('El nuevo usuario ha recibido un correo con sus datos para ingresar al Sistema !!')</script>";
		}
		*/
	}





?>