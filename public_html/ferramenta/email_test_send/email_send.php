<?php
	if(isset($_POST) && !empty($_POST)){
		if(!empty($_FILES['anexo']['name'])){
			// store some variables

			$file_name = $_FILES['anexo']['name'];
			$temp_name = $_FILES['anexo']['tmp_name'];
			$file_type = $_FILES['anexo']['type'];

			$base = basename($file_name);
			$extension = substr($base, strlen($base)-4, strlen($base));

			$allowed_extensions = array(".doc",".docx",".pdf",".zip",".png",".jpeg");

			if(in_array($extension, $allowed_extensions)){
				$from 	 = $_POST['email'];
				$to   	 = "rafael.alcindo@aqcez.com.br";
				$subject = "Teste de email com anexo!";
				$message = "Essa pagina é de anexo randomica.";

				$file = $temp_name;
				$content = chunk_split(base64_encode(file_get_contents($file)));
				$uid = md5(uniqid(time()));

				$header = "From: ".$from."\r\n";
				
				$header .= "MIME-Version: 1.0\r\n";

				$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
				$header .= "This is a multi-part message in MIME format.\r\n";

				$header .= "--".$uid."\r\n";
				$header .= "Content-Type:text/plain; charset=utf-8\r\n";
				$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
				$header .= $message."\r\n\r\n";

				$header .= "--".$uid."\r\n";
				$header .= "Content-Type: ".$file_type."; name=\"".$file_name."\"\r\n";
				$header .= "Content-Transfer-Encoding: base64\r\n";
				$header .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n";
				$header .= $content."\r\n\r\n";

				if(mail($to, $subject,"",$header)){
					echo "success";
				}else
				{
					echo "fail";
				}



			}else{
				echo "file type not allowed";
			}


		}else{
			echo "no file posted";
		}
	}