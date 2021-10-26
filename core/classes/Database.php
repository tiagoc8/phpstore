<?php

namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database{

    private $ligacao;

    private function ligar(){
        $this->ligacao = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function desligar(){
        $this->ligacao = null;
    }

    public function select($sql, $parametros = null){

        if(!preg_match("/^SELECT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução SELECT.');
        }
        
        $this->ligar();

        $resultados = null;

        try {

            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }else{
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
            
        } catch (PDOException $e) {
            
        }

        $this->desligar();

        return $resultados;
    }

    public function insert($sql, $parametros = null){

        if(!preg_match("/^INSERT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução INSERT');
        }

        $this->ligar();

        try {

            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            }else{
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
            
        } catch (PDOException $e) {
            
        }

        $this->desligar();
    }

    public function update($sql, $parametros = null){

        if(!preg_match("/^UPDATE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução UPDATE');
        }

        $this->ligar();

        try {

            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            }else{
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
            
        } catch (PDOException $e) {
            
        }

        $this->desligar();

    }

    public function delete($sql, $parametros = null){

        if(!preg_match("/^DELETE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução DELETE');
        }

        $this->ligar();

        try {

            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            }else{
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
            
        } catch (PDOException $e) {
            
        }

        $this->desligar();

    }

    public function statement($sql, $parametros = null){

        if(preg_match("/^(SELECT|INSERT|UPDATE|DELETE/i", $sql)){
            throw new Exception('Base de dados - Instrução inválida');
        }

        $this->ligar();

        try {

            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            }else{
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
            
        } catch (PDOException $e) {
            
        }

        $this->desligar();

    }
}
