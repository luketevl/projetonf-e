<?php
require ('../model/Pedidos_Model.php');
require ('../helper/File.php');

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
		 function __construct(){
			 $this->dados = Pedidos_Model::get_by_id(571);		
		     $this->inicio= "NOTAFISCAL".$this->separador."1";
		     $this->separador="|";
		     $this->versao = "2.00";
		     $tis->modelo = "55";
		     $this->chave="NFe";
		 }

		 function header(){
		 	$this->chave += "546546545645645646";
			$this->header = "A".$this->separador . $this->versao . $this->separador . $this->chave . $this->separador;
			return $this->header."\n";
		 }
		
		function ide(){
			$this->ide = "B".$this->separador . $this->dados->getEmitente()->getEndereco()->getCodUF() . $this->separador . "00300000" . $this->separador . "VENDA" . $this->separador . "0" . $this->separador . $this->modelo . $this->separador . "1" .  $this->separador .  "1" . $this->separador . date("Y/m/d") . $this->separador . $this->seprador . $this->separador . "3550308" . $this->separador . "1". $this->separador ."1". $this->separador ."0". $this->separador ."2". $this->separador ."1". $this->separador ."3". $this->separador ."2.0.3". $this->separador . $this->separador . $this->separador ;
			return $this->ide ."\n";
		}

		function emit(){
			$this->emit += "C" . $this->separador . $this->dados->getEmitente()->getNome() . $this->separador . $this->dados->getEmitente()->getNomeFantasia() . $this->separador . $this->separador
			 . $this->dados->getEmitente()->getIe() . $this->separador . $this->dados->getEmitente()->getIm() . $this->separador . "0131380" . $this->separador . "3" .  $this->separador;

			$this->emit += "\n C02" . $this->separador . $this->dados->getEmitente()->getCpf_cnpj();
			$this->emit += "\n C05" . $this->separador . $this->dados->getEmitente()->getEndereco()->getRua() . $this->separador . $this->dados->getEmitente()->getEndereco()->getNumero()
			. $this->separador . "" . $this->separador  . $this->dados->getEmitente()->getEndereco()->getBairro() . $this->separador  . "3550308" . $this->separador . $this->dados->getEmitente()->getEndereco()->getCidade()
			. $this->separador . $this->dados->getEmitente()->getEndereco()->getCep() . $this->separador . "1058" . $this->dados->getEmitente()->getEndereco()->getPais() . $this->separador . $this->dados->getEmitente()->getTelefone . $this->separador;
			;
			return $this->emit;
		}

		function dest(){
			$this->dest = "E" . $this->separador . $this->dados->getDestinatario()->getNome() . $this->separador . $this->dados->getDestinatario()->getIe() . $this->separador . $this->separador . $this->separador;

			$this->dest += "\n E02" . $this->separador . $this->dados->getDestinatario()->getCpf_cnpj();
			$this->dest += "\n E05" . $this->separador . $this->dados->getDestinatario()->getEndereco()->getRua() . $this->separador . $this->dados->getDestinatario()->getEndereco()->getNumero()
			. $this->separador . "" . $this->separador  . $this->dados->getDestinatario()->getEndereco()->getBairro() . $this->separador  . "3550308" . $this->separador . $this->dados->getDestinatario()->getEndereco()->getCidade()
			. $this->separador . $this->dados->getDestinatario()->getEndereco()->getCep() . $this->separador . "1058" . $this->dados->getDestinatario()->getEndereco()->getPais() . $this->separador . $this->dados->getDestinatario()->getTelefone . $this->separador;
			return $this->dest;
		}

		function det(){
			$countProd=1;
			foreach($this->dados->getPedidosItens() as $produtos){
				$this += "H" . $this->separador . "1" . $this->separador . $produtos->getProduto()->getObservacoes() . $this->separador;
				$this += "I" . $this->separador . $produtos->getProduto()->getCod() . $this->separador . $this->separador . $produtos->getProduto()->getDesc()
				    . $this->separador . $produtos->getProduto()->getNcm() . $this->separador . $this->separador . $produtos->getCfop() . $this->separador . $produtos->getProdutos()->getUnd(). $this->separador . "46.8000" . $this->separador . "vUnCom". $this->separador. $produtos->getProdutos()->getVr_unitario() . $this->separador
				    . $this->separador . $produtos->getProdutos()->getUnd(). $this->separador . "46.8000" . $this->separador .$produtos->getProdutos()->getVr_unitario() . $this->separador . $this->separador . $this->separador . $this->separador . "1" . $this->separador
				    . "XPED" . $this->separador . $countProd . $this->separador
					. "M" . $this->separador
					. "N" . $this->separador
					. "N02" . $this->separador .  $produtos->getOrig() . $this->separador . $produtos->getCst() . $this->separador . "<modBC>3</modBC>" . $this->separador
					. $produtos->getBc_icms() . $this->separador . $produtos->getAliq_icms() . $this->separador . $produtos->getVr_icms() . $this->separador
					. "O" . $this->separador . $this->separador . $this->separador . $this->separador . $this->separador . "cEnq" . $this->separador
					. "O08" . $this->separador . "CST" . $this->separador
					. "Q" . $this->separador
					. "Q02" . $this->separador . $produtos->getCst_ipi() . $this->separador . "vBC" . $this->separador . $produtos->getAliq_pis() . $this->separador . "vPIS" . $this->separador
					. "S" . $this->separador 
					. "S02" . $this->separador . $produtos->getCst_cofins() . $this->separador . "VBC" . $this->separador . $produtos->getAliq_cofins() . $this->separador . "vCOFINS" . $this->separador 
				    . "W" . $this->separador
				    . "W02" . $this->separador . $produtos->getBc_icms() . $this->separador . $produtos->getTotal_icms() . $this->separador . "vBCST" . "vST"
				    . $this->separador . $produtos->getTotal_prod() . $this->separador . $this->dados->getVr_frete() . $this->separador . $this->dados->getVr_seguro();
				 $countProd++;
			}
		    $this += $this->separador -> $this->dados->getDesconto() . $this->separador . "vII" . $this->separador . $this->dados->getVr_ipi() . $this->separador . "vCOFINS" . $this->separador
		    . $this->dados->getDespesas_acessorias() . $this->separador . $this->dados->getVr_total_nota() . $this->separador
		    . "X" . $this->separador . "0" . $this->separador
		    . "Z" . $this->separador . "TEXTO NFE" . $this->separador  . $this->separador ;
			return $this->det;
		}

 
 

	}
	$nfe = new Nfe();
	//echo "<pre>". print_r($nfe->getDados()) . "</pre>";
	File::createFile("meucaralho",".txt",$nfe->header().$nfe->ide().$nfe->emit().	$nfe->dest());
