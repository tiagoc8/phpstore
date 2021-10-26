<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">
            <div>
                <h3 class="text-center">Login</h3>

                <?php if(isset($_SESSION['erro'])):?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']); ?>
                    </div>
                <?php endif;?>

                <form action="?a=login_submit" method="post">
                    <div class="my-3">
                        <label>Utilizador</label>
                        <input type="email" name="text_usuario" placeholder="Utilizador" class="form-control" required>
                    </div>
                    <div class="my-3">
                        <label>Senha</label>
                        <input type="password" name="text_password" placeholder="Senha" class="form-control" required>
                    </div>
                    <div class="my-3">
                        <input type="submit" value="Entrar" class="btn btn-primary text-center">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>