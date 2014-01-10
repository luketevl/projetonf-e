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

$dom->save('../resources/filename.xml');

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
}