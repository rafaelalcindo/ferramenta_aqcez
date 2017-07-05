<?php

require_once('db_solicitar_sql.php');
require_once('../phpmailer/PHPMailerAutoload.php');
require_once('../phpmailer/class.phpmailer.php');
require_once('../phpmailer/class.smtp.php');

Class Solicitar_Orcamento{

	private $sele_Seg;
	private $pedido;
	private $observacao;

	private $orc_reforma;

	private $estrutura;

	private $img_upload;
	private $img_path;

	private $area;

	private $quando;

	private $sele_urg;
	private $nome_orc;
	private $emp_orc;
	private $tel_orc;
	private $cel_orc;
	private $email_orc;
	private $sele_est;
	private $sele_cid;

	function __construct(){

	}

	function __destruct(){

	}

	public function getSele_seg(){
		return $this->sele_Seg;
	}

	public function setSele_seg($sele_seg){
		
		$this->sele_Seg = $sele_seg;
	}

	public function getPedido(){
		return  implodeArray($this->pedido);
	}

	public function setPedido($pedido){
		
		$this->pedido = $pedido;
	}

	public function getObservacao(){
		return $this->observacao;
	}

	public function setObservacao($observacao){
		
		$this->observacao = $observacao;
	}

	public function getEstrutura(){
		return $this->estrutura;
	}

	public function setEstrutura($estrutura){
		$this->estrutura = $estrutura;
	}

	public function getTipoReforma(){
		return $this->orc_reforma;
	}

	public function setTipoReforma($orc_reforma){
		$this->orc_reforma = $orc_reforma;
	}

	public function getArea(){
		return $this->area;
	}

	public function setArea($area){
		$this->area = $area;
	}

	public function getQuando(){
		return $this->quando;
	}

	public function setQuando($quando){
		$this->quando = $quando;
	}

	public function getImgUpload(){
		return $this->img_upload;
	}

	public function getImgUploadPath(){
		return $this->img_path;
	}

	public function setImgUpload($imgUpload){

		if($imgUpload['size'] != 0){
			$db_solicitar  = new connection_solicitar();
			$qnt_soli = $db_solicitar->getQuantSoli();
			$qnt_soli = $qnt_soli++;
			$dir = "/up_foto_pedido/".$qnt_soli;
			mkdir("..".$dir);
			$this->img_path	  = $dir;
			$result = moveFileUplaod($dir, $imgUpload);
			if($result != false){
				//echo "<br/>resultado File: ".$result;
				$this->img_upload = $imgUpload['name'];		
			}
				
		}else{
			$this->img_path   = null;
			$this->img_upload = null;
		}

		
	}

	public function getUrgencia(){
		return $this->sele_urg;
	}

	public function setUrgencia($sele_urg){
		
		$this->sele_urg = $sele_urg;
	}

	public function getNome(){
		return $this->nome_orc;
	}

	public function setNome($nome_orc){
		
		$this->nome_orc = $nome_orc;
	}

	public function getEmpresa(){
		return $this->emp_orc;
	}

	public function setEmpresa($emp_orc){
		
		$this->emp_orc = $emp_orc;
	}

	public function getTelefone(){
		return $this->tel_orc;
	}

	public function setTelefone($tel_orc){
		
		$this->tel_orc = $tel_orc;
	}

	public function getCelular(){
		return $this->cel_orc;
	}

	public function setCelular($cel_orc){
		
		$this->cel_orc = $cel_orc;
	}

	public function getEmail(){		
		return $this->email_orc;
	}

	public function setEmail($email_orc){
		
		$this->email_orc = $email_orc;
	}

	public function getEstado(){
		$db_pegarEstado = new connection_solicitar();
		$resulEstado = $db_pegarEstado->getEstado($this->sele_est);

		while($row = $resulEstado->fetch_assoc()){
			$estado = $row['nome'];
		}

		return $estado;
	}

	public function setEstado($sele_est){
		
		$this->sele_est = $sele_est;
	}

	public function getCidade(){
		$db_pegarCidade = new connection_solicitar();
		$resulCidade = $db_pegarCidade->getCidade($this->sele_cid);

		while($row = $resulCidade->fetch_assoc()){
			$cidade = $row['nome'];
		}

		return $cidade;
	}

	public function setCidade($sele_cid){
		
		$this->sele_cid = $sele_cid;
	}

	public function salvarSolicitacao(){

		$solicitar = array();		
		$solicitar['seg'] 			= $this->sele_Seg;
		$solicitar['pedido']   		= implodeArray($this->pedido);
		$solicitar['observ']   		= $this->observacao;
		$solicitar['upload_path']   = $this->img_path;
		$solicitar['upload_name']	= $this->img_upload;
		$solicitar['urgencia'] 		= $this->sele_urg;
		$solicitar['nome'] 	   		= $this->nome_orc;
		$solicitar['empresa']  		= $this->emp_orc;
		$solicitar['telefone'] 		= $this->tel_orc;
		$solicitar['celular']  		= $this->cel_orc;
		$solicitar['email']    		= $this->email_orc;
		$solicitar['estado']   		= $this->sele_est;
		$solicitar['cidade']   		= $this->sele_cid;
		
		$solicitar['estrutura'] 	= $this->estrutura;
		$solicitar['area']			= $this->area;
		$solicitar['tipo_reforma']	= $this->orc_reforma;
		$solicitar['quando'] 		= $this->quando;

		$db_solicitar   = new connection_solicitar();
		$resultado_soli = $db_solicitar->salvarSolicitacao($solicitar);
		//sendEmail($solicitar);
		if($resultado_soli){

			return true; 
		}else{ return false; }

	}

	public function consultarOrcamento(){
		$db_consuOrc = new connection_solicitar();
		$consuOrc  	 = $db_consuOrc->getlistOrcamento();

		$consu_array = array();
		$consu_info  = array();

		while ($row = $consuOrc->fetch_assoc()) {
			$consu_array['seg']   		  = $row['seg'];
			$consu_array['preci'] 		  = fixArrayPreci(explodeFile($row['preci']));
			$consu_array['especificacao'] = utf8_encode($row['especificacao']);
			$consu_array['necessidade']   = $row['necessidade'];
			$consu_array['nome']		  = $row['nome'];
			$consu_array['emp']			  = $row['emp'];
			$consu_array['telefone']	  = $row['telefone'];
			$consu_array['celular']		  = $row['celular'];
			$consu_array['email']		  = $row['email'];
			$consu_array['estado']		  = utf8_encode($row['estado']);
			$consu_array['cidade']		  = utf8_encode($row['cidade']);
			$consu_array['data'] 		  = $row['soli_data'];

			$consu_info[] = $consu_array;
			unset($consu_array);
		}
		
		
		return $consu_info;
	}


}



