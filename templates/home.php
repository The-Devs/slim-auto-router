<!DOCTYPE html>
<html lang="pt-br">

    <head>

        
        <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet"> 

        <link href="<?php echo STYLES_PATH; ?>admin-app/main.css" rel="stylesheet" />

        <!-- DEV -->
        <script src="<?php echo SCRIPTS_PATH; ?>admin-app/vue.dev.js"></script>
        <!-- PROD -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->
        <script src="https://kit.fontawesome.com/e1df53984c.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

        <style>
            h1,
            h2 {
                font-family: 'Fredoka One', cursive;
            }

            .text-thin {
                max-width: 300px !important;
                margin: auto;
            }
        </style>
        
    </head>

    <body>

        <main class="w-100">
            <section id="hero" class="d-flex flex-column bg-primary">
                <div
                    class="p-2 w-100 py-sm-5"
                    style="background-color: rgba( 0,0,0,0.6 );"
                >
                    <div class="m-auto d-flex flex-column my-sm-5">

                        <div class="py-5 d-flex flex-column">
                            <h1
                                class="text-center text-white"
                            >
                                <small class="font-weight-bold mw-xs">
                                    GERENCIE SEU <br> NEGÓCIO
                                </small>
                            </h1>
                
                            <div class="text-center text-white d-flex justify-content-center my-3">
                                <span class="m-3">
                                    <div>
                                        <i class="fas fa-2x fa-map-marker-alt mx-1"></i>
                                    </div>
                                    <div>
                                        De onde estiver
                                    </div>
                                </span>
                                <span class="m-3">
                                    <div>
                                        <i class="fas fa-2x fa-clock mx-1"></i>
                                    </div>
                                    <div>
                                        A qualquer hora
                                    </div>
                                </span>
                            </div>
                
                            <div class="my-5 pb-5 d-flex flex-column flex-sm-row mx-auto">
                                
                                <div class="my-2 mr-sm-2">
                                    <a
                                        href="https://wa.me/+5521964470631/?text=Oi.%20Tenho%20interesse%20no%20sistema%20administrativo%20da%20The%20Devs.%20Gostaria%20de%20tirar%20algumas%20d%C3%BAvidas."
                                        class="d-flex btn btn-info"
                                    >
                                        <span class="mr-2">
                                            <i class="fab fa-whatsapp"></i>
                                        </span>
                                        <span class="mx-auto my-auto">
                                            Fale Conosco
                                        </span>
                                    </a>
                                </div>
                
                                <div class="my-2 ml-sm-2">
                                    <a
                                        href="/admin-app/inicio"
                                        class="d-flex btn btn-outline-info"
                                    >
                                        <span class="mr-2">
                                            <i class="fas fa-link"></i>
                                        </span>
                                        <span class="mx-auto my-auto">
                                            Experimente Agora
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </section>

            <section id="about" class="py-5 container-fluid bg-light">

                    <div class="row text-center mw-sm m-auto">
                        <div class="col-12 mb-5">
                            <h2 class="text-uppercase">
                                <strong class="m-auto">
                                    Vantagens
                                </strong>
                            </h2>
                            <p class="text-muted">
                                <small>
                                    Conheça algumas vantagens dos sistema administrativo do The Devs.
                                </small>
                            </p>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="my-3 mx-sm-2">
                                <figure class="display-3 m-3 text-yellow">
                                    <i class="fas fa-dollar-sign"></i>
                                </figure>
                                <p class="text-thin text-muted">
                                    Preços acessíveis que não pesam no orçamento da sua empresa, mesmo sendo um pequeno negócio que está se iniciando.
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="my-3 mx-sm-2">
                                <figure class="display-3 m-3 text-blue">
                                    <i class="fas fa-wifi"></i>
                                </figure>
                                <p class="text-thin text-muted">
                                    Você pode acompanhar o desenvolvimento da empresa de qualquer lugar a qualquer momento, basta conexão com a internet.
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="my-3 mx-sm-2">
                                <figure class="display-3 m-3 text-green">
                                    <i class="fas fa-lock"></i>
                                </figure>
                                <p class="text-thin text-muted">
                                    Os dados da sua empresa estão protegidos. Só é possível acessar os dados com a senha e as chaves corretas.
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="my-3 mx-sm-2">
                                <figure class="display-3 m-3 text-pink">
                                    <i class="fas fa-palette"></i>
                                </figure>
                                <p class="text-thin text-muted">
                                    Padrões estilizáveis que permitem alterar cores, fontes, imagem de logotipo além de curvatura de bordas.
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="my-3 mx-sm-2">
                                <figure class="display-3 m-3 text-dark">
                                    <i class="fas fa-search"></i>
                                </figure>
                                <p class="text-thin text-muted">
                                    Simples e fácil de encontrar qualquer informação inserida no sistema através dos mecanismos de paginação e filtro de dados.
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="my-3 mx-sm-2">
                                <figure class="display-3 m-3 text-info">
                                    <i class="fas fa-headset"></i>
                                </figure>
                                <p class="text-thin text-muted">
                                    Equipe de suporte para orientar, sanar dúvidas e atender emergências. Acompanhamos seu negócio desde o início.
                                </p>
                            </div>
                        </div>

                    </div>
                    
            </section>

            <section id="example" class="d-flex flex-column py-5">

                <h2 class="text-center text-uppercase">
                    <strong>
                        Como Utilizar
                    </strong>
                </h2>
                <div class="text-center text-dark mx-auto d-flex flex-column">
                    <p class="mx-auto my-2">
                        Assita o vídeo e entenda como funciona todo o processo desde o início.
                    </p>
                    <div class="mx-auto my-3">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/2xH3vIwgDbw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="mw-sm d-flex m-auto py-2">
                    
                    <div class="mr-2">
                        <a
                            href="https://wa.me/+5521964470631/?text=urlencodedtext"
                            class="d-flex btn btn-info"
                        >
                            <span class="mr-2">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <span class="my-auto">
                                Fale Conosco
                            </span>
                        </a>
                    </div>
                    <div class="ml-2">
                        <a
                            href="/admin-app/inicio"
                            class="d-flex btn btn-outline-info"
                        >
                            <span class="mr-2">
                                <i class="fas fa-link"></i>
                            </span>
                            <span class="my-auto">
                                Experimente Agora
                            </span>
                        </a>
                    </div>
                </div>

            </section>

            <section id="example" class="d-flex flex-column py-5">

                <h2 class="text-center text-uppercase">
                    <strong>
                        Nossos Planos
                    </strong>
                </h2>
                <div class="text-center text-dark mx-auto d-flex flex-column">
                    <p class="mx-auto my-2">
                        Escolha um plano de acordo com as necessidades do seu negócio.
                    </p>
                </div>

                <div class="row m-auto py-2">

                    <div class="col-12 col-sm-4 p-2">
                        <div class="card h-100 m-md-4">
                            <div class="card-body bg-info text-white">
                                <div class="d-flex mb-4">
                                    <h5 class="card-title">Plano Administrativo</h5>
                                    <span class="ml-auto"> R$25,00</span>
                                </div>
                                <p class="card-text">Plano Administrativo inclui registros de clientes, funcionárias/os, produtos e serviços.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Clientes
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Funcionárias/os
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Produtos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Serviços
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Registro de Pedidos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo de Pagamentos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo de disparo de emails
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo eCommerce Integrado
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo de Estatísticas
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-12 col-sm-4 p-2">
                        <div class="card h-100 m-md-4">
                            <div class="card-body bg-warning">
                                <div class="d-flex mb-4">
                                    <h5 class="card-title">Plano Financeiro</h5>
                                    <span class="ml-auto"> R$50,00</span>
                                </div>
                                <p class="card-text">Mesmas funções do Plano Administrativo incluindo registros de pedidos e módulo de pagamentos.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Clientes
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Funcionárias/os
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Produtos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Serviços
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Pedidos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Módulo de Pagamentos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo de disparo de emails
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo eCommerce Integrado
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo de Estatísticas
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 p-2">
                        <div class="card h-100 m-md-4">
                            <div class="card-body bg-success text-white">
                                <div class="d-flex mb-4">
                                    <h5 class="card-title">Plano Comercial</h5>
                                    <span class="ml-auto"> R$70,00</span>
                                </div>
                                <p class="card-text">Inclui todas as funções do Plano Financeiro além de um eCommerce disponibilizando a venda dos produtos e serviços registrados no sistema, disparo de email permitindo Email Marketing.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Clientes
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Funcionárias/os
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Produtos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Serviços
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Registro de Pedidos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Módulo de Pagamentos
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Módulo de disparo de emails
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="mx-1">
                                        Módulo eCommerce Integrado
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <span class="mx-1">
                                        Módulo de Estatísticas
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

            </section>

            <section class="row bg-yellow text-dark py-5">
				<div 
					class="col-12 py-5 text-center"
				>
					<h2>
						Grátis por uma semana
					</h2>
					<p class="my-5 mx-auto mw-xs p-2">
						Escolha um nome de usuário e uma senha. Informe um email e enviaremos os <a href="/admin-app/termos-de-uso" target="_blank" rel="noopener noreferrer">termos de uso</a> e o boleto do plano escolhido com vencimento em 7 dias após instalação do sistema. Após preencher o formulário há um prazo de 12h para o sistema ser instalado e você ter acesso. De qualquer forma, um email será enviado avisando que já está acessível.
					</p>
                    <div>
                        <form @submit="checkForm" id="form" class="m-auto mw-xs">
                            <div class="text-left my-3 w-xs mx-auto">
                                <small>
                                    Usuário
                                </small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input
                                        required
                                        id="username"
                                        type="text"
                                        v-model="username"
                                        class="form-control"
                                        title="Nome de usuário deve conter apenas letras minúsculas, pontos e números totalizando no mínimo 6 caracteres"
                                        placeholder="Mínimo de 6 caracteres"
                                        pattern="[a-z0-9\.]{6,}"
                                    />
                                </div>
                            </div>

                            <div class="text-left my-3 w-xs mx-auto">
                                <small>
                                    Senha
                                </small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input
                                        required
                                        id="password"
                                        :type="( visible )? 'text': 'password'"
                                        v-model="password"
                                        class="form-control"
                                        title="Senha deve conter mínimo de 8 caracteres."
                                        placeholder="Mínimo de 8 caracteres"
                                        pattern=".{8,}"
                                    />
                                    <div class="input-group-append">
                                        <span
                                            class="input-group-text"
                                            v-on:click="togglePassw"
                                        >
                                            <i v-if="visible" class="fas fa-eye"></i>
                                            <i v-if="!visible" class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-left my-3 w-xs mx-auto">
                                <small>
                                    Email
                                </small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input
                                        required
                                        id="email"
                                        type="email"
                                        v-model="email"
                                        class="form-control"
                                        placeholder="Seu email"
                                    />
                                </div>
                            </div>

                            <div class="ml-2">
                                <button class="btn btn-success">
                                    <span>
                                        <i class="fas fa-user-plus"></i>
                                    </span>
                                    <span class="mx-1">
                                        Cadastrar usuário
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
				</div>
			</section>

        </main>

        <?php call_footer(); ?>

        <script>
            function resizeIframe ( ev ) {
                const width = window.innerWidth;
                let iFrame = document.querySelector( "iframe" );
                if ( width <= 560 ) {
                    iFrame.setAttribute( "width", width );
                    iFrame.setAttribute( "heigth", width/1.778 );
                    console.log( width, width/1.778 );
                }
            }
            if ( window.innerWidth <= 560 ) {
                document.querySelector( "iframe" ).setAttribute( "width", window.innerWidth );
            }
            window.addEventListener( "resize", resizeIframe );
            
            new Vue( {
                el: "#form",
                data: {
                    username: "",
                    password: "",
                    email: "",
                    visible: false
                },
                methods: {
                    togglePassw: function () {
                        this.visible = ! this.visible;
                    },
                    usernameHandler: function ( ev ) {
                        // this.username.match( /\s/ )
                    },
                    checkForm: function ( ev ) {
                        ev.preventDefault();
                    }
                }
            } );
        </script>
    </body>
</html>
