<?php?>
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
                Entre em contato
            </h2>
            <form
                action = "<?php echo BASENAME; ?>/suporte"
                method = "POST"
                class="d-flex flex-column mw-xs m-auto p-4"
            >
                <label>
                    <small>
                        Nome
                    </small>
                    <input type="text" class="form-control" placeholder="Nome" name="name" title="Nome">
                </label>
                <label>
                    <small>
                        Email
                    </small>
                    <input type="email" class="form-control" placeholder="Email" name="email" title="email">
                </label>
                <div class="container p-0">
                    <div class="row p-0">
                        <div class="col-12 col-md-4">
                            <label class="d-block">
                                <small>
                                    Estado
                                </small>
                                <select id="ibge-states" class="form-control" name="state" title="Estado"></select>
                            </label>
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="d-block">
                                <small>
                                    Cidade
                                </small>
                                <select id="ibge-cities" disabled class="form-control" name="city" title="Cidade"></select>
                            </label>
                        </div>
                    </div>
                </div>
                <label>
                    <small>
                        Mensagem
                    </small>
                    <textarea class="form-control mw-xs m-auto p-1" name="message"></textarea>
                </label>
                <div class="m-auto">
                    <div class="g-recaptcha" data-sitekey="6LdrHKQUAAAAANj0T6g7KhffKVNEQttg9cxItnHI"></div>
                    <button class="btn btn-success btn-block mt-3">
                        Enviar
                    </button>
                </div>
            </form>
        </main>

        <?php call_footer(); ?>
        <?php call_scripts(); ?>

    </body>
</html>





<?php
?>