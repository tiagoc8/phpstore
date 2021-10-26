<?php 
//print_r($_SESSION); ?>

<div class="container espaco_fundo">
    <div class="row">
        <div class="col-12 text-center my-3">

            <a href="?a=loja&c=todos" class="btn btn-primary">Todos</a>

            <?php foreach($categorias as $categoria):?>
                <a href="?a=loja&c=<?= $categoria ?>" class="btn btn-primary"><?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?></a>
            <?php endforeach;?>

        </div>
    </div>    

    

    <div class="row">

        <?php if(count($produtos) == 0):?>
            <div class="text-center my-5">
                <h3>Não existem produtos disponíveis</h3>
            </div>
        <?php else:?>

            <?php foreach($produtos as $produto): ?>
                <div class="col-sm-4 col-6 p-2">
                    <div class="text-center p-3 box-produto">
                        <img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid">
                        <h3><?= $produto->nome_produto ?></h3>
                        <h1><?= preg_replace("/\./", ",",$produto->preco) . "€" ?></h1>
                        <div>
                            <?php if($produto->stock > 0) :?>
                                <button class="btn btn-primary" onclick="adicionar_carrinho(<?= $produto->id_produto ?>)"><i class="fas fa-shopping-cart"></i> Adicionar ao carrinho</button>
                            <?php else:?>
                                <button class="btn btn-danger"><i class="fas fa-shopping-cart"></i> Sem stock</button>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endforeach;?> 

        <?php endif;?>

        
    </div>
</div>