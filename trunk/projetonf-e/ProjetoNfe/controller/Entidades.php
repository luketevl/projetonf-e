<?php

class Entidade{
	
	private $nome;
	private $endereco;
	private $telefone;
	private $cpf_cnpj;
	private $ie;
	
	
	public function getNome(){
		return $this->nome ;
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
	
	public function setNome($value){
		$this->nome=$value;
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
}