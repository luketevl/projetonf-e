<?php

class Nfe_Services{
	
	static function createXmlCancel($data,$justificativa){

		//Instanciamos o objeto passando como valor a versão do XML e o encoding (código de caractéres)
		$dom = new DOMDocument('1.0','UTF-8');

		//Nesse ponto, informamos para o objeto que não queremos espaços em branco no documento
		$dom->preserveWhiteSpaces = false;

		//Aqui, dizemos para o objeto que queremos gerar uma saída formatada
		$dom->formatOutput = true;

		$envEvento = $dom->createElement('envEvento');
		$envEvento->setAttribute('xmlns','http://www.portalfiscal.inf.br/nfe');
		$envEvento->setAttribute('versao','1.00');

		$idLote = $dom->createElement('idLote');

		$evento = $dom->createElement('evento');
		$evento->setAttribute('versao','1.00');

		$infEvento = $dom->createElement('infEvento');
		$infEvento->setAttribute('Id','ID1101113114011345905700010355778110000155180500001501');

		$cOrgao = $dom->createElement('cOrgao');
		$tpAmb = $dom->createElement('tpAmb');
		$CNPJ = $dom->createElement('CNPJ');
		$chNFe = $dom->createElement('chNFe');
		$dhEvento = $dom->createElement('dhEvento');
		$infEvento = $dom->createElement('infEvento');
		$tpEvento = $dom->createElement('tpEvento');
		$nSeqEvento = $dom->createElement('nSeqEvento');
		$verEvento = $dom->createElement('verEvento');

		$detEvento = $dom->createElement('detEvento');
		$detEvento->setAttribute('versao','1.00');

		$descEvento = $dom->createElement('descEvento');
		$nProt = $dom->createElement('nProt');
		$xJust = $dom->createElement('xJust');



		$idLoteVal =  $dom->createTextNode('000000110000156');

		$cOrgaoVal = $dom->createTextNode($data->getEmitente()->getEndereco()->getcodUF());

		$tpAmbVal = $dom->createTextNode('1');

		$CNPJVal = $dom->createTextNode($data->getEmitente()->getCpf_cnpj());

		$chNFeVal = $dom->createTextNode($data->getChave_acesso());

		$dhEventoVal = $dom->createTextNode(date('Y-m-d t h:m:s\-02:00').'2014-01-10T12:41:54-02:00');

		$tpEventoVal = $dom->createTextNode('110111');

		$nSeqEventoVal = $dom->createTextNode('1');

		$verEventoVal = $dom->createTextNode('1.00');

		$descEventoVal = $dom->createTextNode('Cancelamento');

		$nProtVal = $dom->createTextNode('131140038101315');

		$xJustVal = $dom->createTextNode($justificativa);




		$idLote->appendChild($idLoteVal);
		$cOrgao->appendChild($cOrgaoVal);
		$tpAmb->appendChild($tpAmbVal);
		$CNPJ->appendChild($CNPJVal);
		$chNFe->appendChild($chNFeVal);
		$dhEvento->appendChild($dhEventoVal);
		$tpEvento->appendChild($tpEventoVal);
		$nSeqEvento->appendChild($nSeqEventoVal);
		$verEvento->appendChild($verEventoVal);
		$descEvento->appendChild($descEventoVal);
		$nProt->appendChild($nProtVal);
		$xJust->appendChild($xJustVal);



		$envEvento->appendChild($idLote);
		$envEvento->appendChild($evento);
		$evento->appendChild($infEvento);

		$infEvento->appendChild($cOrgao);
		$infEvento->appendChild($tpAmb);
		$infEvento->appendChild($CNPJ);
		$infEvento->appendChild($chNFe);
		$infEvento->appendChild($dhEvento);
		$infEvento->appendChild($tpEvento);
		$infEvento->appendChild($nSeqEvento);
		$infEvento->appendChild($verEvento);
		$infEvento->appendChild($detEvento);

		$detEvento->appendChild($descEvento);
		$detEvento->appendChild($nProt);
		$detEvento->appendChild($xJust);

		$dom->appendChild($envEvento);

		//Por fim, para salvarmos o documento, utilizamos o método save()

		$dom->save('../resources/nfe/'.$data->getChave_acesso().'-env-canc.xml');
		echo " <br />XML Cancelamento criado ";
		echo '../resources/nfe/'.$data->getChave_acesso().'-ped-inu.xml ,<br />';
	}

