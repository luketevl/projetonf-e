<?php
class Enderecos {
	private $rua;
	private $numero;
	private $bairro;
	private $cidade;
	private $estado;
	private $pais;
	private $cep;	
	private $codUF;

	public function getRua(){
		return $this->rua ;
	}
	
	public function getNumero(){
		return $this->numero ;
	}
	
	public function getBairro(){
		return $this->bairro ;
	}
	
	public function getCidade(){
		return $this->cidade ;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	
	public function getPais(){
		return $this->pais;
	}
	
	public function getCep(){
		return $this->cep ;

	}public function getCodUF(){
		return $this->codUF ;
	}
	
	public function setRua($value){
		return $this->rua= $value ;
	}
	
	public function setNumero($value){
		return $this->numero= $value ;
	}
	
	public function setBairro($value){
		return $this->bairro= $value ;
	}
	
	public function setCidade($value){
		return $this->cidade= $value ;
	}
	
	public function setEstado($value){
		return $this->estado= $value ;
	}
	
	public function setPais($value){
		return $this->pais= $value ;
	}
	
	public function setCep($value){
		return $this->cep= $value ;
	}
	public function setCodUf($value){
		return $this->codUF= $value ;
	}
	
	
}