<?php  
	$msg = "First line of text Second line of text";

	$msg .= "\n<h2> Brill está saindo da Jaula um monstro Briiiiillll...</h2>";

	$msg .= "\n Vc Acaba de Ganha um milhão apenas grite alto Briiiiillll";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
if(mail("igor@aqcez.com.br","My subject",$msg)){
	echo "sent";
}else{
	echo "Error While sending email";
}

?>