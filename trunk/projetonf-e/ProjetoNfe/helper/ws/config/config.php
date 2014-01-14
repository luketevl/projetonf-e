<?php

// Evita a exibição dos erros iniciais que aparecem ao instalar o sistema.
// Ao gravar as alterações pela primeira vez,
// esta linha é suprimida permitindo, então, a exibição dos erros
error_reporting(0);

//###############################
//#### CONFIGURAÇÕES GERAIS #####
//###############################
// Tipo de ambiente. Esta informação deve ser editada pelo sistema
// 1-Produção 2-Homologação
// Esta variável será utilizada para direcionar os arquivos e estabelecer o
// contato com o SEFAZ.
$ambiente=2;

// esta variável contêm o nome do arquivo com todas as url dos webservices do sefaz
// incluindo a versao dos mesmos, pois alguns estados não estão utilizando as
// mesmas versões
$arquivoURLxml='nfe_ws2.xml';
$arquivoURLxmlCTe="cte_ws1.xml";

// Diretório onde serão mantidos os arquivos com as NFe em xml
// a partir deste diretório serão montados todos os subdiretórios do sistema
// de manipulação e armazenamento das NFe. Não utilizar barra no final.
$arquivosDir='../../../nfe_producao';
$arquivosDirCTe='/cte';

// URL base da API, passa a ser necessária em virtude do uso dos arquivos wsdl
// para acesso ao ambiente nacional. Não utilizar barra no final.
$baseurl='http://localhost/ProjetoNfe/ProjetoNfe/';

// Versão em uso dos shemas utilizados para validação dos xmls
$schemes='PL_006n';
$schemesCTe="PL_CTE_104";

//###############################
//###### EMPRESA EMITENTE #######
//###############################
//Nome da Empresa

$e = Entidade_Model::getEmpresa();
$empresa=$e->getNome();
//Sigla da UF
$UF=$e->getEndereco()->getCidade();
//Código da UF
$cUF='11';
//Número do CNPJ
$cnpj=$e->getCpf_cnpj();

//$empresa='Sua Razao Social Aqui (sem acentos ou simbolos)';
//Sigla da UF
//$UF='SP';
//Código da UF
//$cUF='35';
//Número do CNPJ
//$cnpj='1234567890001';

//###############################
//#### CERITIFICADO DIGITAL #####
//###############################
//Nome do certificado que deve ser colocado na pasta certs da API
$certName='certificado_teste.pfx';
//Senha da chave privada
$keyPass='associacao';
//Senha de decriptaçao da chave, normalmente não é necessaria
$passPhrase='';

//###############################
//############ DANFE ############
//###############################
//Configuração do DANFE
$danfeFormato='P'; //P-Retrato L-Paisagem
$danfePapel='A4'; //Tipo de papel utilizado
$danfeCanhoto=1; //se verdadeiro imprime o canhoto na DANFE
$danfeLogo='/resources/img/logo.jpg'; //passa o caminho para o LOGO da empresa
$danfeLogoPos='L'; //define a posição do logo na Danfe L-esquerda, C-dentro e R-direta
$danfeFonte='Times'; //define a fonte do Danfe limitada as fontes compiladas no FPDF (Times)
$danfePrinter='hpteste'; //define a impressora para impressão da Danfe

//###############################
//############ DACTE ############
//###############################
//Configuração do DACTE
$dacteFormato="P"; //P-Retrato L-Paisagem 
$dactePapel="A4"; //Tipo de papel utilizado 
$dacteCanhoto=1; //se verdadeiro imprime o canhoto na DANFE 
$dacteLogo='/resources/img/logo.jpg'; //passa o caminho para o LOGO da empresa 
$dacteLogoPos="L"; //define a posição do logo na Danfe L-esquerda, C-dentro e R-direta 
$dacteFonte="Times"; //define a fonte do Danfe limitada as fontes compiladas no FPDF (Times) 
$dactePrinter="hpteste"; //define a impressora para impressão da Dacte 

//###############################
//############ EMAIL ############
//###############################
//Configuração do email
$mailAuth='1';
$mailFROM='nfe@seudominio.com.br';
$mailHOST='smtp.seudominio.com.br';
$mailUSER='nfe@seudominio.com.br';
$mailPASS='suasenha';
$mailPROTOCOL='';
$mailPORT='25';
$mailFROMmail='nfe@seudominio.com.br';
$mailFROMname='NFe';
$mailREPLYTOmail='nfe@seudominio.com.br';
$mailREPLYTOname='NFe';
$mailIMAPhost = 'mail.seudominio.com.br';
$mailIMAPport = '143';
$mailIMAPsecurity = 'tls';
$mailIMAPnocerts = 'novalidate-cert';
$mailIMAPbox = 'INBOX';

//###############################
//############ PROXY ############
//###############################
//Configuração de proxy
$proxyIP='';
$proxyPORT='';
$proxyUSER='';
$proxyPASS='';