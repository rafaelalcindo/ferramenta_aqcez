<?php

 //Email Detials 
  $arquivo = $_FILES['arquivo'];


/*
  $mail_to = "rafael.alcindo@aqcez.com.br";
  $from_mail = "bruno@aqcez.com.br";
  $from_name = "Bruno";
  $reply_to = "igor@aqcez.com.br";
  $subject = "Este de anexo";
  $message = "Teste de envio sendo feito.";
 
  // Attachment File 
  // Attachment location
  $file_name = $arquivo['name'];
  $path = "http://www.aqcez.com.br/ferramenta/up_foto_pedido/22/";
   
  // Read the file content
  $file = $arquivo['tmp_name'];
  $file_size = filesize($file);
  $handle = fopen($file, "r");
  $content = fread($handle, $file_size);
  fclose($handle);
  $content = chunk_split(base64_encode($content));
   
 //   Set the email header 
  // Generate a boundary
  $boundary = md5(uniqid(time()));
   
  // Email header
  $header = "From: ".$from_mail.PHP_EOL;
  $header .= "Reply-To: ".$reply_to.PHP_EOL;
  $header .= "MIME-Version: 1.0".PHP_EOL;
   
  // Multipart wraps the Email Content and Attachment
  $header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
  $header .= "This is a multi-part message in MIME format.".PHP_EOL;
  $header .= "--".$boundary.PHP_EOL;
   
  // Email content
  // Content-type can be text/plain or text/html
  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
  $header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
  $header .= "$message".PHP_EOL;
  $header .= "--".$boundary.PHP_EOL;
   
  // Attachment
  // Edit content type for different file extensions
  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
  $header .= $content.PHP_EOL;
  $header .= "--".$boundary."--";
   
  // Send email
  if (mail($mail_to, $subject, "", $header)) {
    echo "Sent";
  } else {
    echo "Error";
  }

*/



 $filename = "batpurple.jpg";
 $path = "../up_foto_pedido/22";
 $file = $path."/".$filename;

 $mailto = 'rafael.alcindo@aqcez.com.br';
 $subject = 'Teste de email com anexo';
 $message = 'Um teste feito com anexo';

 $content = file_get_contents($file);
 $content = chunk_split(base64_encode($content));

 $separator = md5(time());

 $eol = "\r\n";


$headers = "From: bruno@aqcez.com.br".$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
$headers .= "This is a MIME encoded message." . $eol;

$body = "--" . $separator . $eol;
$body .= "Content-Type: text/plain; charset=\"urf\"" . $eol;
$body .= "Content-Transfer-Encoding: 8bit" . $eol;
$body .= $message . $eol;

 $body .= "--" . $separator . $eol;
 $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
 $body .= "Content-Transfer-Encoding: base64" . $eol;
 $body .= "Content-Disposition: attachment" . $eol;
 $body .= $content . $eol;
 $body .= "--" . $separator . "--";

 //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }


/*
$my_file = "batpurple.jpg";
$my_path = "../up_foto_pedido/22/";
$my_name = "Olaf Lederer";
$my_mail = "rafael.alcindo@aqcez.com.br";
$my_replyto = "igor@aqcez.com.br";
$my_subject = "This is a mail with attachment.";
$my_message = "Hallo,rndo you like this script? I hope it will help.rnrngr. Olaf";
mail_attachment($my_file, $my_path, "rafael.alcindo@aqcez.com.br", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
 

 function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {

	 $file = $path.$filename;
	 $file_size = filesize($file);
	 $handle = fopen($file, "r");
	 $content = fread($handle, $file_size);
	 fclose($handle);
	 $content = chunk_split(base64_encode($content));
	 $uid = md5(uniqid(time()));
	 $header = "From: ".$from_name." <".$from_mail.">\r\n";
	 $header .= "Reply-To: ".$replyto."\r\n";
	 $header .= "MIME-Version: 1.0\r\n";
	 $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	 $header .= "This is a multi-part message in MIME format.\r\n";
	 $header .= "--".$uid."\r\n";
	 $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	 $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	 $header .= $message."\r\n\r\n";
	 $header .= "--".$uid."\r\n";
	 $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
	 $header .= "Content-Transfer-Encoding: base64\r\n";
	 $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	 $header .= $content."\r\n\r\n";
	 $header .= "--".$uid."--";
	 if (mail($mailto, $subject, "", $header)) {
	 echo "mail send ... OK"; // or use booleans here
	 } else {
	 echo "mail send ... ERROR!";
	 }

}
*/



    