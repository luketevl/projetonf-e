<?php

/*  Classe de conexao com bando de dados.
 * 
 * @author lukete
 * @since 16/12/13
 * @version 1.0
 */
// https://phpmyadmin.locaweb.com.br/
     $server='186.202.152.100';
      $user='portaldecifra15';
      $pass='ikat1612';
      $database='portaldecifra15';
      $query=null;    
    
    
    //conexão com o servidor
    $conect = mysql_connect($server, $user, $pass);
    
    // Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
    if ($conect){
    // Caso a conexão seja aprovada, então conecta o Banco de Dados.
    $db = mysql_select_db($database);
    echo '<h1>Conectado ao Banco de Dados!</h1>';
    $query = 'select p.documento, p.nfe_numero , pro.titulo
from pedidos p 
join pedidos_itens ip on ip.pedido = p.id 
join produtos pro on ip.produto = pro.id where p.documento="879" order by p.id;';
    $result = mysql_query($query);
    
    $ar = array();
    while ($row = mysql_fetch_assoc($result)) {
    	$ar['documento']=$row['documento'];
    	$ar['emitente']['nome']=$row['documento'];
    	$ar['emitente']['endereco']=$row['documento'];
    	$ar['emitente']['telefone']=$row['documento'];

    	$ar['destinatario']['nome']=$row['documento'];
    	$ar['destinatario']['endereco']=$row['documento'];
    	$ar['destinatario']['telefone']=$row['documento'];
    	$ar['destinatario']['cpf/cnpj']=$row['documento'];
    	$ar['destinatario']['ie']=$row['documento'];
    	
    	$ar['transportadora']['nome']=$row['documento'];
    	$ar['transportadora']['endereco']=$row['documento'];
    	$ar['transportadora']['telefone']=$row['documento'];
    	$ar['transportadora']['cpf/cnpj']=$row['documento'];
    	$ar['transportadora']['ie']=$row['documento'];
    	
    	$ar['impostos']['bc_icms']=$row['documento'];
    	$ar['impostos']['vr_icms']=$row['documento'];
    	$ar['impostos']['bc_icms_st']=$row['documento'];
    	$ar['impostos']['vr_icms_st']=$row['documento'];
    	$ar['impostos']['total_prod']=$row['documento'];
    	$ar['impostos']['vr_frete']=$row['documento'];
    	$ar['impostos']['vr_seguro']=$row['documento'];
    	$ar['impostos']['desconto']=$row['documento'];
    	$ar['impostos']['despesas_acessorias']=$row['documento'];
    	$ar['impostos']['vr_ipi']=$row['documento'];
    	$ar['impostos']['vr_total_nota']=$row['documento'];
    	 
    	
    	$ar['produtos'][]['cod']=$row['titulo'];
    	$ar['produtos'][]['desc']=$row['titulo'];
    	$ar['produtos'][]['ncm']=$row['titulo'];
    	$ar['produtos'][]['cfop']=$row['titulo'];
    	$ar['produtos'][]['und']=$row['titulo'];
    	$ar['produtos'][]['qtd']=$row['titulo'];
    	$ar['produtos'][]['vr_unitario']=$row['titulo'];
    	$ar['produtos'][]['vr_desc']=$row['titulo'];
    	$ar['produtos'][]['vr_total']=$row['titulo'];
    	$ar['produtos'][]['bc_icms']=$row['titulo'];
    	$ar['produtos'][]['vr_icms']=$row['titulo'];
    	$ar['produtos'][]['vr_ipi']=$row['titulo'];
    	$ar['produtos'][]['aliq_icms']=$row['titulo'];
    	$ar['produtos'][]['aliq_ipi']=$row['titulo'];

    	$ar['info_complementares']=$row['documento'];
    	
    }
    echo "<pre>";
    echo print_r($ar);
    echo "</pre>";
    }
    else {
    	 die ("<h1>Falha na coneco com o Banco de Dados!</h1>");
}

