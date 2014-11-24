<?php
$fields_string = ''; 
$url = 'http://server/api.php';
$fields = array(
	'type' => 'send-mail',
	'smtp' => urlencode('smtp.gmail.com'),
	'user' => urlencode('user@gmail.com'),
	'password' => urlencode('password'),
	'smtpsecure' => urlencode('tls'),
	'from' => urlencode('example@example.com'),
	'fromname' => urlencode('John Smith'),
	'to' => urlencode('pocahontas@usa.com'),
	'toname' => urlencode('Pocahontas'),
	'subject' => urlencode('I love your country'),
	'body' => urlencode('Nice to meet you.')
);

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 1);

$result = curl_exec($ch);
curl_close($ch);
