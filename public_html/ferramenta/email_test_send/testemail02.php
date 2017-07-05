<?php

	$to = 'rafael.alcindo@aqcez.com.br';

	$subject = 'Teste email bonitinho!';

	$headers = "From: bruno@aqcez.com.br \r\n";
	$headers .= "Reply-To: igor@aqcez.com.br \r\n";
	$headers .= "CC: rafael_alcindo@hotmail.com \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	$message = "<html><body>";

	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">' ;
	$message .= '<tr style="background: #eee"><td><strong>Name: </strong> </td><td>Teste Envio</td> </tr>';
	$message .= '<tr><td><strong>Email: </strong></td> <td>rafael_alcindo@aqcez.com.br</td> </tr>';
	$message .= '<tr><td><strong>Teste em teste</strong></td> <td>Saindo um teste</td></tr>';

	$message .= "</body></html>";

	if(mail($to, $subject, $message, $headers)){
		echo "Email enviado com sucesso!";
	}else{
		echo "Erro ao eviar a mensagem!";
	}
