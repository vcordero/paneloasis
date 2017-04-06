<?php 

//session_start();

include("class.phpmailer.php");
include("class.smtp.php");
include '../config.php';

/************************************************

	Funcion para buscar si el usuario existe

************************************************/
function findmail($correo){

	$SQLsts = "SELECT * FROM users WHERE email='$correo'";
	$result = mysql_query($SQLsts);
	$total=0;

	while($rows=mysql_fetch_array($result)) {
		$total = 1;
	}
	
	return $total;
}

/************************************************

	Funcion que genera nuevo password

************************************************/
function resetpassword(){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$password = "";

	for($i=0;$i<12;$i++) {
		$password .= substr($str,rand(0,62),1);
	}

	return $password;
	
}

/************************************************

	Funcion para actualizar el password en la BD

*************************************************/
function updatepassword($email,$resetpassword){
	$respuesta=1;

	$SQLsts = "UPDATE users SET password='$resetpassword' WHERE email='$email'";
	$result = mysql_query($SQLsts);

	if(!$result){
		$respuesta = 0;
	}

	return $respuesta;
}

/************************************************

	Funcion para enviar correo a administrador
	del sistema para comunicarle que una IP ha
	sido bloqueada

*************************************************/
function sendemailadmin($ip){
	$respuesta=1;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	
	/*Datos Host Erick */			
	$mail->Host = "clientes.fraganciasoasis.com";
	$mail->Port = 25;
	$mail->Username = "sender@clientes.fraganciasoasis.com";
	$mail->Password = "aleluya1";
	$mail->From = "sender@clientes.fraganciasoasis.com";
	$mail->FromName = "Fragancias Oasis - Bloked IP";
	/* Hasta Aqui */

	/*Datos Host Silma */
	/*$mail->Host = "mail.ntchosting.com";
	$mail->Port = 2525;
	$mail->Username = "silma.natera@venezuelansmind.com";
	$mail->Password = "s0336644";
	$mail->From = "silma.natera@venezuelansmind.com";
	$mail->FromName = "Fragancias Oasis - Bloked IP";*/
	/* Hasta Aqui */

	$correo = 'Freedom8604@hotmail.com'; // Correo del administrador donde llegarà el correo cuando una IP se bloquee
										// en $correo iria el de Erick
	$mail->AddAddress($correo);// Direccion de correo del admin
	$mail->IsHTML(true);
	$mail->Subject = "Bloked IP";

	$cuerpo="La IP: ".$ip." ha intentado registrarse en tres oportunidades en el Sistema de Fragancias Oasis<br><br>";
	$cuerpo.="Esta IP  ha sido bloqueada por el sistema. En caso que necesite desbloquearla entre en el administrador.<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		//print "<script>alert('There are problems sending the email. Try later.')</script>";
		//header("Location: ../index.php");
		return $respuesta=0;
	}
	
	return $respuesta;	
}


/************************************************

	Funcion para enviar correo a administrador
	del sistema para comunicarle que un nuevo
	usuario ha sido registrado.

*************************************************/
function sendemailadminregister($email,$phone){
	$respuesta=1;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	

	/*Datos Host Erick */			
	$mail->Host = "clientes.fraganciasoasis.com";
	$mail->Port = 25;
	$mail->Username = "sender@clientes.fraganciasoasis.com";
	$mail->Password = "aleluya1";
	$mail->From = "sender@clientes.fraganciasoasis.com";
	$mail->FromName = "Fragancias Oasis - New Register";
	/* Hasta Aqui */

	/*Datos Host Silma */
	/*$mail->Host = "mail.ntchosting.com";
	$mail->Port = 2525;
	$mail->Username = "silma.natera@venezuelansmind.com";
	$mail->Password = "s0336644";
	$mail->From = "silma.natera@venezuelansmind.com";
	$mail->FromName = "Fragancias Oasis - New Register";*/
	/* Hasta Aqui */
	$correo = 'Freedom8604@hotmail.com'; // Correo del administrador donde llegarà el correo cuando un nuevo usuario se registre
										// en $correo iria el de Erick
	$mail->AddAddress($correo);// Direccion de correo del admin
	$mail->IsHTML(true);
	$mail->Subject = "New Register";

	$cuerpo="Se ha registrado un nuevo usuario en el Sistema de Fragancias Oasis<br><br>";
	$cuerpo.="Su correo es: ".$email." y su numero de telefono es: ".$phone.".<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		return $respuesta=0;
	}
	
	return $respuesta;	
}

