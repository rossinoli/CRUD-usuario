<?php

namespace App\Models\DAO;

use App\Lib\Conexao;

abstract class BaseDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConnection();
    }
    public function verifica($tabela, $col, $condicao) {
        if (!empty($tabela) && !empty($col) && !empty($condicao)) {

            $sql = " SELECT $col FROM $tabela WHERE $condicao ";
            $stmt = $this->conexao->prepare($sql);
            
            $stmt->execute();
            $result = $stmt->rowCount();
            
            return $result;
            
        }else{
            return 1;
        }
    } 

    public function select($sql) 
    {
        if(!empty($sql))
        {
            return $this->conexao->query($sql);
        }
    }

    public function insert($table, $cols, $values) 
    {
        if(!empty($table) && !empty($cols) && !empty($values))
        {
            $parametros    = $cols;
            $colunas       = str_replace(":", "", $cols);
            
            //             $table   $colunas             $cols
            //INSERT INTO usuario (nome,email) VALUES (:nome,:email);
            $stmt = $this->conexao->prepare("INSERT INTO $table ($colunas) VALUES ($parametros)");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }

    public function update($table, $cols, $values, $where=null) 
    {
        if(!empty($table) && !empty($cols) && !empty($values))
        {
            if($where)
            {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("UPDATE $table SET $cols $where");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }
    
    public function delete($table, $where=null) 
    {
        if(!empty($table)){
            
            if($where)
            {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("DELETE FROM $table $where");
            $stmt->execute();

            return $stmt->rowCount();
        }else{
            return false;
        }
    }
}
