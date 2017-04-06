<?php 

session_start();

if (!ctype_alnum($_REQUEST['username'])) {
    header("Location: login_failed.php");
}

if (!ctype_alnum($_REQUEST['password'])) {
    header("Location: login_failed.php");
}

include 'config.php';
include("functions/class.phpmailer.php");
include("functions/class.smtp.php");
include("functions/send_mail.php");


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
/*          $mail->Host = "stream.suranetworksolution.com";
    $mail->Port = 25;
    $mail->Username = "sender@suranetworksolution.com";
    $mail->Password = "aleluya1";
    $mail->From = "sender@suranetworksolution.com";
    $mail->FromName = "Fragancias Oasis";
    /* Hasta Aqui */

    /*Datos Host Silma */
    $mail->Host = "clientes.fraganciasoasis.com";
    $mail->Port = 25;
    $mail->Username = "sender@clientes.fraganciasoasis.com";
    $mail->Password = "s0336644";
    $mail->From = "sender@clientes.fraganciasoasis.com";
    $mail->FromName = "Fragancias Oasis - Bloked IP";
    /* Hasta Aqui */
    $correo = 'freedom8604@hotmail.com'; // Correo del administrador donde llegarà el correo cuando una IP se bloquee
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
/*  $mail->Host = "stream.suranetworksolution.com";
    $mail->Port = 25;
    $mail->Username = "sender@suranetworksolution.com";
    $mail->Password = "aleluya1";
    $mail->From = "sender@suranetworksolution.com";
    $mail->FromName = "Fragancias Oasis";
    /* Hasta Aqui */

    /*Datos Host Silma */
    $mail->Host = "mail.ntchosting.com";
    $mail->Port = 2525;
    $mail->Username = "silma.natera@venezuelansmind.com";
    $mail->Password = "s0336644";
    $mail->From = "silma.natera@venezuelansmind.com";
    $mail->FromName = "Fragancias Oasis - New Register";
    /* Hasta Aqui */
    $correo = 'silma.natera@gmail.com'; // Correo del administrador donde llegarà el correo cuando un nuevo usuario se registre
                                        // en $correo iria el de Erick
    $mail->AddAddress($correo);// Direccion de correo del admin
    $mail->IsHTML(true);
    $mail->Subject = "New Register";

    $cuerpo="Se ha registrado un nuevo usuario en el Sistema de Fragancias Oasis<br><br>";
    $cuerpo.="Su correo es: ".$email." y su numero de telefono es: ".$phone.".<br>";
    $cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";

    $mail->Body=$cuerpo;

    if(!$mail->Send()) {
        //print "<script>alert('There are problems sending the email. Try later.')</script>";
        //header("Location: ../index.php");
        return $respuesta=0;
    }
    
    return $respuesta;  
}



$SQLSt = "SELECT * FROM users WHERE user = '" . $_REQUEST['username'] . "' AND password = '" . $_REQUEST['password'] . "'";

$result = mysql_query($SQLSt);
$myrows = mysql_num_rows($result);

if($myrows>0){
    //var_dump('entra aqui');exit();
    //$detail= mysqli_fetch_array($result);
    while ($detail=mysql_fetch_assoc($result)) {
        //var_dump($detail['type']);exit();
        $_SESSION['type']=$detail['type'];
        $_SESSION['role']=$detail['role'];
        $_SESSION['user'] = $detail['user'];
    }
     
}

// Obtengo la IP
$Ip = $_SERVER['REMOTE_ADDR'];

if($myrows > 0) // if find user, then...
{   

	$row = mysql_fetch_row($result);

        //$_SESSION['user'] = $row[1];
        //var_dump($_SESSION['user']);exit();
        $user=$_SESSION['user'];
        $ipaddress = '';
    if ($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else
        $ipaddress = 'UNKNOWN';
    date_default_timezone_set("America/New_York");

    $log_date=date("Y-m-d h:i:s");

    $query=mysql_query("insert into logs(user,ip,log_date)values('$user','$ipaddress','$log_date')");
    // Si logra entrar se borra de la tabla de Ip Bloqueadas
    $SQLSt = "DELETE FROM registeraccess WHERE ip_numer = '".$Ip."'";
    
    $result = mysql_query($SQLSt);
    header("Location: dashboard.php");
}else{
    
    // Busco la IP para ver si ha entrado antes.
    $loginquery=$mysqli->query("select * from registeraccess where ip_numer='".$Ip."'") ; 
    $data=mysqli_fetch_assoc($loginquery);
    // Si no ha entrado antes lo inserto
    if ($data==NULL){
        //significa que esa Ip no existe.
        $SQLSt = "INSERT INTO registeraccess (ip_numer,access_number,site) VALUES ('".$Ip."',1,'login')";
        $sql=mysql_query($SQLSt);
        header("Location: login_failed.php");
    }else{
    
        // Si ha entrado 3 veces se bloquea
        if($data['access_number']==3){
            // Enviar correo con datos de ip bloqueda
            // old function    $answermail=sendemailadmin($Ip);
            /* Hasta Aqui */
                $sql = "select to_admin from smtp_config where '0'='0'";
                $res = mysql_query($sql);
                $smtp_info = mysql_fetch_array($res);
                
        		$to=explode(',',$smtp_info['to_admin']);
                
                //$to[]= 'freedom8604@hotmail.com'; // Correo del administrador donde llegarà el correo cuando una IP se bloquee
                $sub = "Bloked IP";
            
                $cuerpo="La IP: ".$Ip." ha intentado registrarse en tres oportunidades en el Sistema de Fragancias Oasis<br><br>";
                $cuerpo.="Esta IP  ha sido bloqueada por el sistema. En caso que necesite desbloquearla entre en el administrador.<br>";
                $cuerpo.="Este correo es envia automáticamente por nuestro sistema, por favor, no responda ni reenvíe mensajes a esta dirección"."<br>";
            
                $body=$cuerpo;
                
            $answermail=new_sendmail($to,$sub,$body,$attach='',$attach_as='',$cc='');
            if($answermail==1){
                header("Location: login_bloqued.php"); // Usuario ha sido bloquedado y se envia correo al admin  
            }else{
                header("Location: login_bloqued.php"); // Usuario ha sido bloquedado, si hay problemas con el correo igualmente se bloquea el admin  
            }

            
        }else{
            // Si ha entrado menos de 3 veces se le suma 1 al nro de intentos
            $SQLSt=$mysqli->query("update registeraccess set access_number = access_number+1 WHERE ip_numer = '".$Ip."'");
            header("Location: login_failed.php");
        }
    }
        
}
 
mysql_close($con);
?>