// Funções normais...............................................................

function implodeArray($fileArray){
	$new_array = implode(",", $fileArray);
	return $new_array;
}

function explodeFile($fileExplode){
	$array_file = explode(",", $fileExplode);
	return $array_file; 
}

function moveFileUplaod($dir, $file){
	

	if(is_dir("../".$dir)){
		$dir = $dir."/".$file['name'];
		$ext_img = array('jpg','gif','png','jpeg','pdf');	
		$ext = strtolower(end(explode(".", $file['name'])));
		if(array_search($ext, $ext_img) === 0 || array_search($ext, $ext_img) === 1 || array_search($ext, $ext_img) === 2 || array_search($ext, $ext_img)=== 3 || array_search($ext, $ext_img) === 4){
			
			if(move_uploaded_file($file['tmp_name'], "..".$dir)){
				$foto = $file['name'];
				return $foto;
			}else{
				return false;
			}
		}else{ return false; }
	}else{  return false; }
	
}

/*function sendEmail($solicitar){
	
	$mail = new PHPMailer;

	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth  = true;
	$mail->SMTPDebug = 2; 
	$mail->Username = 'rafael10expert@gmail.com';
	$mail->Password = 'Rafael22';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;

	$mail->setFrom('rafael10expert@gmail.com','Rafael');
	$mail->addAddress('rafael10expert@gmail.com');
	$mail->isHTML();

	$mail->Subject = 'Envio para gmail';
	$mail->Body    = '<p>Enviando um email para Rafael</p>';

	if(!$mail->send()){
		echo "A mensagem não foi enviada<br/>";
		echo "<br/>Mailer error: ".$mail->ErrorInfo;
	}else {
		echo "Message has been sent";
	}

	

}*/

function fixArrayPreci($array){
	$array_assit = array();
	foreach ($array as $key => $value) {
		

		$array_assit[] = putNamesOriginalForm($value);
	}
	
	return $array_assit;
}

function putNamesOriginalForm($precisa){
	if($precisa == 'protecao_limpeza'){ 	   return "Proteção Limpeza"; }
	else if($precisa == 'demolicao'){ 		   return "Demolição"; }
	else if($precisa == 'civil'){ 			   return "Civil"; }
	else if($precisa == 'eletrica'){ 		   return "Eletrica"; }
	else if($precisa == 'dados_de_voz'){ 	   return "Dados de Voz"; }
	else if($precisa == 'hidraulica'){ 		   return "Hidráulica"; }
	else if($precisa == 'combate_a_incendio'){ return "Combate a Incendio"; }
	else if($precisa == 'controle_a_acesso'){  return "Controle de Acesso"; }
	else if($precisa == 'obra_completa'){ 	   return "Obra Completa"; }
	else if($precisa == 'ar_condicionado'){	   return "Ar Condicionado"; }
	else if($precisa == 'marcenaria'){		   return "Marcenaria"; }
	else if($precisa == 'serralheria'){		   return "Serralheria"; }
	else if($precisa == 'marmore_granito'){	   return "Marmore/Granito"; }
	else if($precisa == 'mudanca'){			   return "Mudança"; }
	else if($precisa == 'gesso'){			   return "Gesso"; }
	else if($precisa == 'forro_modular'){ 	   return "Forro Modular"; }
	else if($precisa == 'pintura'){ 		   return "Pintura"; }
	else if($precisa == 'outros'){			   return "Outros";	}
}