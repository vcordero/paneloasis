<?php
    ini_set('display_errors','0');
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include("class.phpmailer.php");
include("class.smtp.php");
include '../config.php';
include("send_mail.php");

	if(isset($_POST['send']))
    {
        $productosSeleccionados = array();
  		$name = $_POST['cpname'];
    	$correo = $_POST['email'];
    	$phone = $_POST['phone1'];
    	$coment = $_POST['t1'];
    	$intento = "";
    	$order_number = 0;
    	//$name = "fail";
    	$seleccionados = array();
    	//var_dump($_SESSION['pedido']); exit();
  		$prueba =$_SESSION['pedido']; //guardo en prueba el valor del array. 
  									//si hago var_dump de $prueba, me muestra totalselected4..totalselectedn
    	
    	// Busco el siguiente numero de orden
    	$SqlConsultOrder = "select * from order_number";
		$result_order = mysql_query($SqlConsultOrder);
		$datos_order =mysql_fetch_array($result_order);
		$order_number = $datos_order['web_number'];
		// Actualizo el siguiente numero de orden.
		$SqlUpdatetOrder = "UPDATE order_number set web_number = web_number + 1 WHERE id=0";
		$result_update = mysql_query($SqlUpdatetOrder);
		

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
    	//print_r($seleccionados);exit();
    	$html = "";
		$html .= "<table border=1 cellspacing=0 cellpadding=2 bordercolor='666633'>";
		$html .= "<tr>";
		$html .= "  <td><strong>Name Product</strong></td>";
		$html .= "  <td><strong>Retail Price</strong></td>";
		$html .= "  <td><strong>Sale Price</strong></td>";
		$html .= "  <td><strong>Quantity</strong></td>";
		//$html .= "  <td><strong>Color</strong></td>";
		//$html .= "  <td><strong>Total Retail Price</strong></td>";
		$html .= "  <td><strong>Total Sale Price</strong></td>";
		$html .= "</tr>";
		
		$sumret = 0;
		$sumsale = 0;
		$sumquantity = 0;

		foreach ($seleccionados as $producto ){
                  //echo $detallado[1];
			$tamanio = explode(" ", $detallado[1]);
			$quantity 	= '';
			$color 		= '';

			/*if(count($tamanio) > 1){
				$color = $detallado[1];
				$quantity 	= 0;

			}else{
				$color 		= ' -- ';
				$quantity 	= $detallado[1];
			}*/
                         
                        if(count($tamanio) > 1){
                                echo 'tamanio en IF: '.count($tamanio); 
				$color = $tamanio[1];
				$quantity 	= $tamanio[0];

			}else{
                               echo 'tamanio en ELSE: '.count($tamanio);
				$color 		= ' -- ';
				$quantity 	= $detallado[1];
                                echo 'color: '.$color;
                                echo 'cantidad: '.$tamanio[0];
			}
                        //echo 'cantidad: '.$quantity;
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
			//$html .= "  <td><strong>".$quantity."</strong></td>";
			//$html .= "  <td><strong>".$color."</strong></td>";
			//$totalret = $datos['retail_price'] * $quantity;
                        $totalret = $datos['retail_price'] * $detallado[1];
			//$sumquantity = $sumquantity + $quantity;
                        $sumquantity = $sumquantity + $detallado[1];
			$sumret = $sumret + $totalret;
			//$html .= "  <td><strong>".$totalret."</strong></td>";
			//$totalsale = $datos['wholesale_price'] * $quantity;
                        $totalsale = $datos['wholesale_price'] * $detallado[1];
			$sumsale = $sumsale + $totalsale;
			$html .= "  <td><strong>".$totalsale."</strong></td>";
			$html .= "</tr>";
			//$query=$mysqli->query("select * from product where id =".$detallado[0].""); 
			//$data=mysqli_fetch_assoc($query);
			//print_r($datos);exit();
			
			$tamanio = explode(" ", $detallado[1]);
                        //echo 'detalle: '.$detallado[1];
			$quantity 	= '';
			$color 		= '';

			if(count($tamanio) > 1){
				$color = $detallado[1];
				$quantity 	= 0;

			}else{
				$color 		= 'NA';
				$quantity 	= $detallado[1];
			}

			//echo 
			// $SqlConsult = "INSERT INTO order_web (id_product,description,retail_price,wholesale_price,quantity,name,email,phone,order_number,comments,color) 
			// 			VALUES (".$detallado[0].",'".$datos['description']."',". $datos['retail_price'].",". $datos['wholesale_price'].",". $detallado[1].",'". $name."','". $correo."','". $phone."',". $order_number.",'". $coment."')";
			
			$SqlConsult = "INSERT INTO order_web (id_product,description,retail_price,wholesale_price,quantity,name,email,phone,order_number,comments,color) 
						VALUES (".$detallado[0].",'".$datos['description']."',". $datos['retail_price'].",". $datos['wholesale_price'].",". $quantity.",'". $name."','". $correo."','". $phone."',". $order_number.",'". $coment."','". $color."')";
			


			//$_SESSION['prueba'] = $SqlConsult.'-';
			//echo $SqlConsult; exit();
			$resultado = mysql_query($SqlConsult);


		}
		$html.="<tr>";
		//$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td><strong>TOTAL</strong></td>";
		//$html.="  <td><strong>TOTAL</strong></td>";
		$html.="  <td><strong>TOTAL</strong></td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="  <td></td>";
		//$html.="  <td></td>";
		$html.="  <td></td>";
		$html.="  <td><strong>".$sumquantity."</strong></td>";
		//$html.="  <td><strong>".$sumret."</strong></td>";
		$html.="  <td><strong>".$sumsale."</strong></td>";
		$html.="</tr>";
		$html .= "</table>";

		//echo $html;
		//exit();
		
    	//exit();
    	//$name = $_POST['cpname'];
    	//$correo = $_POST['email'];
    	//$phone = $_POST['phone1'];
    	//$coment = $_POST['t1'];
		//$correo=$_POST['correo_usuario'];
		

	//	$mail = new PHPMailer();
	//	$mail->IsSMTP();
	//	$mail->SMTPAuth = true;
	//	$mail->SMTPSecure = "tls";
	//	$mail->Host = "stream.suranetworksolution.com";
	//	$mail->Port = 25;
	//	$mail->Username = "sender@clientes.fraganciasoasis.com";/*Tiene que ser una cuenta del dominio*/
	//	$mail->Password = "aleluya1";/* clave de Erick */

	//	$mail->From = "sender@clientes.fraganciasoasis.com";
	//	$mail->FromName = "Fragan orders";
        
        $sql = "select to_admin from smtp_config where '0'='0'";
        $res = mysql_query($sql);
        $smtp_info = mysql_fetch_array($res);
        
		$to=explode(',',$smtp_info['to_admin']);// Direccion de correo del señor
        
    //	$mail->AddAddress("fraganciasoasis@yahoo.com");// Direccion de correo del señor

		$to[]=$correo;// Correo a otra persona
        
        
		
		$sub = "New Order.";
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
		
		    $body=$cuerpo;
            $new_send_mail=new_sendmail($to,$sub,$body,$attach='',$attach_as='',$cc='');
			if($new_send_mail==1) {
				$_SESSION['pedido']= NULL;
				header("Location:../dashboard.php?&Emessage=2");
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