	static function createXmlInutilizacao($data,$justificativa){

		//Instanciamos o objeto passando como valor a versão do XML e o encoding (código de caractéres)
		$dom = new DOMDocument('1.0','UTF-8');

		//Nesse ponto, informamos para o objeto que não queremos espaços em branco no documento
		$dom->preserveWhiteSpaces = false;

		//Aqui, dizemos para o objeto que queremos gerar uma saída formatada
		$dom->formatOutput = true;

		$inutNFe = $dom->createElement('inutNFe');
		$inutNFe->setAttribute('xmlns','http://www.portalfiscal.inf.br/nfe');
		$inutNFe->setAttribute('versao','2.00');
		$infInut = $dom->createElement('infInut');
		$infInut->setAttribute('Id','ID1101113114011345905700010355778110000155180500001501');

		$xServ = $dom->createElement('xServ');
		$tpAmb = $dom->createElement('tpAmb');
		$CNPJ = $dom->createElement('CNPJ');
		$cUF = $dom->createElement('cUF');
		$ano = $dom->createElement('ano');
		$mod = $dom->createElement('mod');
		$serie = $dom->createElement('serie');
		$nNFIni = $dom->createElement('nNFIni');
		$nNFFin = $dom->createElement('nNFFin');
		$xJust = $dom->createElement('xJust');


		$xServVal =  $dom->createTextNode('INUTILIZAR');

		$cUFVal = $dom->createTextNode($data->getEmitente()->getEndereco()->getcodUF());

		$tpAmbVal = $dom->createTextNode('1');
		$anoVal = $dom->createTextNode(date('y'));

		$CNPJVal = $dom->createTextNode($data->getEmitente()->getCpf_cnpj());

		$modVal = $dom->createTextNode('55');
		$serieVal = $dom->createTextNode($data->getSerie());
		$nNFIniVal = $dom->createTextNode($data->getDocumento());
		$nNFFinVal = $dom->createTextNode($data->getDocumento());
		$xJustVal = $dom->createTextNode($justificativa);
		$xServ->appendChild($xServVal);
		$cUF->appendChild($cUFVal);
		$tpAmb->appendChild($tpAmbVal);
		$CNPJ->appendChild($CNPJVal);
		$ano->appendChild($anoVal);
		$mod->appendChild($modVal);
		$serie->appendChild($serieVal);
		$nNFIni->appendChild($nNFIniVal);
		$nNFFin->appendChild($nNFFinVal);
		$xJust->appendChild($xJustVal);
		$inutNFe->appendChild($infInut);

		$infInut->appendChild($tpAmb);
		$infInut->appendChild($xServ);
		$infInut->appendChild($cUF);
		$infInut->appendChild($ano);
		$infInut->appendChild($CNPJ);
		$infInut->appendChild($mod);
		$infInut->appendChild($serie);
		$infInut->appendChild($nNFIni);
		$infInut->appendChild($nNFFin);

		$infInut->appendChild($xJust);
/*
*/
		$dom->appendChild($inutNFe);

		//Por fim, para salvarmos o documento, utilizamos o método save()

		$dom->save('../resources/nfe/'.$data->getChave_acesso().'-ped-inu.xml');

		echo " <br /> XML INUTILIZACAO criado em ";
		echo '../resources/nfe/'.$data->getChave_acesso().'-ped-inu.xml ,<br />';
	}

	static function geraChaveNfe($data){
		$cUF = $data->getEmitente()->getEndereco()->getCodUF();    //Código da UF [02] 
		$aamm = '1102';     //AAMM da emissão [4]
		$cnpj = $data->getEmitente()->getCpf_cnpj();     //CNPJ do Emitente [14]
		$mod='55';      //Modelo [02]
		$serie='001';     //Série [03]
		$num= $data->getNfe_numero();       //Número da NF-e [09]
		$tpEmis='1';     //forma de emissão da NF-e [01] 1 – Normal – emissão normal; 2 – Contingência FS; 3 – Contingência SCAN; 4 – Contingência DPEC; 5 – Contingência FS-DA 
		$cn='';         //Código Numérico [08]
		$dv='';         //DV [01]


		//ajusta comprimento do numero
		$num = str_pad($num, 9, '0',STR_PAD_LEFT);
		//calcula codigo numérico aleatório
		$cn = Nfe_Services::geraCN(8);

		//monta a chave sem o digito verificador
		$chave = "$cUF$aamm$cnpj$mod$serie$num$tpEmis$cn";
		//calcula o digito verificador
		$dv = Nfe_Services::calculaDV($chave);

		$chave .= $dv;

		$n = strlen($chave);


		/* echo 'cUF = '.$cUF.'<BR>';
		echo 'AAMM = '.$aamm.'<BR>';
		echo 'CNPJ = '.$cnpj.'<BR>';
		echo 'MOD = '.$mod.'<BR>';
		echo 'SERIE = '.$serie.'<BR>';
		echo 'NUM = '.$num.'<BR>';
		echo 'tpEmis = '.$tpEmis.'<BR>';
		echo 'CODIGO = '.$cn.'<BR>';
		echo 'DV = '.$dv.'<BR>';
		echo "CHAVE = $chave  [$n]"; */
		return $chave ;
	}
		static function geraCN($length=8){
		    $numero = '';    
		    for ($x=0;$x<$length;$x++){
		        $numero .= rand(0,9);
		    }
		    return $numero;
		}


