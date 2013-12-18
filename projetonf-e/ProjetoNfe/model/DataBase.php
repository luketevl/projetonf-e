<?php

/**  Classe de conexao com bando de dados.
* @author lukete
* @since 16/12/13
* @version 1.0
*/
// https://phpmyadmin.locaweb.com.br/

class DataBase{
	
	/**
	 * Metodo que conecta no banco de dados e seleciona tabela
	 * @author lukete
	 * @since 18/12/2013
	 * @version 1.0
	 * @return boolean
	 */
	static function conectar(){
		 $server='186.202.152.100';
		 $user='portaldecifra15';
		 $pass='ikat1612';
		 $database='portaldecifra15';
		//conexão com o servidor
		$conect = mysql_connect($server, $user, $pass);
	  
		// Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
		if ($conect){
			// Caso a conexão seja aprovada, então conecta o Banco de Dados.
			$db = mysql_select_db($database);
//			echo '<h1>Conectado ao Banco de Dados!</h1>';
			return TRUE;
		}
		else {
			die ("<h1>Falha na conexão com o Banco de Dados!</h1>");
			return FALSE;
		}
	}
	 

}