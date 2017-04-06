<?php 
	
	session_start();
    
	include '../config.php';
	require_once 'recover_password.php';
    include("../function/send_mail.php");
	$email 		= 	$_POST['email'];
	$phone		= 	$_POST['phone'];
	$username 	= 	$_POST['username'];
	$pass 		= 	$_POST['pass'];
	$captcha 	= 	sha1($_POST['captcha']);
	$cookie_captcha	= $_COOKIE['captcha'];
	$respuesta='';

	// Validacion de los campos
	if(empty($email)){
		$respuesta=4;
	}elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email)){
		$respuesta=7;
	}elseif(empty($username)){
		$respuesta=5;
	}elseif(empty($pass)){
		$respuesta=6;
	// Comparo el valor del captcha con la cookie
	}elseif($captcha==$cookie_captcha){

		// Busco que no exista el usuario
		$userquery=$mysqli->query("select * from users where user='$username'") ; 
		$data=mysqli_fetch_assoc($userquery);
		
		if ($data==NULL){
			//significa que ese username no existe en la bd. es valido.
			$SQLSt = "INSERT INTO users (user,password,email,phone,type,role) VALUES ('".$username."','".$pass."','". $email."','". $phone."',2,1)";
			$sql=mysql_query($SQLSt);
		
	      	if($sql){
		      	// Envio los datos del nuevo registro
		      	//$answermailregister=sendemailadminregister($email,$phone);
                                $sql = "select to_admin from smtp_config where '0'='0'";
                                $res = mysql_query($sql);
                                $smtp_info = mysql_fetch_array($res);
                                
                        		$to=explode(',',$smtp_info['to_admin']);
                                //$to = 'silma.natera@gmail.com'; // Correo del administrador donde llegarà el correo cuando un nuevo usuario se registre
                                //$to = 'iipl.ashishd@gmail.com';
                                        // en $correo iria el de Erick
                                $sub = "New Register";
                                
                                $cuerpo="Se ha registrado un nuevo usuario en el Sistema de Fragancias Oasis<br><br>";
                                $cuerpo.="Su correo es: ".$email." y su numero de telefono es: ".$phone.".<br>";
                                $cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";
                                
                                $body=$cuerpo;
                               
                             $answermailregister=new_sendmail($to,$sub,$body,$attach='',$attach_as='',$cc='');

		      	if($answermailregister==1){
					$respuesta=1; // Registro exitoso y se envia correo al admin	
				}else{
					$respuesta=1; // Registro exitoso, si hay problemas con el correo igualmente se bloquea el admin	
				}
		        
	      	}else{
	        	$respuesta=2; // Problemas insertando el usuarios
	        
	      	}
	    }else{
			$respuesta=3; // El usuario existe
			
	    }
	
	}else{
		// Obtengo la IP
		//$Ip = getHostByName(getHostName());
        $Ip = $_SERVER['REMOTE_ADDR'];
		// Busco la IP para ver si ha entrado antes.
		$captchaquery=$mysqli->query("select * from registeraccess where ip_numer='".$Ip."'") ; 
		$data=mysqli_fetch_assoc($captchaquery);
		// Si no ha entrado antes lo inserto
		if ($data==NULL){
			//significa que esa Ip no existe.
			$SQLSt = "INSERT INTO registeraccess (ip_numer,access_number) VALUES ('".$Ip."',1)";
			$sql=mysql_query($SQLSt);
			$respuesta=0;
		}else{
		
			// Si ha entrado 3 veces se bloquea
			if($data['access_number']==3){
				// Enviar correo con datos de ip bloqueda
				//$answermail=sendemailadmin($Ip);
                
                $sql = "select to_admin from smtp_config where '0'='0'";
                $res = mysql_query($sql);
                $smtp_info = mysql_fetch_array($res);
                
        		$to=explode(',',$smtp_info['to_admin']);
                //$to[]= 'freedom8604@hotmail.com'; // Correo del administrador donde llegarà el correo cuando una IP se bloquee
                //$to = 'iipl.ashishd@gmail.com';
                $sub = "Bloked IP";
            
                $cuerpo="La IP: ".$Ip." ha intentado registrarse en tres oportunidades en el Sistema de Fragancias Oasis<br><br>";
                $cuerpo.="Esta IP  ha sido bloqueada por el sistema. En caso que necesite desbloquearla entre en el administrador.<br>";
                $cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";
            
                $body=$cuerpo;
                $answermail=new_sendmail($to,$sub,$body,$attach='',$attach_as='',$cc='');
                
				if($answermail==1){
					$respuesta=8; // Usuario ha sido bloquedado y se envia correo al admin	
				}else{
					$respuesta=8; // Usuario ha sido bloquedado, si hay problemas con el correo igualmente se bloquea el admin	
				}

				
			}else{
				// Si ha entrado menos de 3 veces se le suma 1 al nro de intentos
				$SQLSt=$mysqli->query("update registeraccess set access_number = access_number+1 WHERE ip_numer = '".$Ip."'");
				$respuesta=0;
			}
		}
		

		
	}
    
    //header("Location: ../index.php");
    echo json_encode($respuesta);
	
?>