<?php
	
	session_start();

	$request_type = isset($_REQUEST['request'])? $_REQUEST['request'] : null;

	require_once('fornecedor.class.php');

	switch ($request_type) {
		case 'cadFornecedor':
				cad_fornecedor();
			break;
		
		default:
			# code...
			break;
	}

	function cad_fornecedor(){
		$servico = array();

		$nome_forn     = isset($_REQUEST['nome_forn'])? 	$_REQUEST['nome_forn'] 		: null;
		$emp_forn      = isset($_REQUEST['emp_forn'])? 		$_REQUEST['emp_forn'] 		: null;
		$tel_forn 	   = isset($_REQUEST['tel_forn'])? 		$_REQUEST['tel_forn'] 		: null;
		$cel_forn	   = isset($_REQUEST['cel_forn'])?		$_REQUEST['cel_forn']		: null;
		$email_forn    = isset($_REQUEST['email_forn'])?    $_REQUEST['email_forn'] 	: null;
		$endereco_forn = isset($_REQUEST['endereco_forn'])? $_REQUEST['endereco_forn'] 	: null;
		$numero_forn   = isset($_REQUEST['numero_forn'])?   $_REQUEST['numero_forn'] 	: null;
		$cep_forn 	   = isset($_REQUEST['cep_forn'])?      $_REQUEST['cep_forn'] 		: null;
		$estado_forn   = isset($_REQUEST['estado_forn'])?   $_REQUEST['estado_forn'] 	: null;
		$cidade_forn   = isset($_REQUEST['cidade_forn'])?   $_REQUEST['cidade_forn'] 	: null;
		$servico_forn  = isset($_REQUEST['servico_forn'])?  $_REQUEST['servico_forn']   : null;
		$especi_forn   = isset($_REQUEST['especi_forn'])?   $_REQUEST['especi_forn'] 	: null;
		$sobre_forn    = isset($_REQUEST['sobre_forn'])?    $_REQUEST['sobre_forn']  	: null;

		$fornecedor = new Fornecedor();

		$fornecedor->setNome($nome_forn);
		$fornecedor->setEmpresa($emp_forn);
		$fornecedor->setTelefone($tel_forn);
		$fornecedor->setCelular($cel_forn);
		$fornecedor->setEmail($email_forn);
		$fornecedor->setEndereco($endereco_forn);
		$fornecedor->setNumero($numero_forn);
		$fornecedor->setCep($cep_forn);
		$fornecedor->setEstado($estado_forn);
		$fornecedor->setCidade($cidade_forn);
		$fornecedor->setServico($servico_forn);
		$fornecedor->setEspeci($especi_forn);
		$fornecedor->setSobre($sobre_forn);

		EnviarEmail($fornecedor);

		$resultado = array();

		$resultado['resultado'] = true;

		echo json_encode($resultado);

	}




// --------------- função para enviar email --------------------

	function EnviarEmail($fornecedor){

		require_once "../phpmailer/PHPMailerAutoload.php";

	$titulo = "Formulario de Fornecedor";

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
	

	//$m->addAttachment("../".$soliObj->getImgUploadPath()."/".$soliObj->getImgUpload(), $soliObj->getImgUpload());

	$m->isHTML(true);


	$message = "<html><body>";

	/*echo "<br/>".$fornecedor->getNome();
	echo "<br/>".$fornecedor->getEmpresa();
	echo "<br/>".$fornecedor->getTelefone();
	echo "<br/>".$fornecedor->getCelular();
	echo "<br/>".$fornecedor->getEmpresa();
	echo "<br/>".$fornecedor->getEndereco();
	echo "<br/>".$fornecedor->getNumero();
	echo "<br/>".$fornecedor->getCep();
	echo "<br/>".$fornecedor->getEstado();
	echo "<br/>".$fornecedor->getCidade();
	echo "<br/>".$fornecedor->getServico();
	echo "<br/>".$fornecedor->getEspeci();
	echo "<br/>".$fornecedor->getSobre();
	*/

	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">' ;
	$message .= "<tr style='background: #eee'><td><strong>Nome: </strong> </td><td>".$fornecedor->getNome()."</td> </tr>";
	$message .= "<tr><td><strong>Empresa: </strong></td> <td>".$fornecedor->getEmpresa()."</td> </tr>";
	$message .= "<tr><td><strong>Telefone: </strong></td> <td>".$fornecedor->getTelefone() ."</td></tr>";
	$message .= "<tr><td><strong>Celular: </strong></td> <td>".$fornecedor->getCelular()."</td></tr>";
	$message .= "<tr><td><strong>Email: </strong></td> <td>".$fornecedor->getEmail()."</td></tr>";
	$message .= "<tr><td><strong>Endereço: </strong></td> <td>".$fornecedor->getEndereco()."</td></tr>";
	$message .= "<tr><td><strong>Número: </strong></td> <td>".$fornecedor->getNumero()."</td></tr>";
	
	$message .= "<tr><td><strong>Cep: </strong></td> <td>".$fornecedor->getCep()."</td></tr>";
	$message .= "<tr><td><strong>Estado: </strong></td> <td>".utf8_encode($fornecedor->getEstado())."</td></tr>";
	$message .= "<tr><td><strong>Cidade: </strong></td> <td>".utf8_encode($fornecedor->getCidade())."</td></tr>";
	$message .= "<tr><td><strong>Serviço: </strong></td> <td>".$fornecedor->getServico()."</td></tr>";
	$message .= "<tr><td><strong>Especificações: </strong></td> <td>".$fornecedor->getEspeci()."</td></tr>";
	$message .= "<tr><td><strong>Sobre: </strong></td> <td>".$fornecedor->getSobre()."</td></tr>";	


	$message .= "</body></html>";


	$m->Subject = $titulo;
	$m->Body = $message;
	$m->AltBody = 'This is the body of an email';

	//var_dump($m->send());

	if($m->send()){
		return true;
	}else{
		return false;
	}

	}