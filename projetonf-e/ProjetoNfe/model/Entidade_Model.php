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
            $end->setCodUF('11');
            $e->setEndereco($end);
            $e->setNome($row['razao_social']);
            $e->setNomeFantasia($row['nome_fantasia']);
            $e->setCpf_cnpj($row['cnpj']);
            $e->setIe($row['inscricao_estadual']);
            $e->setIM($row['inscricao_municipal']);
            $e->setTelefone($row['telefone']);
        }
        return $e;
    }
}
