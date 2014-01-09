<?php
require('../controller/Entidades.php');
require('../controller/Pedidos.php');
require('../controller/NfeHistorico.php');
require('../controller/PedidosItens.php');
require('../controller/Produtos.php');
require('../controller/Enderecos.php');
require('../model/DataBase.php');
require('../model/Entidade_Model.php');
/**
 * Classe que faz todas as consultas com o banco de dados
 *
 * @author lukete
 * @since 17/12/13
 *
 */
class Pedidos_Model{


	/**
	 * Faz busca do pedido pelo ID
	 *
	 * @author lukete
	 * @since 17/12/13
	 * @param int $id
	 * @return array de pedidos
	 *
	 */
	static function get_by_id($id){
		DataBase::conectar();
		$query =
		"select p.*, p.id as 'id_pedido', ip.*, pro.* , pro.id as 'id_prod'
		 , cli.razao_social as 'cli_razao_social', cli.cnpj as 'cli_cnpj' ,cli.inscricao_estadual as 'cli_inscricao_estadual', cli.endereco as 'cli_endereco', cli.telefone as 'cli_telefone', cli.numero as 'cli_numero' , cli.bairro as 'cli_bairro', cli.cidade as 'cli_cidade' , cli.estado as 'cli_estado' , cli.pais as 'cli_pais' , cli.cep as 'cli_cep'
		 , tran.razao_social as 'tran_razao_social', tran.cnpj as 'tran_cnpj' ,tran.inscricao_estadual as 'tran_inscricao_estadual', tran.endereco as 'tran_endereco', tran.telefone as 'tran_telefone', tran.numero as 'tran_numero' , tran.bairro as 'tran_bairro', tran.cidade as 'tran_cidade' , tran.estado as 'tran_estado' , tran.pais as 'tran_pais' , tran.cep as 'tran_cep' 
	from pedidos p 
		join pedidos_itens ip on ip.pedido = p.id
		join produtos pro on ip.produto = pro.id 
		join parceiros cli on p.cliente = cli.id	
		left join parceiros tran on p.transportadora = tran.id	
		
			
			where p.id= '$id' 
				order by p.id;";
		//echo $query;
		$result = mysql_query($query);
		$ar = array();
		$i= 0;
		$p = new Pedidos();
		$h = new NfeHistorico();
		while ($row = mysql_fetch_assoc($result)) {
			$ar['historicos'] = array();
			$pi = new PedidosItens();		
			$prod = new Produtos();
			$i ++;
			
			
			//$ar['emitente']= $e;
			
			$d = new Entidade();
			$end = new Enderecos();
			
			$end->setBairro($row['cli_bairro']);
			$end->setCep($row['cli_cep']);
			$end->setCidade($row['cli_cidade']);
			$end->setEstado($row['cli_estado']);
			$end->setNumero($row['cli_numero']);
			$end->setPais($row['cli_pais']);
			$end->setRua($row['cli_endereco']);
			
			
			$d->setNome($row['cli_razao_social']);
			
			$d->setCpf_cnpj($row['cli_cnpj']);
			$d->setEndereco($end);
			$d->setIe($row['cli_inscricao_estadual']);
			$d->setTelefone($row['cli_telefone']);
			
			
			//$ar['destinatario']= $d;

			
			$t = new Entidade();
			$end = new Enderecos();
			

			$end->setBairro($row['tran_bairro']);
			$end->setCep($row['tran_cep']);
			$end->setCidade($row['tran_cidade']);
			$end->setEstado($row['tran_estado']);
			$end->setNumero($row['tran_numero']);
			$end->setPais($row['tran_pais']);
			$end->setRua($row['tran_endereco']);
				
			
			$t->setNome($row['tran_razao_social']);
			$t->setCpf_cnpj($row['tran_cnpj']);
			$t->setEndereco($end);
			$t->setIe($row['tran_inscricao_estadual']);
			$t->setTelefone($row['tran_telefone']);
			
			//$ar['transportadora']=$t;

			
			$p->setNfe_numero($row['nfe_numero']);
			$p->setDocumento($row['documento']);
			$p->setSerie($row['nfe_serie']);
			$p->setBc_icms($row['preco_icms']);

			$p->setBc_icms_st($row['preco_icms_st']);
			$p->setDesconto($row['desconto']);
			$p->setDespesas_acessorias($row['despesa']);
			$p->setDestinatario($d);
			$p->setTransportadora($t);
			$p->setInfo_complementares($row['observacao']);
			$p->setTotal_prod($row['total']);
			$p->setVr_frete($row['preco_frete']);
			$p->setVr_icms($row['preco_icms']);
			$p->setVr_ipi($row['incidencia_ipi']);
			$p->setVr_seguro(0);
			$p->setVr_total_nota($row['total']);
			$p->setCfop_descricao($row['cfop_descricao']);
			$p->setCfop($row['cfop_descricao']);
			
			
			$pi->setAliq_icms($row['total']);
			$pi->setAliq_ipi($row['val_ipi']);
			
			$pi->setTotal_icms($row['total_icm']);
			
			$pi->setAliq_pis($row['aliqpis']);
			$pi->setAliq_cofins($row['aliqcof']);

			$pi->setBc_icms($row['base_icm']);
			$pi->setQtd($row['quantidade']);
			$pi->setVr_desc($row['desconto']);
			$pi->setVr_icms($row['val_icm']);
			$pi->setVr_ipi($row['val_ipi']);
			$pi->setCst_ipi($row['cstpis']);
			$pi->setCst_cofins($row['cstcof']);
			$pi->setVr_total($row['subtotal']);
			$pi->setTotal_prod($row['tot_prod']);
			$pi->setCfop($row['cfop']);
			$pi->setOrig($row['cst']{0});
			$pi->setCst(substr($row['cst'] , -2));
			$pi->setVr_unit_pedido($row['preco_unitario']);
			$ar['itens'][$i]= $pi;	
			
            $prod->setCod($row['id_prod']);
            $prod->setDesc($row['titulo']);
            $prod->setNcm($row['classificacao_fiscal']);
            $prod->setUnd($row['unidade']);
            $prod->setVr_unitario($row['preco_unitario']);
            $prod->setObservacoes($row['observacoes']);
            $prod->setObservacoes($row['tabela_st']);

            
			$pi->setProdutos($prod);
			
			//$ar['produtos'][$i]['cfop']=$row['titulo'];
	
            
			$p->setPedidosItens($ar['itens']);
			
			//$ar['pedido']=$p;
		}
        
        $tempEmitente = Entidade_Model::getEmpresa();
		$p->setEmitente($tempEmitente);
		$query = "select * from nfe_historico nfh where nfh.id_nota = ". $id . " order by nfh.id ASC limit 1";
		$result = mysql_query($query);
		//echo $query;
		$iHisto=0;
		while($row = mysql_fetch_assoc($result)){
			$h = new NfeHistorico();
			$h->setNum_protocolo($row['num_protocol']);
			$ar['historicos'][$iHisto] = $h;
			$iHisto++;
		}
		$p->setNfeHistorico($ar['historicos']);
		
		
// 		echo "<pre>";
// 		echo print_r($p);
// 		echo "</pre>"; 
		return $p;
	}
}