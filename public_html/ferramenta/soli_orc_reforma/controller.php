<?php
require('../db_connection.php');

session_start();

$request_type = isset($_REQUEST['request'])? $_REQUEST['request'] : null;

require_once('solicitar.Class.php');

switch ($request_type) {
	
	case 'cadOrcamento':
		cad_Orcamento();
	break;

	case 'consultaOrcamentos':
		ConsultOrc();
	break;
	
	default:
		# code...
	break;
}



function cad_Orcamento(){

	$pedido = array(); 
	$sele_seg   = isset($_REQUEST['segmento'])? 		    $_REQUEST['segmento'] 	 		 : null;

	$estrutura  = isset($_REQUEST['estrutura'])?			$_REQUEST['estrutura']   		 : null;

	$pedido_normal    = isset($_REQUEST['servico'])?		$_REQUEST['servico']		 	 : null;
	//echo "<br/>Pedido: ".$pedido;
	$pedido = explode(",", $pedido_normal);
	$observacao   = isset($_REQUEST['especi_estru'])?  		$_REQUEST['especi_estru']        : null;

	$tipo_reforma = isset($_REQUEST['tipo_reforma'])?		$_REQUEST['tipo_reforma']		 : null;

	$area		= isset($_REQUEST['area'])?					$_REQUEST['area']				 : null;

	$upload_img = isset($_FILES['file'])?					$_FILES['file']			 		 : null;
	$sele_urg   = isset($_REQUEST['urgencia'])?				$_REQUEST['urgencia']			 : null;

	$quando		= isset($_REQUEST['quando'])?				$_REQUEST['quando']				 : null;

	$nome_orc   = isset($_REQUEST['nome'])? 				$_REQUEST['nome'] 		 		 : null;
	$emp_orc    = isset($_REQUEST['emp'])?					$_REQUEST['emp'] 		 		 : null;
	$tel_orc 	= isset($_REQUEST['tel'])?					$_REQUEST['tel']		 		 : null;
	$cel_orc    = isset($_REQUEST['cel'])?					$_REQUEST['cel']		 		 : null;
	$email_orc  = isset($_REQUEST['email'])? 				$_REQUEST['email']		 		 : null;
	$sele_est   = isset($_REQUEST['estado'])? 				$_REQUEST['estado']		 		 : null;
	$sele_cid	= isset($_REQUEST['cidade'])? 				$_REQUEST['cidade']		 		 : null;

	/*
	echo $sele_seg."<br/>";
	echo "<br/>".print_r($pedido);
	echo "<br/>".$observacao;
	echo "<br/>".$upload_img['name'];
	echo "<br/>".$sele_urg;
	echo "<br/>".$nome_orc;
	echo "<br/>".$emp_orc;
	echo "<br/>".$tel_orc;
	echo "<br/>".$cel_orc;
	echo "<br/>".$email_orc;
	echo "<br/>".$sele_est;
	echo "<br/>".$sele_cid;
	*/

	$soli_orc = new Solicitar_Orcamento();
	$soli_orc->setSele_seg($sele_seg);

	$soli_orc->setPedido($pedido);
	$soli_orc->setArea($area);
	$soli_orc->setTipoReforma($tipo_reforma);
	$soli_orc->setQuando($quando);

	$soli_orc->setEstrutura($estrutura);
	$soli_orc->setObservacao($observacao);
	$soli_orc->setImgUpload($upload_img);

	$soli_orc->setUrgencia($sele_urg);
	$soli_orc->setNome($nome_orc);
	$soli_orc->setEmpresa($emp_orc);
	$soli_orc->setTelefone($tel_orc);
	$soli_orc->setCelular($cel_orc);
	$soli_orc->setEmail($email_orc);
	$soli_orc->setEstado($sele_est);
	$soli_orc->setCidade($sele_cid);
	
	$result_soli = $soli_orc->salvarSolicitacao();
	$email_resu  = sendEmail($soli_orc);


	$resultado = array();

	if($result_soli){		
		$resultado['resultado'] = true;
		echo json_encode($resultado);
	}else{
		$resultado['resultado'] = false;
		echo json_encode($resultado);
	}

}


function ConsultOrc(){
	$consu_soli = new Solicitar_Orcamento();
	$resu_consu = $consu_soli->consultarOrcamento();
	$resuJsonConsu = json_encode($resu_consu);
	echo $resuJsonConsu;
}




// --------------------------------------- Função de Enviar Email ------------------------------------------

