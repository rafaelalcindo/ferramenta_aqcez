<?php

	require('db_solicitar_fornecedor_sql.php');


class Fornecedor{

	private $nome;
	private $empresa;
	private $telefone;
	private $celular;
	private $email;
	private $cpf;
	private $endereco;
	private $numero;
	private $cep;
	private $estado;
	private $cidade;
	private $servico;
	private $especi;
	private $sobre;

	function __construct(){

	}

	function __destruct(){

	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getEmpresa(){
		return $this->empresa;
	}

	public function setEmpresa($empresa){
		$this->empresa = $empresa;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getCelular(){
		return $this->celular;
	}

	public function setCelular($celular){
		$this->celular = $celular;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public  function getCep(){
		return $this->cep;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}

	public function getEstado(){
		$db_pegarEstado = new connection_solicitar();
		$resulEstado = $db_pegarEstado->getEstado($this->estado);

		while($row = $resulEstado->fetch_assoc()){
			$estado = $row['nome'];
		}

		return $estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getCidade(){
		$db_pegarCidade = new connection_solicitar();
		$resulCidade = $db_pegarCidade->getCidade($this->cidade);

		while($row = $resulCidade->fetch_assoc()){
			$cidade = $row['nome'];
		}

		return $cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getServico(){
		return $this->servico;
	}

	public function setServico($servico){
		$this->servico = $servico;
	}

	public function getEspeci(){
		return $this->especi;
	}

	public function setEspeci($especi){
		$this->especi = $especi;
	}

	public function getSobre(){
		return $this->sobre;
	}

	public function setSobre($sobre){
		$this->sobre = $sobre;
	}



}