<?php
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

		$query =
		"select p.documento, p.nfe_numero , pro.titulo

		from pedidos p
		join pedidos_itens ip on ip.pedido = p.id
		join produtos pro on ip.produto = pro.id where p.documento= '$id' order by p.id;";

		$result = mysql_query($query);

		$ar = array();
		$i= 0;
		$p = new Pedidos();
		$pi = new PedidosItens();		
		while ($row = mysql_fetch_assoc($result)) {
			$prod = new Produtos();
			$i ++;
			
			$e = new Entidade();
			$e->setNome($row['documento']);
			$e->setCpf_cnpj($row['documento']);
			$e->setEndereco($row['documento']);
			$e->setIe($row['documento']);
			$e->setTelefone($row['documento']);
			$ar['emitente']= $e;
			

			$d = new Entidade();
			$d->setNome($row['documento']);
			$d->setCpf_cnpj($row['documento']);
			$d->setEndereco($row['documento']);
			$d->setIe($row['documento']);
			$d->setTelefone($row['documento']);
			$ar['destinatario']= $d;

			
			$t = new Entidade();
			$t->setNome($row['documento']);
			$t->setCpf_cnpj($row['documento']);
			$t->setEndereco($row['documento']);
			$t->setIe($row['documento']);
			$t->setTelefone($row['documento']);
			$ar['transportadora']=$t;

			
			$p->setDocumento($row['documento']);
			$p->setBc_icms($row['documento']);
			$p->setBc_icms_st($row['documento']);
			$p->setDesconto($row['documento']);
			$p->setDespesas_acessorias($row['documento']);
			$p->setDestinatario($d);
			$p->setEmitente($e);
			$p->setInfo_complementares($row['documento']);
			$p->setTotal_prod($row['documento']);
			$p->setTransportadora($t);
			$p->setVr_frete($row['documento']);
			$p->setVr_icms($row['documento']);
			$p->setVr_ipi($row['documento']);
			$p->setVr_seguro($row['documento']);
			$p->setVr_total_nota($row['documento']);
			
				
			$pi->setAliq_icms($value);
			$pi->setAliq_ipi($value);
			$pi->setBc_icms($value);
			$pi->setProdutos($value);
			$pi->setQtd($value);
			$pi->setVr_desc($value);
			$pi->setVr_icms($value);
			$pi->setVr_ipi($value);
			$pi->setVr_total($value);
			
			$ar['produtos'] = $p;
			$ar['produtos'][$i]['cod']=$row['titulo'];
			$ar['produtos'][$i]['desc']=$row['titulo'];
			$ar['produtos'][$i]['ncm']=$row['titulo'];
			$ar['produtos'][$i]['cfop']=$row['titulo'];
			$ar['produtos'][$i]['und']=$row['titulo'];
			$ar['produtos'][$i]['qtd']=$row['titulo'];
			$ar['produtos'][$i]['vr_unitario']=$row['titulo'];
			$ar['produtos'][$i]['vr_desc']=$row['titulo'];
			$ar['produtos'][$i]['vr_total']=$row['titulo'];
			$ar['produtos'][$i]['bc_icms']=$row['titulo'];
			$ar['produtos'][$i]['vr_icms']=$row['titulo'];
			$ar['produtos'][$i]['vr_ipi']=$row['titulo'];
			$ar['produtos'][$i]['aliq_icms']=$row['titulo'];
			$ar['produtos'][$i]['aliq_ipi']=$row['titulo'];
	

			$p->setPedidosItens($pi);
			
			$ar['pedido']=$p;
		}
		echo "<pre>";
		echo print_r($ar);
		echo "</pre>";
		return $ar;
	}
}