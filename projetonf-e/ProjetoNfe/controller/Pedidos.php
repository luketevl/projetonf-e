<?php
class Pedidos{

	private $documento;
	private $emitente;
	private $destinatario;
	private $transportadora;
	private $pedidosItens=array();

	private $bc_icms;
	private $vr_icms;
	private $bc_icms_st;
	private $vr_icms_st;
	private $total_prod;
	private $vr_frete;
	private $vr_seguro;
	private $desconto;
	private $despesas_acessorias;
	private $vr_ipi;
	private $vr_total_nota;
	private $info_complementares;

	public function getDocumento(){
		return $this->documento ;
	}
	public function getEmitente(){
		return $this->emitente ;
	}
	public function getDestinatario(){
		return $this->destinatario ;
	}
	public function getTransportadora(){
		return $this->transportadora ;
	}
	public function getPedidosItens(){
		return $this->pedidosItens ;
	}
	public function getBc_icms(){
		return $this->bc_icms ;
	}
	public function getVr_icms(){
		return $this-> vr_icms;
	}
	public function getBc_icms_st(){
		return $this->bc_icms_st ;
	}
	public function getVr_icms_st(){
		return $this-> vr_icms_st;
	}
	public function getTotal_prod(){
		return $this->total_prod ;
	}
	public function getVr_frete(){
		return $this->vr_frete ;
	}
	public function getVr_seguro(){
		return $this->vr_seguro ;
	}
	public function getDesconto(){
		return $this->desconto ;
	}
	public function getDespesas_acessorias(){
		return $this->despesas_acessorias ;
	}
	public function getVr_ipi(){
		return $this->vr_ipi ;
	}
	public function getVr_total_nota(){
		return $this->vr_total_nota ;
	}
	public function getInfo_complementares(){
		return $this->info_complementares ;
	}

	public function setDocumento($value){
		$this->documento= $value;
	}
	public function setEmitente($value){
		$this->emitente= $value;
	}
	public function setDestinatario($value){
		$this->destinatario	= $value;
	}
	public function setTransportadora($value){
		$this->transportadora= $value;
	}
	public function setPedidosItens($value){
		$this->pedidosItens= $value;
	}
	public function setBc_icms($value){
		$this->bc_icms	= $value;
	}
	public function setVr_icms($value){
		$this-> vr_icms= $value;
	}
	public function setBc_icms_st($value){
		$this->bc_icms_st= $value;
	}
	public function setVr_icms_st($value){
		$this-> vr_icms_st= $value;
	}
	public function setTotal_prod($value){
		$this->total_prod	= $value;
	}
	public function setVr_frete($value){
		$this->vr_frete= $value;
	}
	public function setVr_seguro($value){
		$this->vr_seguro	= $value;
	}
	public function setDesconto($value){
		$this->desconto= $value;
	}
	public function setDespesas_acessorias($value){
		$this->despesas_acessorias= $value;
	}
	public function setVr_ipi($value){
		$this->vr_ipi= $value;
	}
	public function setVr_total_nota($value){
		$this->vr_total_nota= $value;
	}
	public function setInfo_complementares($value){
		$this->info_complementares= $value;
	}

}