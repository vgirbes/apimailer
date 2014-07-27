<?php
require 'phpmailer/PHPMailerAutoload.php';
if ($_POST){

	foreach($_POST as $nombre_campo => $valor){ 
		$$nombre_campo = $valor;
	}

	switch ($type){
		case 'send-mail':
			$sender_config['smtp'] = $smtp;
			$sender_config['user'] = $user;
			$sender_config['password'] = $password;
			$sender_config['smtpsecure'] = $smtpsecure;
			$message_config['from'] = $from;
			$message_config['fromname'] = $fromname;
			$message_config['to'] = $to;
			$message_config['toname'] = $toname;
			$message_config['subject'] = $subject;
			$message_config['body'] = $body;
			$result = send_mail($sender_config, $message_config);
		break;
	}

	print json_encode($result);
}

function send_mail($sender, $message){
	$mail = new PHPMailer;

	$mail->isSMTP();                                      
	$mail->Host = $sender['smtp'];  
	$mail->SMTPAuth = true;                               
	$mail->Username = $sender['user'];                 
	$mail->Password = $sender['password'];                           
	$mail->SMTPSecure = $sender['smtpsecure'];                            
	$mail->From = $message['from'];
	$mail->FromName = $message['fromname'];
	$mail->addAddress($message['to'], $message['toname']);     

	$mail->isHTML(true);                                  

	$mail->Subject = $message['subject'];
	$mail->Body    = $message['body'];

	if(!$mail->send()){
	    $result = 'Mailer Error: ' . $mail->ErrorInfo;
	    return $result;
	}else{
	    return true;
	}
}