<?php

/*  Classe de conexao com bando de dados.
 *
* @author lukete
* @since 16/12/13
* @version 1.0
*/
// https://phpmyadmin.locaweb.com.br/

class DataBase{
	private $server='186.202.152.100';
	private $user='portaldecifra15';
	private $pass='ikat1612';
	private $database='portaldecifra15';
	 
	static function conectar(){

		//conexão com o servidor
		$conect = mysql_connect($server, $user, $pass);
	  
		// Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
		if ($conect){
			// Caso a conexão seja aprovada, então conecta o Banco de Dados.
			$db = mysql_select_db($database);
			echo '<h1>Conectado ao Banco de Dados!</h1>';
			return TRUE;
		}
		else {
			die ("<h1>Falha na conexão com o Banco de Dados!</h1>");
			return FALSE;
		}
	}
	 

}