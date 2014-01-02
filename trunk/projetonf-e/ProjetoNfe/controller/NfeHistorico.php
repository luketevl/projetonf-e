<?php
class NfeHistorico{
	
	private $id; 
	private $id_nota_fiscal;
	private $chave ;
	private $cod_motivo ;
	private $data_hora ;
	private $motivo ;
	private $num_protocolo ;
	private $situacao ;
	private $motivo_detalhado;

	function getId(){
		return $this->id ;
	}
	function getId_nota_fiscal(){
		return $this->id_nota_fiscal ;
	}
	function getChave(){
		return $this->chave ;
	}
	function getCod_motivo(){
		return $this->cod_motivo ;
	}
	function getData_hora(){
		return $this-> data_hora;
	}
	function getMotivo(){
		return $this->motivo ;
	}
	function getNum_protocolo(){
		return $this-> num_protocolo;
	}
	function getSituacao(){
		return $this-> situacao;
	}
	function getMotivo_Detalhado(){
		return $this-> motivo_detalhado;
	}
	
	function setId($value){
		$this->id= $value ;
	}
	function setId_nota_fiscal($value){
		$this->id_nota_fiscal= $value ;
	}
	function setChave($value){
		$this->chave= $value ;
	}
	function setCod_motivo($value){
		$this->cod_motivo= $value ;
	}
	function setData_hora($value){
		$this-> data_hora;
	}
	function setMotivo($value){
		$this->motivo= $value ;
	}
	function setNum_protocolo($value){
		$this-> num_protocolo = $value;
	}
	function setSituacao($value){
		$this-> situacao= $value;
	}
	function setMotivo_Detalhado($value){
		$this-> motivo_detalhado= $value;
	}

}