		static function calculaDV($chave43) {
		    $multiplicadores = array(2,3,4,5,6,7,8,9);
		    $i = 42;
		    while ($i >= 0) {
		        for ($m=0; $m<count($multiplicadores) && $i>=0; $m++) {
		            $soma_ponderada+= $chave43[$i] * $multiplicadores[$m];
		            $i--;
		        }
		    }
		    $resto = $soma_ponderada % 11;
		    if ($resto == '0' || $resto == '1') {
		        return 0;
		    } 
		    else {
		        return (11 - $resto);
		   }
		}

		static function validaXML($arq){
			//$arq = 'xml/11101284613439000180550010000004881093997017-nfe.xml';
			//$arq = './35120358716523000119550000000162421280334154-nfe.xml';
			$nfe = new ToolsNFePHP;
			$docxml = file_get_contents($arq);
			$xsdFile = '../helper/ws/schemes/PL_006n/nfe_v2.00.xsd';
			$aErro = '';
			$c = $nfe->validXML($docxml,$xsdFile,$aErro);
			if (!$c){
			    echo 'Houve erro --- <br>';
			    foreach ($aErro as $er){
			        echo $er .'<br>';
			    }
			} else {
			    echo 'VALIDADA!';
			}
		}
		static function assinaXML($file){

			$nfe = new ToolsNFePHP;

			//$file = 'xml/35130471780456000160550010000000411000000410-nfe.xml';
			$arq = file_get_contents($file);

			if ($xml = $nfe->signXML($arq, 'infNFe')){
				echo "<br />XML ASSINADO <br />"; 
			    file_put_contents($file, $xml);
			} else {
			    echo $nfe->errMsg;
			}
		}

		static function createXMLAprovacao($arq,$nfe){

			//instancia a classe
			$nfeHelper = new ConvertNFePHP();

			if ( is_file($arq) ){
				//echo '../resources/nfe/txt/'.$nfe->getDados()->getChave_acesso().'-nfe.xml';

			    $xml = $nfeHelper->nfetxt2xml($arq);
			    $xml = $xml[0];
			    if ($xml != ''){
			    	echo "XML NF-e criado ";
			    	echo '../resources/nfe/'.$nfe->getDados()->getChave_acesso().'-nfe.xml '."<br />";
			        echo '<PRE>';
			        echo htmlspecialchars($xml);
			        echo '</PRE><BR>';
				   if (!file_put_contents('../resources/nfe/txt/'.$nfe->getDados()->getChave_acesso().'-nfe.xml',$xml)){
		            echo "ERRO na gravação";
		        }
					// Faz processa de comunicacao com a sefaz
		        //Nfe_Services::processaNFE($arq);
			    }
			    else{
			    	echo "XML em branco <br />";
			    }
			}
			return $arq;
		}

		static function processaNFE($arq){
	        Nfe_Services::assinaXML($arq);
	        Nfe_Services::validaXML($arq);
		}

