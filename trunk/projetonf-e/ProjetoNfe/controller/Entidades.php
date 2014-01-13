<?php

class Entidade{
	
	private $nome;
	private $nomeFantasia;

	private $endereco;
	private $telefone;
	private $cpf_cnpj;
	private $ie;
	private $im;
	private $crt;
	private $cnae;
	
	
	public function getNome(){
		return $this->nome ;
	}
	public function getNomeFantasia(){
		return $this->nomeFantasia ;
	}
	public function getEndereco(){
		return $this->endereco ;
	}
	public function getTelefone(){
		return $this->telefone ;
	}
	public function getCpf_cnpj(){
		return $this->cpf_cpnj ;
	}
	public function getIe(){
		return $this->ie ;
	}
	public function getIm(){
		return $this->im ;
	}
	public function getCrt(){
		return $this->crt ;
	}
	public function getCnae(){
		return $this->cnae;
	}
	
	public function setNome($value){
		$this->nome=$value;
	}
	public function setNomeFantasia($value){
		$this->nomeFantasia=$nomeFantasia;
	}
	public function setEndereco($value){
		$this->endereco=$value;
	}
	public function setTelefone($value){
		$this->telefone=$value;
	}
	public function setCpf_cnpj($value){
		$this->cpf_cpnj=$value;
	}
	public function setIe($value){
		 $this->ie=$value;
	}
	public function setIm($value){
		 $this->im=$value;
	}
	public function setCrt($value){
		 $this->crt=$value;
	}
	public function setCnae($value){
		 $this->cnae=$value;
	}

}