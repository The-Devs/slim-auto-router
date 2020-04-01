<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>URL</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/icon.min.css" />
        <link rel="stylesheet" href="<?php echo STYLES_PATH; ?>index.css" />

        <style>
            
        </style>
    </head>
    <body>

        <aside class="ui visible left sidebar">
            <figure>
                <img
                    src="<?php echo IMAGES_PATH . $user; ?>.jpg"
                    alt=""
                    class="ui circular small image"
                />
            </figure>

            <ul class="ui animated list">
                <div class="item">
                    <i class="male middle aligned large icon"></i>
                    <div class="content">
                        <div class="header">
                            Apresentação
                        </div>
                        <div class="description">Um pouco sobre mim.</div>
                    </div>
                </div>
                <div class="item">
                    <i class="images outline middle aligned large icon"></i>
                    <div class="content">
                        <div class="header">
                            Portfólio
                        </div>
                        <div class="description">Trabalhos que participei.</div>
                    </div>
                </div>
                <div class="item">
                    <i class="handshake outline middle aligned large icon"></i>
                    <div class="content">
                        <div class="header">
                            Contribuições
                        </div>
                        <div class="description">Feito para a comunidade.</div>
                    </div>
                </div>
                <div class="item">
                    <i class="heartbeat middle aligned large icon"></i>
                    <div class="content">
                        <div class="header">
                            Interesses
                        </div>
                        <div class="description">Interesses principais.</div>
                    </div>
                </div>
                <div class="item">
                    <i class="comments outline middle aligned large icon"></i>
                    <div class="content">
                        <div class="header">
                            Contato
                        </div>
                        <div class="description">Canais para contato.</div>
                    </div>
                </div>
            </ul>
        </aside>

        <main class="pusher ui padded grid">
        </main>

    </body>
</html>