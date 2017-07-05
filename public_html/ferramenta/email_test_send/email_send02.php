<?php
	
	$nome = $_POST['nome'];
	$arquivo = $_FILES['arquivo'];

	$para = "rafael.alcindo@aqcez.com.br";
	$assunto = "Teste de envio";

	$boundary = "XYZ-".date("dmYis")."-ZYX";
	$fp = fopen($arquivo['tmp_name'] , "rb");
	$anexo = fread($fp, filesize($arquivo["tmp_name"]));
	$anexo = base64_encode($anexo);
	fclose($fp);


	// cabeçalho do email
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-Type: multipart/mixed; ";
	$headers .= "boundary=".$boundary."\r\n";
	$headers .= "$boundary\n";

	//email
	$message = "--$boundary\n";
	$message .= "Content-Type: text/html; charset='utf-8'\n";
	$message .= "<strong>Nome:</strong> $nome";
	$message .= "--$boundary \n";

	//anexo
	$message .= "Content-Type: ".$arquivo['type']."; name=".$arquivo['name']."\n";
	$message .= "Content-Transfer-Encoding: base64 \n";
	$message .= "Content-Disposition: attachment; filename=".$arquivo['name']."\n";
	$message .= "$anexo \n";
	$message .= "--$boundary \n";

	if(mail($para, $assunto, $message, $headers)){
		echo "Enviou!";
	}else{
		echo "Falhou!";
	}
