<?php
require ('../helper/fpdf/fpdf.php');
require ('../model/Pedidos_Model.php');

class PDF extends FPDF
{
	private $ar;
	function Header()
	{
		global $title;

// 			echo "<pre>";
// 				echo print_r($ar);
// 			echo "</pre>";
	$this->SetFont('Times','',5);
	$this->Cell(160,3,"RECEBEMOS DE ".strtoupper($this->ar->getDestinatario()->getNome())." OS PRODUTOS CONSTANTES DA NOTA FISCAL INDICADA AO LADO","LTR",0,"C");
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->Ln();
	$this->SetFont('Times','',9);
	$this->Cell(160,5," ","LRB",1);

	$this->SetFont('Times','',5);
	$this->Cell(30,3,"DATA DO RECEBIMENTO","LTR",0);
	$this->Cell(130,3,"IDENTIFICAÇÃO E ASSINATURA DO RECEBEDOR","LTR",1);
	$this->SetFont('Times','',9);
	$this->Cell(30,5," ","LRB",0);
	$this->Cell(130,5," ","LRB",1);

	$this->SetY($tpY);
	$this->SetX($tpX);

	$this->SetFont('Times','',5);
	$this->Cell(0,3,"NF-e","LTR",1,"C");
	$this->SetFont('Times','',9);
	$this->SetX($tpX);
	$this->MultiCell(0,6.5,"N {$this->ar->getDocumento()} \n SÉRIE: {$this->ar->getSerie()}" ,"LRB","C");

	$this->Ln(2);

	$tpY = $this->GetY();
	$tpX = $this->GetX();
/*
	$image_path = null;
	list($width, $height, $type, $attr)= getimagesize($image_path);

	if (max($width,$height) == $width){
		$height = ($height * 28) / $width;
		$width = 28;
	}
	else{
		$width = ($width * 28) / $height;
		$height = 28;
	}
	$this->SetY($tpY +3);
	$this->Image($image_path,null,null,$width,$height);
*/
	$this->SetY($tpY);
	$this->SetX($tpX+30);
	$this->SetFont('Times','B',9);
	$X = $this->GetX()+70;
	//tratamento para dados multicell
	$this->MultiCell(70,4,"\n".strtoupper($this->ar->getEmitente()->getNome()),"0","L");
	$this->SetFont('Times','',9);
	$this->SetX($tpX+30);
	$this->MultiCell(70,4,"{$this->ar->getEmitente()->getEndereco()->getRua() }, {$this->ar->getEmitente()->getEndereco()->getNumero()} \n {$this->ar->getEmitente()->getEndereco()->getCidade()} - {$this->ar->getEmitente()->getEndereco()->getEstado()} - CEP {$this->ar->getEmitente()->getEndereco()->getCep()} \n FONE {$this->ar->getEmitente()->getTelefone()} \n "
	,"0","L");
	$Y = $this->GetY();
	$tp1 = $this->GetY() - $tpY;
	$this->SetY($tpY);
	$this->SetX($tpX);
	$this->Cell(100,36,"",1);
	$this->SetX($X);
	$this->SetFont('Times','',6);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->MultiCell(30,2,"\n\n\n\n DOCUMENTO AUXILIAR DE NOTA FISCAL ELETR�NICA \n\n\n  \n\n\n\n N� {$this->ar->getDocumento()} \n S�RIE {$this->ar->getSerie()} \n\n P�GINA {teste} de {teste} \n\n",1,"C");
	$this->SetY($tpY+2);
	$this->SetX($tpX);
	$this->SetFont('Times','B',9);
	$this->Cell(30,4,"DANFE",0,0,"C");
	$this->SetFont('Times','',6);
	$this->SetY($tpY+17);
	$this->SetX($tpX);
	$this->Cell(35,2,"      0 - ENTRADA",0,0);
	$this->SetY($tpY+20);
	$this->SetX($tpX);
	$this->Cell(35,2,"      1 - SAIDA",0,0);
	$this->SetY($tpY+17);
	$this->SetX($tpX+20);
	$this->SetFont('Times','B',6);
	$this->Cell(4,5,"1",1,0,"C");
	$this->SetY($tpY);
	$this->SetX($tpX+30);

	//controle do fisco
	$this->SetFont('Times','',5);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->Cell(0,3,'CONTROLE DO FISCO',"LTR",0);
	$this->SetY($tpY+3);
	$this->SetX($tpX);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->SetFont('Times','',9);
	$x = $this->GetX();
	$y = $this->GetY();
	$this->Cell(0,15,'',"LRB",0);
	if(!empty($teste))
		$this->Code128($x+4,$y+2,$this->data['nota_chave_acesso_sequencial'],68,10);

	//CHAVE DE ACESSO
	$this->SetFont('Times','',5);
	$this->SetY($tpY+15);
	$this->SetX($tpX);
	$this->Cell(0,3,'CHAVE DE ACESSO',"LTR",0);
	$this->SetY($tpY+18);
	$this->SetX($tpX);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->SetFont('Times','',7);
	$this->Cell(0,5,"teste","LRB",0,"C");

	//CONSULTA AUTENTICIDADE NO PORTAL ....
	$this->SetFont('Times','',7);
	$this->SetY($tpY+7);
	$this->SetX($tpX);
	$this->MultiCell(0,3,"Consulta de autenticidade no portal nacional da NF-e www.nfe.fazenda.gov.br/portal ou no site da Sefaz autorizadora ","0","C");
	$this->SetY($tpY+5);
	$this->SetX($tpX);
	$this->Cell(0,10,"",1,1);

	//NATUREZA DA OPERA��O, PROTOCOLO DE AUTORIZACAO DE USO
	$this->SetFont('Times','',5);
	$this->Cell(130,3,"NATUREZA DA OPERA��O","LTR",0);
	$this->Cell(0,3,"PROTOCOLO DE AUTORIZA��O DE USO","LTR",1);
	$this->SetFont('Times','',9);
	$this->Cell(130,5,"COLOCA DESCRICAO DO NCM","LRB",0);
	$this->Cell(0,5,"COLOCA PROTOCOLO AUTORIZACAO","LRB",1);

	//INSCRICAO ESTADUAL, INSC. ESTADUAL DO SUBST. TRIBUTARIO, CNPJ
	$this->SetFont('Times','',5);
	$this->Cell(80,3,"INSCRI��O ESTADUAL","LTR",0);
	$this->Cell(70,3,"INSCRI��O ESTADUAL DO SUBST. TRIBUT�RIO","LTR",0);
	$this->Cell(0,3,"CNPJ","LTR",1);
	$this->SetFont('Times','',9);
	$this->Cell(80,5,$this->ar->getEmitente()->getIe(),"LRB",0);
	$this->Cell(70,5,"teste","LRB",0);
	$this->Cell(0,5,$this->ar->getEmitente()->getCpf_cnpj(),"LRB",1);

	$this->Ln(3);
	
	//$this->gera();
	
	}

