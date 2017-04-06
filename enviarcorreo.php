<?php
// Librerias de Correo Electrónico

include("class.phpmailer.php");
include("class.smtp.php");




/**********************************************************************
*	
*	Funcion de prueba
*
***********************************************************************/

function enviarCorreoPrueba(){
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
	$mail->FromName = "TuComida";

	$mail->AddAddress("jesustrejo10@gmail.com");// Direccion de correo del señor
	//$mail->AddAddress("lesterp16@gmail.com");// Correo a otra persona
	$mail->IsHTML(true);
	$mail->Subject = "Registro de Usuario Sistema Administrativo TuComida";
	$cuerpo="Ha recibido los datos de acceso para ingresar al Sistema Administrativo de 'TuComida'<br><br>";
	$cuerpo.="<strong>Usuario:</strong><br>";
	$cuerpo.="<strong>Contraseña:</strong><br><br>";
	$cuerpo.="Haga click <a href='http://venezuelansmind.com/demo/presupuestonline/vistas/login.php'>AQUI</a> para ingresar al Sistema Administrartivo:<br><br>";
	$cuerpo.="<strong style='color:#F30C0C;'>Importante: </strong> Por su seguridad, recomendamos cambiar su Contraseña periódicamente."."<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		print "<script>alert('Hubo un error enviando el correo, intenta luego.')</script>";
	} else {
		print "<script>alert('El nuevo usuario ha recibido un correo con sus datos para ingresar al Sistema !!')</script>";
	}
	
}


/**********************************************************************
*	
*	Funcion para acceso de Nuevo Usuario
*
***********************************************************************/

function enviarCorreoUsuario($correo,$password){
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
	$mail->FromName = "TuComida";

	$mail->AddAddress($correo);// Direccion de correo del señor
	//$mail->AddAddress("lesterp16@gmail.com");// Correo a otra persona
	$mail->IsHTML(true);
	$mail->Subject = "Registro de Usuario Sistema Administrativo TuComida";
	$cuerpo="Ha recibido los datos de acceso para ingresar al Sistema Administrativo de 'TuComida'<br><br>";
	$cuerpo.="<strong>Usuario:</strong>".$correo."<br>";
	$cuerpo.="<strong>Contraseña:</strong>".$password."<br><br>";
	$cuerpo.="Haga click <a href='http://venezuelansmind.com/demo/presupuestonline/vistas/login.php'>AQUI</a> para ingresar al Sistema Administrartivo:<br><br>";
	$cuerpo.="<strong style='color:#F30C0C;'>Importante: </strong> Por su seguridad, recomendamos cambiar su Contraseña periódicamente."."<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		print "<script>alert('Hubo un error enviando el correo, intenta luego.')</script>";
	} else {
		print "<script>alert('El nuevo usuario ha recibido un correo con sus datos para ingresar al Sistema !!')</script>";
	}
	
}

/**********************************************************************
*	
*	Funcion para Cambio de Password
*
***********************************************************************/

function enviarCorreoNuevoPassUsuario($correo,$password){
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
	$mail->FromName = "TuComida";

	$mail->AddAddress($correo);// Direccion de correo del señor
	//$mail->AddAddress("lesterp16@gmail.com");// Correo a otra persona
	$mail->IsHTML(true);
	$mail->Subject = "Registro de Usuario Sistema Administrativo TuComida";
	$cuerpo="Ha recibido los datos de acceso <strong>CON SU NUEVA CLAVE</strong> para ingresar al Sistema Administrativo de 'TuComida'<br><br>";
	$cuerpo.="<strong>Usuario:</strong>".$correo."<br>";
	$cuerpo.="<strong>Nueva Contraseña:</strong>".$password."<br><br>";
	$cuerpo.="Haga click <a href='http://venezuelansmind.com/demo/presupuestonline/vistas/login.php'>AQUI</a> para ingresar al Sistema Administrartivo:<br><br>";
	$cuerpo.="<strong style='color:#F30C0C;'>Importante: </strong> Por su seguridad, recomendamos cambiar su Contraseña periódicamente."."<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		print "<script>alert('Hubo un error enviando el correo, intenta luego.')</script>";
	} else {
		print "<script>alert('Ha recibido un correo con su nueva Clave de Acceso !!')</script>";
	}
	
}

