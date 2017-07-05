<?php

	require_once "phpmailer/PHPMailerAutoload.php";

	$m = new PHPMailer;

	$m->isSMTP();
	$m->SMTPAuth = true;
	//$m->SMTPDebug = 2;


	$m->Host = 'br566.hostgator.com.br';
	$m->Username = 'rafael.alcindo@aqcez.com.br';
	$m->Password = 'Rafael123*';
	$m->SMTPSecure = 'ssl';
	$m->Port = 465;

	$m->From = 'rafael.alcindo@aqcez.com.br';
	$m->FromName = 'Rafael';
	$m->addReplyTo('rafael.alcindo@aqcez.com.br','Reply address');
	$m->addAddress('rafael.alcindo@aqcez.com.br','Rafael');

	$m->addAttachment('../up_foto_pedido/22/batpurple.jpg', 'batpurple.jpg');

	$m->isHTML(true);

	$m->Subject = 'Here is an email';
	$m->Body = '<p>This is the body of an email</p><h2>Teste uuuuuuuuuuu Briiiiilll</h2>';
	$m->AltBody = 'This is the body of an email';

	//var_dump($m->send());

	if($m->send()){
		echo "Enviou!";
	}else{
		echo $m->ErrorInfo;
	}