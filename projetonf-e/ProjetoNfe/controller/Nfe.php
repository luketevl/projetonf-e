<?php
require ('../model/Pedidos_Model.php');
require ('../model/Historico_Model.php');
require ('../helper/File.php');
//require_once ('../helper/nfe_services.php');
require_once('../helper/ws/libs/ConvertNFePHP.class.php');
require_once('../helper/ws/libs/ToolsNFePHP.class.php');
require_once('../helper/ws/outros/NFeTools.class.php');
require_once('../helper/ws/libs/DanfeNFePHP.class.php');

	class Nfe{
		 
		 private $nomeArquivo;
		 private $caminho;
		 private $inicio;
		 
		 private $header;
		 private $ide;
		 private $emit;
		 private $dest;
		 private $det;


		 private $separador;

		 private $versao;
		 private $modelo;
		 private $chave;
		 private $dados;
		
		function getDados(){
			return $this->dados;
		}
		 function __construct($id){
		     $this->separador="|";
			 $this->dados = Pedidos_Model::get_by_id($id);		
		     $this->inicio = "NOTAFISCAL".$this->separador."1";
		     $this->versao = "2.00";
		     $this->modelo = "55";
		     $this->chave="NFe".$this->dados->getChave_acesso();
		 }

		 function header(){

			$this->header = "A".$this->separador . $this->versao . $this->separador . $this->chave . $this->separador;
			return $this->inicio . "\n".$this->header."\n";
		 }
		
		function ide(){
			$this->ide = "B".$this->separador . $this->dados->getEmitente()->getEndereco()->getCodUF() . $this->separador . "00300000" . $this->separador . "VENDA" . $this->separador . "0" . $this->separador . $this->modelo . $this->separador . "1" .  $this->separador .  "1" . $this->separador . date("Y-m-d") . $this->separador . $this->separador . $this->separador . "1" . $this->separador ."3550308" . $this->separador . "1". $this->separador ."1". $this->separador ."0". $this->separador ."2". $this->separador ."1". $this->separador ."3". $this->separador ."2.0". $this->separador . $this->separador . $this->separador ;
			return $this->ide ."\n";
		}

		function emit(){
			//echo "<pre>" ; print_r($this->dados) ; echo "</pre>";
			$this->emit = "C" . $this->separador . $this->dados->getEmitente()->getNome() . $this->separador . $this->dados->getEmitente()->getNomeFantasia() . $this->separador . $this->dados->getEmitente()->getIe()
			. $this->separador . $this->separador . $this->dados->getEmitente()->getIm() . $this->separador . "0131380" . $this->separador . "3" .  $this->separador
			. "\nC02" . $this->separador . $this->dados->getEmitente()->getCpf_cnpj() . $this->separador
			. "\nC05" . $this->separador . $this->dados->getEmitente()->getEndereco()->getRua() . $this->separador . $this->dados->getEmitente()->getEndereco()->getNumero()
			. $this->separador . "" . $this->separador  . $this->dados->getEmitente()->getEndereco()->getBairro() . $this->separador  . "3550308" . $this->separador . $this->dados->getEmitente()->getEndereco()->getCidade()
			. $this->separador . $this->dados->getEmitente()->getEndereco()->getEstado() . $this->separador . $this->dados->getEmitente()->getEndereco()->getCep() . $this->separador . "1058" . $this->separador . $this->dados->getEmitente()->getTelefone . $this->separador;
			;
			return $this->emit;
		}

		function dest(){
			$this->dest = "\nE" . $this->separador . $this->dados->getDestinatario()->getNome() . $this->separador . $this->dados->getDestinatario()->getIe() . $this->separador . $this->separador  . $this->separador
			. "\nE02" . $this->separador . str_replace("-","",str_replace("/","",str_replace(".", "", $this->dados->getDestinatario()->getCpf_cnpj()))) . $this->separador
			. "\nE05" . $this->separador . $this->dados->getDestinatario()->getEndereco()->getRua() . $this->separador . $this->dados->getDestinatario()->getEndereco()->getNumero()
			. $this->separador . $this->separador . $this->dados->getDestinatario()->getEndereco()->getBairro() . $this->separador  . "3550308" . $this->separador . $this->dados->getDestinatario()->getEndereco()->getCidade()
			. $this->separador . $this->dados->getDestinatario()->getEndereco()->getEstado() . $this->separador . $this->dados->getDestinatario()->getEndereco()->getCep() . $this->separador .  "1058" . $this->separador . $this->dados->getDestinatario()->getEndereco()->getPais()  . $this->separador;
			return $this->dest;
		}

		function det(){
			$countProd=1;
			foreach($this->dados->getPedidosItens() as $produtos){
				//if($countProd==1){
					
				$this->det = $this->det . "\nH" . $this->separador . $countProd . $this->separador . $produtos->getProdutos()->getObservacoes() . $this->separador
				    . "\nI" . $this->separador . $produtos->getProdutos()->getCod() . $this->separador . $this->separador . $produtos->getProdutos()->getDesc() . $this->separador .$produtos->getProdutos()->getNcm() . $this->separador . $this->separador 
				    . $produtos->getCfop() . $this->separador . $produtos->getProdutos()->getUnd(). $this->separador . "46.8000" . $this->separador 
				    . $produtos->getProdutos()->getVr_unitario(). $this->separador. $produtos->getProdutos()->getVr_unitario() . $this->separador
				    . $this->separador . $produtos->getProdutos()->getUnd(). $this->separador . "46.8000" . $this->separador .$produtos->getProdutos()->getVr_unitario()
				     . $this->separador . $this->separador . $this->separador . $this->separador . "0" . $this->separador .  "1" . $this->separador
				    . "\nXPED" . $this->separador . $countProd . $this->separador
					. "\nM" . $this->separador
					. "\nN" . $this->separador
					. "\nN02" . $this->separador .  $produtos->getOrig() . $this->separador . $produtos->getCst() . $this->separador . "3" . $this->separador
					. $produtos->getBc_icms() . $this->separador . $produtos->getAliq_icms() . $this->separador . $produtos->getVr_icms() . $this->separador
					//. "\nO" . $this->separador . $this->separador . $this->separador . $this->separador . $this->separador . "0" . $this->separador
					//. "\nO08" . $this->separador . "1" . $this->separador
					. "\nQ" . $this->separador
					. "\nQ02" . $this->separador . $produtos->getCst_ipi() . $this->separador . $produtos->getTotal_prod() . $this->separador . $produtos->getAliq_pis() . $this->separador . "0" . $this->separador
					. "\nS" . $this->separador 
					. "\nS02" . $this->separador . $produtos->getCst_cofins() . $this->separador . $produtos->getTotal_prod() . $this->separador . $produtos->getAliq_cofins() . $this->separador . $produtos->getTotal_prod() . $this->separador 
				    . $this->separador . $produtos->getTotal_prod() . $this->separador . $this->dados->getVr_frete() . $this->separador . $this->dados->getVr_seguro() . $this->separador . "0.00" . $this->separador . "0.00" . $this->separador 
				    . "0.00" . $this->separador . "0.00" . $this->separador . "0.00" . $this->separador . "0.00" . $this->separador . "0.00" .$this->separador;
				//}
				 $countProd++;
			}
		    $this->det = $this->det . "\nW" . $this->separador
				    . "\nW02" . $this->separador . $produtos->getBc_icms() . $this->separador . $produtos->getTotal_icms() . $this->separador . "0.00" . $this->separador .  "0.00"
		    . $this->separador . $this->dados->getVr_total_nota() . $this->separador . $this->dados->getVr_frete() . $this->separador . $this->dados->getVr_seguro() . $this->separador . $produtos->getVr_desc() . $this->separador
		    . "0.00" .$this->separador . $this->dados->getvr_ipi() . $this->separador . $produtos->getVr_pis() . $this->separador . $this->dados->getVr_cofins(). $this->separador. $this->dados->getDespesas_acessorias() . $this->separador . $this->dados->getVr_total_nota() . $this->separador
		    . "\nX" . $this->separador . "0" . $this->separador
		    . "\nZ" . $this->separador . "TEXTO NFE" . $this->separador  . $this->separador ;
			return $this->det;
		}

	}
	$id = $_GET['id'];
	$nfe = new Nfe($id);
	//Nfe_Services::verificaDisponibilidade();


	//echo "<pre>". print_r($nfe->getDados()) . "</pre>";
//echo phpinfo();

	File::createFile($nfe->getDados()->getChave_acesso()."-nfe",".txt",$nfe->header().$nfe->ide().$nfe->emit().$nfe->dest().$nfe->det());
	$arq = '../resources/nfe/txt/'.$nfe->getDados()->getChave_acesso().'-nfe.txt';
	$arqXML = '../resources/nfe/txt/'.$nfe->getDados()->getChave_acesso().'-nfe.xml';

	Nfe_Services::geraDANFE($arqXML);
	//$arqXML = '../resources/nfe/35101158716523000119550010000000011003000000-nfe.xml';


	Nfe_Services::createXMLAprovacao($arq,$nfe);

	Nfe_Services::validaXML($arqXML);

	Nfe_Services::assinaXML($arqXML);

/*	Nfe_Services::enviaNfe($nfe->getDados()); */

	
	// Demonstracao XML cancelamento
	Nfe_Services::createXmlCancel($nfe->getDados(),"MOTIVO CANCELAMENTO");
	
	// Demonstracao XML inutilizacao
	Nfe_Services::createXmlInutilizacao($nfe->getDados(),"MOTIVO INUTILIZACAO");