		static function verificaDisponibilidade(){

			$nfe = new ToolsNFePHP;
			header('Content-type: text/html; charset=UTF-8');
			$sUF = 'AC;AL;AM;AP;BA;CE;DF;ES;GO;MA;MG;MS;MT;PA;PB;PE;PI;PR;RJ;RN;RO;RR;RS;SC;SE;SP;TO';
			//$sUF = 'PR'; //falha ao utilizar PR com SOAP nativo

			//determina o tipo de conector 1-SOAP ou 2-cURL
			$modSOAP = '2';
			//determina o ambiente 1-produção 2-homologação
			$tpAmb= '2';
			//habilita uso do scan
			//$nfe->enableSCAN = true;

			$aUF = explode(';',$sUF);

			if($tpAmb == 1){
			    $sAmb='Produção';
			} else {
			    $sAmb='Homologação';
			}
			foreach ($aUF as $UF){
			    echo '<BR><HR/><BR>';
			    echo $UF . '[' . $sAmb . '] - modSOAP = ' . $modSOAP  . '<BR>';
			    $resp = $nfe->statusServico($UF,$tpAmb,$modSOAP);
			    
			    echo print_r($resp);
			    echo '<BR>';
			    echo $nfe->errMsg.'<BR>';
			    echo '<PRE>';
			    echo htmlspecialchars($nfe->soapDebug);
			    echo '</PRE><BR>';
			    echo $UF . '[' . $sAmb . '] - ' . $resp['xMotivo'] . '<BR><BR><HR/><BR>';
			    flush();
}

		}

		static function inutilizar($data){
			/*
			 * Exemplo de solicitação de Inutilização de faixa de numeros 
			 * da NFe (modelo 55)
			 */
			$nfe = new ToolsNFePHP('', 2, false);

			$nAno = date('y');//ano atual com 2 digitos
			$nSerie = '1';//numero da serie da NFe que será inutilizada
			$nIni = '1';// numero inicial da faixa que será inutilizada
			$nFin = '1';// numero final da faixa que será inutilizada
			$xJust = 'Falha na gravação da base de dados'; // entre 15 e 255 dígitos
			$tpAmb = '2';//homologação
			$modSOAP = '2';//usando cURL

			header('Content-type: text/html; charset=UTF-8');

			if ($xml = $nfe->inutNF($nAno, $nSerie, $nIni, $nFin, $xJust, $tpAmb, $modSOAP)) {
			    //houve retorno mostrar dados
			    echo '<BR>';
			    echo '<PRE>';
			    echo htmlspecialchars($nfe->soapDebug);
			    echo '</PRE>';
			    echo '<BR>';
			    echo 'Retorno da Solicitação de Inutilização';
			    echo '<BR>';
			    echo '<PRE>';
			    echo htmlspecialchars($xml);
			    echo '</PRE>';
			} 
			else {
			    //não houve retorno mostrar erro de comunicação
			    echo "Houve erro na comunicação !! $nfe->errMsg";
			    echo '<BR>';
			    echo '<PRE>';
			    echo htmlspecialchars($nfe->soapDebug);
			    echo '</PRE>';
			    echo '<BR>';
			}
       
		}

		static function enviaNfe($data){
			/*
			 * Exemplo de envio de Nfe já assinada e validada
			 */
			$nfe = new ToolsNFePHP;
			$modSOAP = '2'; //usando cURL

			//use isso, este é o modo manual voce tem mais controle sobre o que acontece
			$filename = '../resources/nfe/'.$data->getChave_acesso().'-nfe.xml';
			$filename = '../resources/nfe/35101158716523000119550010000000011003000000-nfe.xml';
			//obter um numero de lote
			$lote = substr(str_replace(',','',number_format(microtime(true)*1000000,0)),0,15);
			// montar o array com a NFe
			$aNFe = array(0=>file_get_contents($filename));
			//enviar o lote
			if ($aResp = $nfe->sendLot($aNFe, $lote, $modSOAP)){
			    if ($aResp['bStat']){
			        echo "Numero do Recibo : " . $aResp['nRec'] .", use este numero para obter o protocolo ou informações de erro no xml com testaRecibo.php.";
			    } else {
			        echo "Houve erro 1!! $nfe->errMsg";
			    }
			} else {
			    echo "houve erro 2 !!  $nfe->errMsg";
			}
			echo '<BR><BR><h1>DEBUG DA COMUNICAÇÕO SOAP</h1><BR><BR>';
			echo '<PRE>';
			echo htmlspecialchars($nfe->soapDebug);
			echo '</PRE><BR>';
		}

		static function geraDANFE($arq){
			// Passe para este script o arquivo da NFe
			$arq = 'xml/35101158716523000119550010000000011003000000-nfe.xml';

			if ( is_file($arq) ){
			    $docxml = file_get_contents($arq);
			    $danfe = new DanfeNFePHP($docxml, 'P', 'A4','../images/logo.jpg','I','');
			    $id = $danfe->montaDANFE();
			    $arquivoPDFDanfe = $danfe->printDANFE($id.'.pdf','I');
			}
		}
}