<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <?php call_head(); ?>
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    <body>
        <?php call_topbar(); ?>

        <main class="pt-5 my-5">
            <h2 class="text-center m-auto">
                Acesso ao sistema
            </h2>
            <form
                action = "<?php echo BASENAME; ?>/login"
                method = "POST"
                class="d-flex flex-column mw-xs m-auto p-4"
            >
                <label>
                    <small>
                        Login
                    </small>
                    <input type="text" class="form-control" placeholder="Login" name="userName">
                </label>
                <label>
                    <small>
                        Senha
                    </small>
                    <input type="password" class="form-control" placeholder="Senha" name="password"><br>
                </label>
                <div class="m-auto">
                    <div class="g-recaptcha" data-sitekey="6LdrHKQUAAAAANj0T6g7KhffKVNEQttg9cxItnHI"></div>
                    <button class="btn btn-success btn-block mt-3">
                        Enviar
                    </button>
                    <div
                        id="message"
                        class="text-danger font-sm-1 text-center"
                    ><?php 
                    if(!empty($_GET['no-captcha'])){
                        echo 'Por favor, marque a opção "Não sou um robô" antes de enviar os dados.';
                    } 
                    if(!empty($_GET['no-user'])){
                        echo 'Usuário não encontrado.';
                    } 
                    if(!empty($_GET['no-password'])){
                        echo 'Senha inválida.';
                    } 
                    ?></div>
                </div>
            </form>
        </main>

        <?php call_footer(); ?>
        <?php call_scripts(); ?>

    </body>
</html>