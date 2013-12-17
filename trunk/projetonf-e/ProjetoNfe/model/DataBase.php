<?php

/*  Classe de conexao com bando de dados.
 * 
 * @author lukete
 * @since 16/12/13
 * @version 1.0
 */

class DataBase{

    private $server='';
    private $user='';
    private $pass='';
    private $banco='';
    private $database='';
    private $sql=null;    
    
    
    static function conectar(){
      /*
      * Método que conecta ao banco de dados passando
      * os valores necessários para que a conexão ocorra
      */
      $conexao = mysql_connect($this->server,$this->user,$this->pass) or die($this->mensagem(mysql_error()));
      return $conexao;
   }
    
    static function selecionarDB(){
      /*
      * Método que seleciona o banco de dados
      * com que irá trabalhar
      */
 
      $banco = mysql_select_db($this->database) or die($this->mensagem(mysql_error()));
      if($banco){
         return true;
      }else{
         return false;
      }
   }
 
   static function executar(){
      /*
      * Método que executa uma query no banco de dados
      */
      $query = mysql_query($this->sql) or die ($this->mensagem(mysql_error()));
      return $query;
   }
   
   static function mensagem($erro){
      /*
      * Função para exibir os possíveis erros
      * Separamos em um método, pois este pode ser estilizado,
      * sem alterar outros métodos
      */
      echo $erro;
   }
}