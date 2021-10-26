<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;

class Carrinho{

    public function adicionar_carrinho(){

        if(!isset($_GET['id_produto'])){
            header('Location: ' . BASE_URL . 'index.php?a=loja');
            return;
        }

        $id_produto = $_GET['id_produto'];

        $produtos = new Produtos();
        $resultados = $produtos->verificar_stock_produto($id_produto);
        if(!$resultados){
            header('Location: ' . BASE_URL . 'index.php?a=loja');
            return;
        }

        $carrinho = [];

        if(isset($_SESSION['carrinho'])){
            $carrinho = $_SESSION['carrinho'];
        }

        if(key_exists($id_produto, $carrinho)){
            $carrinho[$id_produto]++;
        }else{
            $carrinho [$id_produto] = 1;
        }

        $_SESSION['carrinho'] = $carrinho;

        $total_produtos = 0;

        foreach($carrinho as $produto_quantidade){
            $total_produtos += $produto_quantidade;
        }

        echo $total_produtos;
    }

    public function limpar_carrinho(){
        unset($_SESSION['carrinho']);

        $this->carrinho();  
    }


    public function carrinho(){

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

}