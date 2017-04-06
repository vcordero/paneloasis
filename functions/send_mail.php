<?php
//ini_set('display_errors','1');
    
function new_sendmail($to,$sub,$body,$attach='',$attach_as='',$cc='')
{
   // echo ("<per>");
    //print_r($to);
    
    //require_once('./phpmailer/class.phpmailer.php');
    //$smtp_info=get_single_row("host,port,from_email,from_name,sender,smtp_authentication,user_name,password","smtp_config","'0'='0'");
    $sql = "select host_name,port,from_email,to_admin,from_name,sender,smtp_authentication,user_name,password from smtp_config where '0'='0'";
    $res = mysql_query($sql);
    $smtp_info = mysql_fetch_array($res);
    //print_r($smtp_info['host_name']);
    //exit("123");
    $mail = new PHPMailer();
    $mail->IsMail();
    $mail->Host=$smtp_info['host_name'];
    $mail->Port=$smtp_info['port'];
    $mail->From=$smtp_info['from_email'];
    $mail->FromName=$smtp_info['from_name'];
    $mail->Sender=$smtp_info['sender'];
    $mail->SMTPAuth=$smtp_info['smtp_authentication']==1?true:false;
    $mail->Username=$smtp_info['user_name'];
    $mail->Password=$smtp_info['password'];
    if($attach!='')
    {
       $mail->AddAttachment($attach);   
    }    
    if(is_array($to)){
        foreach($to as $email){
            $mail->AddAddress($email);        
        }
    }else{
           $mail->AddAddress($to);
    }
    
    
    //$mail->AddCC($cc);
    $mail->Subject=$sub;
    $mail->IsHTML(true); // send as HTML
    //$mail->CharSet="windows-1251";
    //$mail->CharSet="utf-8";
    $mail->Body=$body;
    
    if($mail->Send())
    {
       	return $mailsent=1;
    }
    else{
        return 0;
    }
    //exit("end");
}

/*****-AD_new_sendmail-*****/
/*function new_sendmail($to,$sub,$body,$attach='',$attach_as='',$cc='')
{
    require_once('phpmailer/class.phpmailer.php');
    $smtp_info=get_single_row("host,port,from_email,from_name,sender,smtp_authentication,user_name,password","smtp_configuration","'0'='0'");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host=$smtp_info['host'];
    $mail->Port=$smtp_info['port'];
    $mail->From=$smtp_info['from_email'];
    $mail->FromName=$smtp_info['from_name'];
    $mail->Sender=$smtp_info['sender'];
    $mail->SMTPAuth=true;
    $mail->Username=$smtp_info['user_name'];
    $mail->Password=$smtp_info['password'];
    if($attach!='')
    {
       $mail->AddAttachment($attach);   
    }    
    $mail->AddAddress($to);
    //$mail->AddCC($cc);
    $mail->Subject=$sub;
    $mail->IsHTML(true); // send as HTML
    //$mail->CharSet="windows-1251";
    //$mail->CharSet="utf-8";
    $mail->Body=$body;
    if($mail->Send())
    {
       	return $mailsent=1;
    }
}*/
/*****-End-*****/    
?>
