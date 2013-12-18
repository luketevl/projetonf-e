<?php
require('../controller/Entidades.php');
require('../controller/Pedidos.php');
require('../controller/PedidosItens.php');
require('../controller/Produtos.php');
require('../model/DataBase.php');
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
		"select p.*, ip.* , pro.* , pro.id as 'id_prod'
		 , cli.razao_social as 'cli_razao_social', cli.cnpj as 'cli_cnpj' ,cli.inscricao_estadual as 'cli_inscricao_estadual', cli.endereco as 'cli_endereco', cli.telefone as 'cli_telefone'
		 , tran.razao_social as 'tran_razao_social', tran.cnpj as 'tran_cnpj' ,tran.inscricao_estadual as 'tran_inscricao_estadual', tran.endereco as 'tran_endereco', tran.telefone as 'tran_telefone' 
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
		while ($row = mysql_fetch_assoc($result)) {

			$pi = new PedidosItens();		
			$prod = new Produtos();
			$i ++;
			
			$e = new Entidade();
			$e->setNome($row['razao_social']);
			$e->setCpf_cnpj($row['cnpj']);
			$e->setEndereco($row['endereco']);
			$e->setIe($row['inscricao_estadual']);
			$e->setTelefone($row['telefone']);
			
			//$ar['emitente']= $e;
			
			$d = new Entidade();
			$d->setNome($row['cli_razao_social']);
			$d->setCpf_cnpj($row['cli_cnpj']);
			$d->setEndereco($row['cli_endereco']);
			$d->setIe($row['cli_inscricao_estadual']);
			$d->setTelefone($row['cli_telefone']);
			//$ar['destinatario']= $d;

			
			$t = new Entidade();
			$t->setNome($row['tran_razao_social']);
			$t->setCpf_cnpj($row['tran_cnpj']);
			$t->setEndereco($row['tran_endereco']);
			$t->setIe($row['tran_inscricao_estadual']);
			$t->setTelefone($row['tran_telefone']);
			
			//$ar['transportadora']=$t;

			
			$p->setNfe_numero($row['nfe_numero']);
			$p->setDocumento($row['documento']);
			$p->setSerie($row['nfe_serie']);
			$p->setBc_icms($row['preco_icms']);
			$p->setBc_icms_st($row['preco_icms_st']);
			$p->setDesconto($row['desconto']);
			$p->setDespesas_acessorias($row['despesas']);
			$p->setDestinatario($d);
			$p->setEmitente($e);
			$p->setTransportadora($t);
			$p->setInfo_complementares($row['observacao']);
			$p->setTotal_prod($row['total']);
			$p->setVr_frete($row['preco_frete']);
			$p->setVr_icms($row['preco_icms']);
			$p->setVr_ipi($row['incidencia_ipi']);
			$p->setVr_seguro(0);
			$p->setVr_total_nota($row['total']);
			
			$pi->setAliq_icms($row['total']);
			$pi->setAliq_ipi($row['val_ipi']);
			$pi->setBc_icms($row['base_icm']);
			$pi->setQtd($row['quantidade']);
			$pi->setVr_desc($row['desconto']);
			$pi->setVr_icms($row['val_icm']);
			$pi->setVr_ipi($row['val_ipi']);
			$pi->setVr_total($row['subtotal']);
			$ar['itens'][$i]= $pi;	
			
            $prod->setCod($row['id_prod']);
            $prod->setDesc($row['titulo']);
            $prod->setNcm($row['classificacao_fiscal']);
            $prod->setUnd($row['unidade']);
            $prod->setVr_unitario($row['preco_unitario']);

			$pi->setProdutos($prod);
			
			//$ar['produtos'][$i]['cfop']=$row['titulo'];
	
            
			$p->setPedidosItens($ar['itens']);
			
			//$ar['pedido']=$p;
		}
// 		echo "<pre>";
// 		echo print_r($p);
// 		echo "</pre>"; 
		return $p;
	}
}