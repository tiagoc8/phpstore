<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Registo de novo cliente</h3>
            <form action="?a=criar_cliente" method="post">

                <?php if(isset($_SESSION['erro'])):?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif; ?>

                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email" placeholder="email" class="form-control" required >
                </div>

                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" required >
                </div>

                <div class="my-3">
                    <label>Repetir a senha</label>
                    <input type="password" name="text_senha_2" placeholder="Repetir a senha" class="form-control" required >
                </div>

                <div class="my-3">
                    <label>Nome completo</label>
                    <input type="text" name="text_nome_completo" placeholder="Nome completo" class="form-control" required >
                </div>

                <div class="my-3">
                    <label>Morada</label>
                    <input type="text" name="text_morada" placeholder="Morada" class="form-control" required >
                </div>

                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade" placeholder="Cidade" class="form-control" required >
                </div>
 
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone" placeholder="Telefone" class="form-control">
                </div>

                
                <div class="my-4 text-center">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>

            </form>


        </div>
    </div>
</div>