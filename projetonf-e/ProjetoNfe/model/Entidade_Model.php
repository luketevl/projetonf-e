<?php

class Entidade_Model{
    
    static function getEmpresa(){
        DataBase::conectar();
    $query = "select * from opcoes ";
        $result = mysql_query($query);
        while($row = mysql_fetch_assoc($result)){
            $e = new Entidade();
            $end = new Enderecos();
            //echo "<pre>". print_r($row) . "</pre>";
            $end->setBairro($row['bairro']);
            $end->setCep($row['cep_origem']);
            $end->setCidade($row['cidade']);
            $end->setEstado($row['estado']);
            $end->setNumero($row['numero']);
            $end->setPais($row['pais']);
            $end->setRua($row['endereco']);
            
            $e->setNome($row['razao_social']);
            $e->setCpf_cnpj($row['cnpj']);
            $e->setEndereco($end);
            $e->setIe($row['inscricao_estadual']);
            $e->setTelefone($row['telefone']);
            
        }
        return $e;
    }
}