function sendEmail($soliObj){

	/*
	
	$to = 'rafael.alcindo@aqcez.com.br, bruno@aqcez.com.br';

	$subject = 'Pedido de Orçamento!';

	$headers = "From: rafael.alcindo@aqcez.com.br \r\n";
	
	$headers .= "CC: igor@aqcez.com.br \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	$message = "<html><body>";

	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">' ;
	$message .= "<tr style='background: #eee'><td><strong>Segmento: </strong> </td><td>".$soliObj->getSele_seg()."</td> </tr>";
	$message .= "<tr><td><strong>Estrutura: </strong></td> <td>".$soliObj->getEstrutura()."</td> </tr>";
	$message .= "<tr><td><strong>Observação: </strong></td> <td>".$soliObj->getObservacao() ."</td></tr>";
	$message .= "<tr><td><strong>Área: </strong></td> <td>".$soliObj->getArea()."</td></tr>";
	$message .= "<tr><td><strong>Serviços: </strong></td> <td>".$soliObj->getPedido()."</td></tr>";
	$message .= "<tr><td><strong>Urgencia: </strong></td> <td>".$soliObj->getUrgencia()."</td></tr>";
	$message .= "<tr><td><strong>Quando: </strong></td> <td>".$soliObj->getQuando()."</td></tr>";
	$message .= "<tr><td><strong>Arquivo caminho: </strong></td> <td><a href='aqcez.com.br/ferramenta".$soliObj->getImgUploadPath()."/".$soliObj->getImgUpload()." '>Link do Arquivo</a>  </td></tr>";
	$message .= "<tr><td><strong>Nome: </strong></td> <td>".$soliObj->getNome()."</td></tr>";
	$message .= "<tr><td><strong>Empresa: </strong></td> <td>".$soliObj->getEmpresa()."</td></tr>";
	$message .= "<tr><td><strong>Telefone: </strong></td> <td>".$soliObj->getTelefone()."</td></tr>";
	$message .= "<tr><td><strong>Celular: </strong></td> <td>".$soliObj->getCelular()."</td></tr>";
	$message .= "<tr><td><strong>Email: </strong></td> <td>".$soliObj->getEmail()."</td></tr>";
	$message .= "<tr><td><strong>Estado: </strong></td> <td>". utf8_encode($soliObj->getEstado())."</td></tr>";
	$message .= "<tr><td><strong>Cidade: </strong></td> <td>". utf8_encode($soliObj->getCidade())."</td></tr>";


	$message .= "</body></html>";

	if(mail($to, $subject, $message, $headers)){
		return true;
	}else{
		return false;
	}*/

	require_once "../phpmailer/PHPMailerAutoload.php";

	$m = new PHPMailer;
	$m->CharSet = 'UTF-8';
	$m->isSMTP();
	$m->SMTPAuth = true;
	//$m->SMTPDebug = 2;


	$m->Host = 'br566.hostgator.com.br';
	$m->Username = 'contato@goconstruct.com.br';
	$m->Password = 'Contato123*';
	$m->SMTPSecure = 'ssl';
	$m->Port = 465;

	$m->From = 'contato@goconstruct.com.br';
	$m->FromName = 'Contato';
	$m->addReplyTo('rafael@goconstruct.com.br','Reply address');
	$m->addAddress('rafael@goconstruct.com.br','Rafael');
	$m->addAddress('igor@goconstruct.com.br','Igor');
	$m->addAddress('bruno@goconstruct.com.br','Bruno');
	

	$m->addAttachment("../".$soliObj->getImgUploadPath()."/".$soliObj->getImgUpload(), $soliObj->getImgUpload());

	$m->isHTML(true);


	$message = "<html><body>";

	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">' ;
	$message .= "<tr style='background: #eee'><td><strong>Segmento: </strong> </td><td>".$soliObj->getSele_seg()."</td> </tr>";
	$message .= "<tr><td><strong>Estrutura: </strong></td> <td>".$soliObj->getEstrutura()."</td> </tr>";
	$message .= "<tr><td><strong>Observação: </strong></td> <td>".$soliObj->getObservacao() ."</td></tr>";
	$message .= "<tr><td><strong>Tipo de Reforma: </strong></td> <td>".$soliObj->getTipoReforma()."</td></tr>";
	$message .= "<tr><td><strong>Área: </strong></td> <td>".$soliObj->getArea()."</td></tr>";
	$message .= "<tr><td><strong>Serviços: </strong></td> <td>".$soliObj->getPedido()."</td></tr>";
	$message .= "<tr><td><strong>Urgencia: </strong></td> <td>".$soliObj->getUrgencia()."</td></tr>";
	$message .= "<tr><td><strong>Quando: </strong></td> <td>".$soliObj->getQuando()."</td></tr>";
	$message .= "<tr><td><strong>Caminho do arquivo: </strong></td> <td><a href='aqcez.com.br/ferramenta".$soliObj->getImgUploadPath()."/".$soliObj->getImgUpload()." '>Link do Arquivo</a>  </td></tr>";
	$message .= "<tr><td><strong>Nome: </strong></td> <td>".$soliObj->getNome()."</td></tr>";
	$message .= "<tr><td><strong>Empresa: </strong></td> <td>".$soliObj->getEmpresa()."</td></tr>";
	$message .= "<tr><td><strong>Telefone: </strong></td> <td>".$soliObj->getTelefone()."</td></tr>";
	$message .= "<tr><td><strong>Celular: </strong></td> <td>".$soliObj->getCelular()."</td></tr>";
	$message .= "<tr><td><strong>Email: </strong></td> <td>".$soliObj->getEmail()."</td></tr>";
	$message .= "<tr><td><strong>Estado: </strong></td> <td>". utf8_encode($soliObj->getEstado())."</td></tr>";
	$message .= "<tr><td><strong>Cidade: </strong></td> <td>". utf8_encode($soliObj->getCidade())."</td></tr>";


	$message .= "</body></html>";


	$m->Subject = 'Pedido de orçamento de Reforma!';
	$m->Body = $message;
	$m->AltBody = 'This is the body of an email';

	//var_dump($m->send());

	if($m->send()){
		return true;
	}else{
		return false;
	}

}