<?php 

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;

class Main{

    public function index(){

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/footer',
            'layouts/html_footer',
        ]);

    }

    public function loja(){

        $produtos = new Produtos();

        $c = 'todos';

        if(isset($_GET['c'])){
            $c = $_GET['c'];
        }

        $lista_produtos = $produtos->lista_produtos_disponiveis($c);
        $lista_categorias = $produtos->lista_categorias();

        $dados = [
            'produtos' => $lista_produtos,
            'categorias' => $lista_categorias,
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    public function novo_cliente(){

        if(Store::clienteLogado()){
            $this->index();
            return;
        }
        
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function criar_cliente(){

        if(Store::clienteLogado()){
            $this->index();
            return;
        } 

        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->index();
            return;
        }

        if($_POST['text_senha_1'] !== $_POST['text_senha_2']){

            $_SESSION['erro'] = 'As senhas não são iguais.';
            $this->novo_cliente();
            return;
        }

        $cliente = new Clientes();
        
        if($cliente->verificar_email_existe($_POST['text_email'])){
            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            $this->novo_cliente();
            return;
        }

        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = $cliente->registar_cliente();

        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);


        if($resultado){
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        }else{
            echo 'Ocorreu um erro';
        }

    }

    public function confirmar_email(){

        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        if(!isset($_GET['purl'])){
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        if(strlen($purl) != 12){
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($purl);

        if($resultado){
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'conta_validada_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {
            Store::redirect();
        }

    }

    public function login(){
        if(Store::clienteLogado()){
            Store::redirect();
            return;
        }

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_frm',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function login_submit(){
        if(Store::clienteLogado()){
            Store::redirect();
            return;
        }

        if($_SERVER['REQUEST_METHOD'] != 'POST' ){
            Store::redirect();
            return;
        }

        if(!isset($_POST['text_usuario']) || !isset($_POST['text_password']) || !filter_var(trim($_POST['text_usuario']), FILTER_VALIDATE_EMAIL)){
            $_SESSION['erro'] = 'Login inválido';
            STORE::redirect('login');
            return;
        }

        $usuario = trim(strtolower($_POST['text_usuario']));
        $password = trim($_POST['text_password']);

        $cliente = new Clientes();
        $resultado = $cliente->validar_login($usuario, $password);

        if(is_bool($resultado)){
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect();
            return;
        }else{
            $_SESSION['cliente'] = $resultado->id_cliente;
            $_SESSION['usuario'] = $resultado->email;
            $_SESSION['nome_cliente'] = $resultado->nome_completo;

            Store::redirect();
        }

    }

    public function logout(){

        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome_cliente']);

        Store::redirect();
    }

    
}