<?php

class Historico_Model{
	
	static function insert($h){
		DataBase::conectar();
		$query = 'insert into nfe_historico'
				 . 'values('
				 	. "'',"
				 	."'". $h->getId_nota_fiscal() ."',"
				 	."'". $h->getChave() ."',"
				 	."'". $h->getCod_motivo() ."',"
				 	."now(),"
				 	."'". $h->getMotivo() ."',"
				 	."'". $h->getNum_protocolo() ."',"
				 	."'". $h->getSituacao() ."',"
				 	."'". $h->getMotivo_Detalhado() ."'"
			 	 .');';
		mysql_query($query) or die(mysql_error());
		mysql_close();
	}

}