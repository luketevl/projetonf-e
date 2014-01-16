<?php

class PedidosItens{
	
	private $produtos=array();
	private $qtd;
	private $vr_desc;
	private $vr_total;
	private $total_prod;
	private $bc_icms;
	private $vr_icms;
	private $total_icms;
	private $vr_ipi;
	private $vr_pis;
	private $vr_cofins;
	private $aliq_icms;
	private $aliq_ipi;
	private $aliq_pis;
	private $aliq_cofins;
	private $cst_ipi;
	private $cst_cofins;
	private $cfop;
	private $vr_unit_pedido;
	private $cst;
	private $orig;
	
	public function getProdutos(){
		return $this->produtos;
	}
	public function getQtd(){
		return $this->qtd;
	}
	public function getVr_desc(){
		return $this->vr_desc;
	}
	public function getVr_total(){
		return $this->vr_total;
	}
	public function getTotal_prod(){
		return $this->total_prod;
	}
	public function getBc_icms(){
		return $this->bc_icms;
	}
	public function getVr_icms(){
		return $this->vr_icms;
	}
	public function getTotal_icms(){
		return $this->total_icms;
	}
	public function getVr_ipi(){
		return $this->vr_ipi;
	}
	public function getVr_cofins(){
		return $this->vr_cofins;
	}
	public function getVr_pis(){
		return $this->vr_pis;
	}
	public function getAliq_icms(){
		return $this->aliq_icms;
	}
	public function getAliq_ipi(){
		return $this->aliq_ipi;
	}
	public function getAliq_pis(){
		return $this->aliq_pis;
	}
	public function getAliq_cofins(){
		return $this->aliq_cofins;
	}
	public function getCst_ipi(){
		return $this->cst_ipi;
	}
	public function getCst_cofins(){
		return $this->cst_cofins;
	}
	public function getCfop(){
		return $this->cfop;
	}
	public function getVr_unit_pedido(){
		return $this->vr_unit_pedido;
	}
	public function getCst(){
		return $this->cst;
	}
	public function getOrig(){
		return $this->orig;
	}
	
	public function setProdutos($value){
		$this->produtos = $value;
	}
	public function setQtd($value){
		 $this->qtd = $value;
	}
	public function setVr_desc($value){
		$this->vr_desc = $value;
	}
	public function setVr_total($value){
		$this->vr_total = $value;
	}
	public function setTotal_prod($value){
		$this->total_prod = $value;
	}
	public function setBc_icms($value){
		$this->bc_icms = $value;
	}
	public function setVr_icms($value){
		$this->vr_icms = $value;
	}
	public function setTotal_icms($value){
		$this->total_icms = $value;
	}
	public function setVr_ipi($value){
		$this->vr_ipi = $value;
	}
	public function setVr_cofins($value){
		$this->vr_cofins = $value;
	}
	public function setVr_pis($value){
		$this->vr_pis = $value;
	}
	public function setAliq_icms($value){
		$this->aliq_icms = $value;
	}
	public function setAliq_ipi($value){
		$this->aliq_ipi = $value;
	}
	public function setAliq_pis($value){
		$this->aliq_pis = $value;
	}
	public function setAliq_cofins($value){
		$this->aliq_cofins = $value;
	}
	public function setCst_ipi($value){
		$this->cst_ipi = $value;
	}
	public function setCst_cofins($value){
		$this->cst_cofins = $value;
	}
	public function setCfop($value){
		$this->cfop = $value;
	}
	public function setVr_unit_pedido($value){
		$this->vr_unit_pedido = $value;
	}
	public function setCst($value){
		$this->cst = $value;
	}
	public function setOrig($value){
		$this->orig = $value;
	}

}