	function gera(){
		//$this->data = $dados;
		//$this->StartPageGroup();
		$this->SetAutoPageBreak(true,"2");
		$this->AliasNbPages();
		$this->SetMargins("2","2","2");
		$this->AddPage();
		
		//DESTINATARIO/EMITENTE
		$this->SetFont('Times','B',7);
		$this->Cell(0,3,"DESTINAT�RIO/REMETENTE",0,1);
		$this->SetFont('Times','',5);
		
		//NOME/RAZAO SOCIAL
		$this->Cell(140,3,"NOME/RAZ�O SOCIAL","LTR");
		$this->Cell(40,3,"CNPJ/CPF","LTR");
		$this->Cell(0,3,"DATA EMISS�O","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(140,5,str_replace("�", "", str_replace('&', '', 'destinatario_razao_social')),"LBR");
		$this->Cell(40,5,'destinatario_cpf_cnpj',"LBR");
		$this->Cell(0,5,'data_emissao',"LBR",1);
		
		//ENDERE�O,BAIRRO/DISTRITO,CEP,DATA ENTRADA/SAIDA
		$this->SetFont('Times','',5);
		$this->Cell(110,3,"ENDERE�O","LTR");
		$this->Cell(50,3,"BAIRRO/DISTRITO","LTR");
		$this->Cell(20,3,"CEP","LTR");
		$this->Cell(0,3,"DATA ENTRADA/SA�DA","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(110,5,'destinatario_logradouro',"LBR");
		$this->Cell(50,5,substr('destinatario_bairro', 0, 25),"LBR");
		$this->Cell(20,5,'destinatario_cep',"LBR");
		$this->Cell(0,5,'data_entrada_saida',"LBR",1);
		
		//MUNICIPIO,FONE/FAX,UF,INCRICAO ESTADUAL,HORA ENTRADA/SAIDA
		$this->SetFont('Times','',5);
		$this->Cell(80,3,"MUNIC�PIO","LTR");
		$this->Cell(30,3,"FONE/FAX","LTR");
		$this->Cell(20,3,"UF","LTR");
		$this->Cell(50,3,"INSCRI��O ESTADUAL","LTR");
		$this->Cell(0,3,"HORA ENTRADA/SA�DA","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(80,5,'destinatario_municipio',"LBR");
		$this->Cell(30,5,'destinatario_telefone',"LBR");
		$this->Cell(20,5,'destinatario_uf',"LBR");
		$this->Cell(50,5,'destinatario_ie',"LBR");
		$this->Cell(0,5,'hora_entrada_saida',"LBR",1);
		$this->Ln(3);
		/*
		if(!empty($this->data['numero_fatura']) || !empty($this->data['parcelas'])){
			//FATURA/DUPLICATA
			$this->SetFont('Times','B',7);
			$this->Cell(0,3,"FATURA/DUPLICATAS",0,1);
			$this->SetFont('Times','',5);
		}
		
		if(!empty($this->data['numero_fatura'])){
				
			$this->SetFont('Times','',5);
			$this->Cell(51,3,"N�MERO","LTR");
			$this->Cell(51,3,"VALOR ORIGINAL","LTR");
			$this->Cell(51,3,"VALOR DESCONTO","LTR");
			$this->Cell(0,3,"VALOR L�QUIDO","LTR",1);
			$this->SetFont('Times','',9);
			$this->Cell(51,5,"teste","LBR");
			$this->Cell(51,5,"teste","LBR");
			$this->Cell(51,5,"teste","LBR");
			$this->Cell(0,5,"teste","LBR", 1);
			$this->Ln(1);
		}
		*/
		$this->SetFont('Times','',7);
		/*
		if(!empty($this->data['parcelas'])){
			foreach($this->data['parcelas'] as $v){
				$tempX = $this->GetX();
				$tempY = $this->GetY();
				if($tempX < 172){
					if($tempY > 267){
						$this->AddPage();
						$tempX = $this->GetX();
						$tempY = $this->GetY();
					}
					$this->Cell(34,15,"",1);
					if($tempY < 267)
						$this->SetXY($tempX, $tempY);
		
					$this->Cell(34,5,"Numero            {$v['numero_documento']}",0);
		
					$this->SetXY($tempX, $tempY+5);
					$this->Cell(34,5,"Vencimento   {$v['data_vencimento']}",0);
		
					$this->SetXY($tempX, $tempY+10);
					$this->Cell(34,5,"Valor             {$v['valor_parcela']}",0);
					$this->SetY($tempY);
					$this->SetX($tempX+34);
				}
				else{
					$tempY = $this->GetY();
					$tempX = $this->GetX();
					$this->Cell(34,5,"Numero            {$v['numero_documento']}",0);
					$this->SetXY($tempX, $tempY+5);
					$this->Cell(34,5,"Vencimento   {$v['data_vencimento']}",0);
					$this->SetXY($tempX, $tempY+10);
					$this->Cell(34,5,"Valor             {$v['valor_parcela']}",0);
					$this->SetXY($tempX, $tempY);
					$this->Cell(0,15,"",1,1);
				}
			}
			$this->Ln(18);
		} */
//		else{
			$this->Ln(2);
	//	}
		
		//VALOR DO FRETE,VALOR DO SEGURO,DESCONTO,OUTRAS DESPESAS ACESS�RIAS,VALOR DO IPI,VALOR TOTAL DA NOTA
		if($this->GetY()+8 >= 280){
			$this->AddPage();
		}
		
		//CALCULO DO IMPOSTO
		$this->SetFont('Times','B',7);
		$this->Cell(0,3,"C�LCULO DO IMPOSTO",0,1);
		$this->SetFont('Times','',5);
		//BASE DE CALCULO DO ICMS,VALOR DO ICMS,BASE DE CALCULO DO ICMS SUBST., VALOR DO ICMS SUBST.,VALOR TOTAL DOS PRODUTOS
		$this->Cell(41,3,"BASE DE C�LCULO DO ICMS","LTR");
		$this->Cell(41,3,"VALOR DO ICMS","LTR");
		$this->Cell(41,3,"BASE DE C�LCULO DO ICMS SUBST.","LTR");
		$this->Cell(41,3,"VALOR DO ICMS SUBST.","LTR");
		$this->Cell(0,3,"VALOR TOTAL DOS PRODUTOS","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(41,5,"teste","LBR","0","R");
		$this->Cell(41,5,"imposto_vr_icms","LBR","0","R");
		$this->Cell(41,5,'imposto_bc_icms_st',"LBR","0","R");
		$this->Cell(41,5,'imposto_vr_icms_st',"LBR","0","R");
		$this->Cell(0,5,'imposto_vr_total_produtos',"LBR",1,"R");
		
		$this->SetFont('Times','',5);
		$this->Cell(25,3,"VALOR DO FRETE","LTR");
		$this->Cell(25,3,"VALOR DO SEGURO","LTR");
		$this->Cell(25,3,"DESCONTO","LTR");
		$this->Cell(35,3,"OUTRAS DESPESAS ACESS�RIAS","LTR");
		$this->Cell(30,3,"VALOR DO IPI","LTR");
		$this->Cell(44,3,"VR. APROXIMADO DOS IMPOSTOS, FONTE: IBPT","LTR");
		$this->Cell(0,3,"VALOR TOTAL DA NOTA","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(25,5,'vr_frete',"LBR","0","R");
		$this->Cell(25,5,'vr_seguro',"LBR","0","R");
		$this->Cell(25,5,'vr_desconto',"LBR","0","R");
		$this->Cell(35,5,'vr_outras_despesas',"LBR","0","R");
		$this->Cell(30,5,'vr_ipi',"LBR","0","R");
		$this->Cell(44,5,'vr_total_imposto_nota'." (".format_number(($this->data['vr_total_imposto_nota']/'vr_total_nota')*100)."%)","LBR","0","R");
		$this->Cell(0,5,'vr_total_nota',"LBR",1,"R");
		
		$this->Ln(3);
		
		if($this->GetY()+16 >= 280){
			$this->AddPage();
		}
		//TRANSPORTADORA/VOLUMES TRANSPORTADOS
		$this->SetFont('Times','B',7);
		$this->Cell(0,3,"TRANSPORTADORA/VOLUMES TRANSPORTADOS",0,1);
		$this->SetFont('Times','',5);
		
		//NOME/RAZ�O SOCIAL,FRETE POR CONTA,C�DIGO ANTT,PLACA DO VE�CULO,UF,CNPJ/CPF
		$this->Cell(60,3,"NOME/RAZ�O SOCIAL","LTR");
		$this->Cell(30,3,"FRETE POR CONTA","LTR");
		$this->Cell(30,3,"C�DIGO ANTT","LTR");
		$this->Cell(30,3,"PLACA DO VE�CULO","LTR");
		$this->Cell(20,3,"UF","LTR");
		$this->Cell(0,3,"CNPJ/CPF","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(60,5,substr('transporte_razao_social', 0, 30),"LBR");
		$this->Cell(30,5,'transporte_tipo_frete',"LBR");
		$this->Cell(30,5,'transporte_cod_antt',"LBR");
		$this->Cell(30,5,'transporte_placa_veiculo',"LBR");
		$this->Cell(20,5,'transporte_uf_veiculo',"LBR");
		$this->Cell(0,5,'transporte_cpf_cnpj',"LBR",1);
		
		//ENDERE�O,MUNIC�PIO,UF,INSCRI��O ESTADUAL
		$this->SetFont('Times','',5);
		$this->Cell(100,3,"ENDERE�O","LTR");
		$this->Cell(50,3,"MUNIC�PIO","LTR");
		$this->Cell(20,3,"UF","LTR");
		$this->Cell(0,3,"INSCRI��O ESTADUAL","LTR",1);
		$this->SetFont('Times','',9);
		$this->Cell(100,5,substr('transporte_endereco', 0, 50),"LBR");
		$this->Cell(50,5,'transporte_municipio',"LBR");
		$this->Cell(20,5,'transporte_uf',"LBR");
		$this->Cell(0,5,'transporte_ie',"LBR",1);
		/*
		foreach($this->data['volumes'] as $value){
			//QUANTIDADE,ESP�CIE,MARCA,NUMERA��O,PESO BRUTO,PESO L�QUIDO
			$this->SetFont('Times','',5);
			$this->Cell(34,3,"QUANTIDADE","LTR");
			$this->Cell(34,3,"ESP�CIE","LTR");
			$this->Cell(34,3,"MARCA","LTR");
			$this->Cell(34,3,"NUMERA��O","LTR");
			$this->Cell(34,3,"PESO BRUTO","LTR");
			$this->Cell(0,3,"PESO L�QUIDO","LTR",1);
			$this->SetFont('Times','',9);
			$this->Cell(34,5,$value['volume_quantidade'],"LBR");
			$this->Cell(34,5,$value['volume_especie'],"LBR");
			$this->Cell(34,5,$value['volume_marca'],"LBR");
			$this->Cell(34,5,$value['volume_numeracao'],"LBR");
			$this->Cell(34,5,$value['volume_peso_bruto'],"LBR","0","R");
			$this->Cell(0,5,$value['volume_peso_liquido'],"LBR",1,"R");
		} */
		$this->Ln(3);
		
		//DADOS DO PRODUTO/SERVI�O
		$this->SetFont('Times','B',7);
		$this->Cell(0,3,"DADOS DO PRODUTO/SERVI�O",0,1);
		$this->SetFont('Times','',6);
		
		//CABE�ALHO DE PRODUTOS
		
		$imposto_vr_icms_st =  (float)'imposto_vr_icms_st';
		
		$this->Cell(20,4,"C�DIGO",1,0,"C");
		if($imposto_vr_icms_st){
			$this->Cell(37,4,"DESCRI��O DOS PRODUTOS",1,0,"C");
		}
		else{
			$this->Cell(50,4,"DESCRI��O DOS PRODUTOS",1,0,"C");
		}
		
		$this->Cell(13,4,"NCM/SH",1,0,"C");
		$this->Cell(7,4,"CST",1,0,"C");
		$this->Cell(10,4,"CFOP",1,0,"C");
		$this->Cell(7,4,"UNID",1,0,"C");
		$this->Cell(13,4,"QUANT",1,0,"C");
		$this->Cell(14,4,"V.UNIT�RIO",1,0,"C");
		$this->Cell(9,4,"V.DESC",1,0,"C");
		$this->Cell(11,4,"V.TOTAL",1,0,"C");
		$this->Cell(11,4,"BC ICMS",1,0,"C");
		$this->Cell(10,4,"V. ICMS",1,0,"C");
		if($imposto_vr_icms_st){
			$this->Cell(13,4,"V. ICMS ST.",1,0,"C");
		}
		$this->Cell(9,4,"V. IPI",1,0,"C");
		$this->Cell(12,4,"ALIQ. ICMS",1,0,"C");
		$this->Cell(0,4,"ALIQ. IPI",1,1,"C");
		
		//tamanho da linha para produtos;
		$l = 4;
		/*
		foreach($this->data['itens'] as $value){
			$y = $this->getY();
			$x = $this->getX();
			$descricao	= str_split(['item_descricao'], 35);
			$tam = count($descricao);
			$descricao	= implode('', $descricao);
				
			if(!empty($value['item_inf_adic'])){
				$descricao = $descricao." \n ".$value['item_inf_adic'];
			}
				
			//jogando o x para segunda coluna
			$this->SetXY($x+20,$y);
			$linhas = $this->GetStringWidth($descricao) / 35;
				
			//Verifica se a descri��o tem mais de uma linha caso tenha vai quebrar a linha em 270
			if($linhas < 1)
				$break_line = 280;
			else
				$break_line = 260;
		
			if($y+$linhas >= $break_line){
				$this->AddPage();
				$y = $this->getY();
				$x = $this->getX();
				$this->SetXY($x+20,$y);
			}
				
			if($imposto_vr_icms_st){
				$this->MultiCell(37,3,$descricao);
			}
			else{
				$this->MultiCell(50,3,$descricao);
			}
				
			$y1=$this->GetY();
			$this->SetXY($x,$y);
			$l = ($y1-$y);
			$this->Cell(20,$l,$value['item_cod'],1,0);
			$y = $this->getY();
			$x = $this->getX();
				
			if($imposto_vr_icms_st){
				$this->Cell(37,$l,"",1,0);
			}
			else{
				$this->Cell(50,$l,"",1,0);
			}
				
			//$this->Cell(53,$l,$value['item_descricao']." ".$value['item_inf_adic'],1,0);
			$this->Cell(13,$l,$value['item_ncm'],1,0,"C");
			$this->Cell(7,$l,$value['item_cst'],1,0,"C");
			$this->Cell(10,$l,$value['item_cfop'],1,0,"C");
			$this->Cell(7,$l,$value['item_unid'],1,0,"C");
			$this->Cell(13,$l,$value['item_quantidade'],1,0,"R");
			$this->Cell(14,$l,$value['item_valor_unitario'],1,0,"R");
			$this->Cell(9,$l,$value['item_valor_desconto'],1,0,"R");
			$this->Cell(11,$l,$value['item_valor_total'],1,0,"R");
			$this->Cell(11,$l,$value['item_bc_icms'],1,0,"R");
			$this->Cell(10,$l,$value['item_valor_icms'],1,0,"R");
			if($imposto_vr_icms_st){
				$this->Cell(13,$l,$value['item_valor_icms_st'],1,0,"R");
			}
			$this->Cell(9,$l,$value['item_valor_ipi'],1,0,"R");
			$this->Cell(12,$l,$value['item_aliquota_icms'],1,0,"R");
			$this->Cell(0,$l,$value['item_aliquota_ipi'],1,1,"R");
		}
		*/
		$this->Ln(4);
		//INFORMA��ES COMPLEMENTARES,RESERVADO AO FISCO
		//valida��o
		$y = $this->GetY();
		if($y+12 >=275){
			$this->AddPage();
		}
		
		//DADOS ADICIONAIS
		$this->SetFont('Times','B',7);
		$this->Cell(0,3,"DADOS ADICIONAIS",0,1);
		$this->SetFont('Times','',5);
		
		//INFORMA��ES COMPLEMENTARES,RESERVADO AO FISCO
		$y = $this->GetY();
		$x = $this->GetX();
		
		$this->SetFont('Times','',9);
		
		$this->SetHeightRow(3);
		$this->SetWidths(array(150,56));
		$this->Row(array(" \n{'informacoes_complementares'}", "\n{'informacoes_fisco'}"));
		
		//INFORMA��ES COMPLEMENTARES,RESERVADO AO FISCO
		$y = $this->SetXY($x, $y);
		$this->SetFont('Times','',5);
		$this->Cell(150,3,"INFORMA��ES COMPLEMENTARES","LTR");
		$this->Cell(0,3,"RESERVADO AO FISCO","LTR",1);
		
		//		$this->Cell(150,40,"","LBR");
		//		$this->Cell(0,20,"","LBR");
		//
		//		$this->SetXY($x, $y+4);
		//		$this->MultiCell(150,3,substr($this->data['informacoes_complementares'],0, 450),0);
		//		$this->SetXY($x+103, $y+4);
		//		$this->MultiCell(103,3,$this->data['informacoes_fisco'],0);
		//		$this->SetXY($x, $y+4);
		
	}
	
	
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Text color in gray
		$this->SetTextColor(128);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}

	function ChapterTitle($num, $label)
	{
		// Arial 12
		$this->SetFont('Arial','',12);
		// Background color
		$this->SetFillColor(200,220,255);
		// Title
		$this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
		// Line break
		$this->Ln(4);
	}

	function ChapterBody($file)
	{
		// Read text file
		$txt = ($file);
		// Times 12
		$this->SetFont('Times','',12);
		// Output justified text
		$this->MultiCell(0,5,$txt);
		// Line break
		$this->Ln();
		// Mention in italics
		$this->SetFont('','I');
		$this->Cell(0,5,'(end of excerpt)');
	}

	function PrintChapter($num, $title, $file)
	{
		$this->AddPage();
		$this->ChapterTitle($num,$title);
		$this->ChapterBody($file);
	}
	
	public function dadosDanfe($id){
		$this->ar = Pedidos_Model::get_by_id($id);
	}
	
}


function Header_teste()
{

	
	$this->SetFont('Times','',5);
	$this->Cell(160,3,"RECEBEMOS DE ".strtoupper("Teste")." OS PRODUTOS CONSTANTES DA NOTA FISCAL INDICADA AO LADO","LTR",0,"C");
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->Ln();
	$this->SetFont('Times','',9);
	$this->Cell(160,5," ","LRB",1);

	$this->SetFont('Times','',5);
	$this->Cell(30,3,"DATA DO RECEBIMENTO","LTR",0);
	$this->Cell(130,3,"IDENTIFICAÇÃO E ASSINATURA DO RECEBEDOR","LTR",1);
	$this->SetFont('Times','',9);
	$this->Cell(30,5," ","LRB",0);
	$this->Cell(130,5," ","LRB",1);

	$this->SetY($tpY);
	$this->SetX($tpX);

	$this->SetFont('Times','',5);
	$this->Cell(0,3,"NF-e","LTR",1,"C");
	$this->SetFont('Times','',9);
	$this->SetX($tpX);
	$this->MultiCell(0,6.5,"Nº {12} \n SÉRIE: {12}" ,"LRB","C");

	$this->Ln(2);

	$tpY = $this->GetY();
	$tpX = $this->GetX();

	$image_path = null;
	list($width, $height, $type, $attr)= getimagesize($image_path);

	if (max($width,$height) == $width){
		$height = ($height * 28) / $width;
		$width = 28;
	}
	else{
		$width = ($width * 28) / $height;
		$height = 28;
	}
	$this->SetY($tpY +3);
	$this->Image($image_path,null,null,$width,$height);

	$this->SetY($tpY);
	$this->SetX($tpX+30);
	$this->SetFont('Times','B',9);
	$X = $this->GetX()+70;
	//tratamento para dados multicell
	$this->MultiCell(70,4,"\n".strtoupper("emitente"),"0","L");
	$this->SetFont('Times','',9);
	$this->SetX($tpX+30);
	$this->MultiCell(70,4,"{$this->ar->getEmitente()->getNome()} \n {teste} - {teste2} - CEP {teste} \n FONE {teste} \n "
	,"0","L");
	$Y = $this->GetY();
	$tp1 = $this->GetY() - $tpY;
	$this->SetY($tpY);
	$this->SetX($tpX);
	$this->Cell(100,36,"",1);
	$this->SetX($X);
	$this->SetFont('Times','',6);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->MultiCell(30,2,"\n\n\n\n DOCUMENTO AUXILIAR DE NOTA FISCAL ELETR�NICA \n\n\n  \n\n\n\n N� {teste} \n S�RIE {teste} \n\n P�GINA {teste} de {$this->PageGroupAlias()} \n\n",1,"C");
	$this->SetY($tpY+2);
	$this->SetX($tpX);
	$this->SetFont('Times','B',9);
	$this->Cell(30,4,"DANFE",0,0,"C");
	$this->SetFont('Times','',6);
	$this->SetY($tpY+17);
	$this->SetX($tpX);
	$this->Cell(35,2,"      0 - ENTRADA",0,0);
	$this->SetY($tpY+20);
	$this->SetX($tpX);
	$this->Cell(35,2,"      1 - SAIDA",0,0);
	$this->SetY($tpY+17);
	$this->SetX($tpX+20);
	$this->SetFont('Times','B',6);
	$this->Cell(4,5,"teste",1,0,"C");
	$this->SetY($tpY);
	$this->SetX($tpX+30);

	//controle do fisco
	$this->SetFont('Times','',5);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->Cell(0,3,'CONTROLE DO FISCO',"LTR",0);
	$this->SetY($tpY+3);
	$this->SetX($tpX);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->SetFont('Times','',9);
	$x = $this->GetX();
	$y = $this->GetY();
	$this->Cell(0,15,'',"LRB",0);
	if(!empty($teste))
		$this->Code128($x+4,$y+2,$this->data['nota_chave_acesso_sequencial'],68,10);

	//CHAVE DE ACESSO
	$this->SetFont('Times','',5);
	$this->SetY($tpY+15);
	$this->SetX($tpX);
	$this->Cell(0,3,'CHAVE DE ACESSO',"LTR",0);
	$this->SetY($tpY+18);
	$this->SetX($tpX);
	$tpY = $this->GetY();
	$tpX = $this->GetX();
	$this->SetFont('Times','',7);
	$this->Cell(0,5,"teste","LRB",0,"C");

	//CONSULTA AUTENTICIDADE NO PORTAL ....
	$this->SetFont('Times','',7);
	$this->SetY($tpY+7);
	$this->SetX($tpX);
	$this->MultiCell(0,3,"Consulta de autenticidade no portal nacional da NF-e www.nfe.fazenda.gov.br/portal ou no site da Sefaz autorizadora ","0","C");
	$this->SetY($tpY+5);
	$this->SetX($tpX);
	$this->Cell(0,10,"",1,1);

	//NATUREZA DA OPERA��O, PROTOCOLO DE AUTORIZACAO DE USO
	$this->SetFont('Times','',5);
	$this->Cell(130,3,"NATUREZA DA OPERA��O","LTR",0);
	$this->Cell(0,3,"PROTOCOLO DE AUTORIZA��O DE USO","LTR",1);
	$this->SetFont('Times','',9);
	$this->Cell(130,5,"teste","LRB",0);
	$this->Cell(0,5,"teste2","LRB",1);

	//INSCRICAO ESTADUAL, INSC. ESTADUAL DO SUBST. TRIBUTARIO, CNPJ
	$this->SetFont('Times','',5);
	$this->Cell(80,3,"INSCRI��O ESTADUAL","LTR",0);
	$this->Cell(70,3,"INSCRI��O ESTADUAL DO SUBST. TRIBUT�RIO","LTR",0);
	$this->Cell(0,3,"CNPJ","LTR",1);
	$this->SetFont('Times','',9);
	$this->Cell(80,5,"teste","LRB",0);
	$this->Cell(70,5,"teste","LRB",0);
	$this->Cell(0,5,"teste","LRB",1);

	$this->Ln(3);

}

$pdf = new PDF();
$pdf->dadosDanfe(571);
$title = '20000 Leagues Under the Seas';
$pdf->SetTitle($title);
$pdf->SetAuthor('DANFE');
//$pdf->PrintChapter(1,'A RUNAWAY REEF','MERDA MERDA MERDA ');
//$pdf->PrintChapter(2,'THE PROS AND CONS','MERDA MERDA MERDA');
$pdf->Output();


?>