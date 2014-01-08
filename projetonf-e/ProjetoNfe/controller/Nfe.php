<?php
require ('../model/Pedidos_Model.php');

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
		 }
		
		function ide(){
			$this->ide = "B".$this->separador . $this->dados->getEndereco->getCodUF() . $this->separador . "00300000" . $this->separador . "VENDA" . $this->separador . "0" . $this->separador . $this->modelo . $this->separador . "1" .  $this->separador .  "1" . $this->separador . date("Y/m/d") . $this->separador . $this->seprador . $this->separador . "3550308" . $this->separador . "1". $this->separador ."1". $this->separador ."0". $this->separador ."2". $this->separador ."1". $this->separador ."3". $this->separador ."2.0.3". $this->separador . $this->separador . $this->separador ;
		}

		function emit(){
			$this->emit = "C" . $this->separador . $this->getEmitente()->getNome() . $this->separador . $this->getEmitente()->getNomeFantasia() . $this->separador . $this->separador
			 . $this->getEmitente()->getIe() . $this->separador . $this->getEmitente()->getIm() . $this->separador . "0131380" . $this->separador . "3" .  $this->separador;

			$this->emit += "\n C02" . $this->separador . $this->getEmitente()->getCpf_cnpj();
			$this->emit += "\n C05" . $this->separador . $this->getEmitente()->getEndereco()->getRua() . $this->separador . $this->getEmitente()->getEndereco()->getNumero()
			. $this->separador . "" . $this->separador  . $this->getEmitente()->getEndereco()->getBairro() . $this->separador  . "3550308" . $this->separador . $this->getEmitente()->getEndereco()->getCidade()
			. $this->separador . $this->getEmitente()->getEndereco()->getCep() . $this->separador . "1058" . $this->getEmitente()->getEndereco()->getPais() . $this->separador . $this->getEmitente()->getTelefone . $this->separador;
			;
		}

		function dest(){
			$this->emit = "E" . $this->separador . $this->getDestinatario()->getNome() . $this->separador . $this->getDestinatario()->getIe() . $this->separador . $this->separador . $this->separador;

			$this->emit += "\n E02" . $this->separador . $this->getDestinatario()->getCpf_cnpj();
			$this->emit += "\n E05" . $this->separador . $this->getDestinatario()->getEndereco()->getRua() . $this->separador . $this->getDestinatario()->getEndereco()->getNumero()
			. $this->separador . "" . $this->separador  . $this->getDestinatario()->getEndereco()->getBairro() . $this->separador  . "3550308" . $this->separador . $this->getDestinatario()->getEndereco()->getCidade()
			. $this->separador . $this->getDestinatario()->getEndereco()->getCep() . $this->separador . "1058" . $this->getDestinatario()->getEndereco()->getPais() . $this->separador . $this->getDestinatario()->getTelefone . $this->separador;
			;
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
					. "N02" . $this->separador .  $produtos->getOrig() . $this->separador . $produtos->getCst() . $this->separador 
				    ;


				;
				


			 $countProd++;
			}

		}


	}
	$nfe = new Nfe();
	echo "<pre>". print_r($nfe->getDados()) . "</pre>";