/**********************************************************************
*	
*	Funcion para Recuperacion de Password
*
***********************************************************************/
function enviarCorreoRecuperacionPassUsuario($correo,$password){
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
	$mail->FromName = "TuComida";

	$mail->AddAddress($correo);// Direccion de correo del señor
	//$mail->AddAddress("lesterp16@gmail.com");// Correo a otra persona
	$mail->IsHTML(true);
	$mail->Subject = "Recuperacion de Clave: Sistema Administrativo TuComida";
	$cuerpo="Ha recibido los datos de recuperación de <strong>CONTRASEÑA</strong> para ingresar al Sistema Administrativo de 'TuComida.'<br><br>";
	$cuerpo.="<strong>Usuario:</strong>".$correo."<br>";
	$cuerpo.="<strong>Nueva Contraseña:</strong>".$password."<br><br>";
	$cuerpo.="Haga click <a href='http://venezuelansmind.com/demo/presupuestonline/vistas/login.php'>AQUI</a> para ingresar al Sistema Administrartivo:<br><br>";
	$cuerpo.="<strong style='color:#F30C0C;'>Importante: </strong> Por su seguridad, recomendamos cambiar su Contraseña periódicamente."."<br>";
	$cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

	$mail->Body=$cuerpo;

	if(!$mail->Send()) {
		print "<script>alert('Hubo un error enviando el correo, intenta luego.')</script>";
	} else {
		print "<script>alert('Ha recibido un correo de recuperación de datos !!')</script>";
	}
	
}

/**********************************************************************
*	
*	Funcion de envío de Correo de Contacto
*
***********************************************************************/
function enviarCorreoContacto($nombre,$apellido,$correo,$telefono,$pais,$ciudad,$mensaje){
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
	$mail->FromName = "Web Plastics And Power Supply";
	$mail->AddAddress("silma.natera@gmail.com");// Direccion de correo de maria alejandra y Joham
	//$mail->AddAddress("lesterp16@gmail.com");// Correo a otra persona
	$mail->IsHTML(true);
	$mail->Subject = "Correo desde la Web de Plastics And Power Supply";
	$cuerpo="<strong>Datos del Contacto</strong><br><br>";
	$cuerpo.="<strong>Nombre del Cliente:</strong>".$nombre.' '.$apellido."<br>";
	$cuerpo.="<strong>Correo:</strong>".$correo."<br>";
	$cuerpo.="<strong>Tlf. de Contacto:</strong>".$telefono."<br>";
	$cuerpo.="<strong>Pais:</strong>".$pais."<br>";
	$cuerpo.="<strong>Ciudad:</strong>".$ciudad."<br>";
	$cuerpo.="<strong>Mensaje:</strong>"."<br>";
	$cuerpo.=$mensaje."<br>";
	$mail->Body=$cuerpo;

	/*if(!$mail->Send()) {
		print "<script>alert('Hubo un error enviando el correo, intenta luego.')</script>";
	} else {
		print "<script>alert('Ha recibido un correo de recuperación de datos !!')</script>";
	}*/
	$exito = $mail->Send();
	$intentos=1; 
	while ((!$exito) && ($intentos < 5)) {
		sleep(5);
		$exito = $mail->Send();
		$intentos=$intentos+1;    
	}
	if(!$exito)
	{
		print "<script>alert('Problemas enviando el correo, intente luego.')</script>";
		
	} else {
		print "<script>alert('Su correo ha sido recibido por nuestro personal. Pronto nos prondremos en contacto con Usted. Gracias por Preferirinos !!')</script>";
	}
	
}
?>