/************************************************

	Funcion para enviar correo al usuario
	para comunicarle de su nuevo registro.

*************************************************/
function sendemailuserregister($email,$username,$pass){
	$respuesta=1;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	

	/*Datos Host Erick */			
	$mail->Host = "clientes.fraganciasoasis.com";
	$mail->Port = 25;
	$mail->Username = "sender@clientes.fraganciasoasis.com";
	$mail->Password = "aleluya1";
	$mail->From = "sender@clientes.fraganciasoasis.com";
	$mail->FromName = "Fragancias Oasis - New Register";
	/* Hasta Aqui */

	/*Datos Host Silma */
	/*$mail->Host = "mail.ntchosting.com";
	$mail->Port = 2525;
	$mail->Username = "silma.natera@venezuelansmind.com";
	$mail->Password = "s0336644";
	$mail->From = "silma.natera@venezuelansmind.com";
	$mail->FromName = "Fragancias Oasis - New Register";*/

	$correo = $email; // Correo de registro del usuario.
	$mail->AddAddress($correo);// Direccion de correo del admin
	$mail->IsHTML(true);
	$mail->Subject = "New Register";

	$cuerpo="Usted se ha registrado como nuevo usuario en el Sistema de Fragancias Oasis<br><br>";
	$cuerpo.="Su usuario es: ".$username." y su clave de acceso es: ".$pass.".<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		return $respuesta=0;
	}
	
	return $respuesta;	
}

if(isset($_POST['recover'])){

		$correo = $_POST['email'];
   		$usermail = findmail($correo);
		
		if($usermail==0){
			header("Location: ../invalid_email.php");
		}else{

			$resetpassword = resetpassword(); // Solicito el nuevo password
			$newpassword =  updatepassword($correo,$resetpassword);

			if($newpassword==1){
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "tls";
				/*Datos Host Erick */			
				$mail->Host = "clientes.fraganciasoasis.com";
				$mail->Port = 25;
				$mail->Username = "sender@clientes.fraganciasoasis.com";
				$mail->Password = "aleluya1";
				$mail->From = "sender@clientes.fraganciasoasis.com";
				$mail->FromName = "Fragancias Oasis";
				/* Hasta Aqui */

				/*Datos Host Silma */
				/*$mail->Host = "mail.ntchosting.com";
				$mail->Port = 2525;
				$mail->Username = "sender@clientes.fraganciasoasis.com";
				$mail->Password = "s0336644";
				$mail->From = "sinfo@clientes.fraganciasoasis.comm";
				$mail->FromName = "Fragancias Oasis";*/
				/* Hasta Aqui */

				$mail->AddAddress($correo);// Direccion de correo del usuario
				$mail->IsHTML(true);
				$mail->Subject = "Password Recovered";

				$cuerpo="Ha recibido su nuevo password para acceder al Sistema de Fragancias Oasis<br><br>";
				$cuerpo.="His new password is: <Strong>".$resetpassword." </Strong><br>";
				$cuerpo.="Haga click <a href='http://fraganciasoasis.com/clientes/index.php'>AQUI</a> para ingresar al Sistema Administrativo:<br><br>";
				$cuerpo.="<strong style='color:#F30C0C;'>Importante: </strong> Por su seguridad, recomendamos cambiar su Contraseña periódicamente."."<br>";
				$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

				$mail->Body=$cuerpo;

				if(!$mail->Send()) {
					print "<script>alert('There are problems sending the email. Try later.')</script>";
					header("Location: ../index.php");
				} else {
					header("Location: ../password_recovered.php");
				}
			}else{
				print "<script>alert('There are problems sending the email. Try later.')</script>";
				header("Location: ../index.php");
			}
			
		
		}

}

?>