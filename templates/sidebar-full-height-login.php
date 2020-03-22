<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <?php call_head( "admin-app" ); ?>
    </head>

    <body>

        <div
            id="app"
            class="d-flex"
        >
            <!-- Sidebar full Height -->
            <?php // call_sidebar( "admin-app" ); ?>
            <aside-nav nav="nav"></aside-nav>
            
            <!-- Main scrollable max-height:full Height -->
            <main class="p-sm-5 pb-5 w-100">
                <transition name="fade">
                    <div
                        v-if="message"
                        :class="messageClass + ' fixed-top container mr-0 p-4 opacity text-center'"
                    >
                        {{ message }}
                    </div>
                </transition>
                <div class="text-center">
                    <h2 class="my-4 text-uppercase text-primary">
                    <?php
                        if ( empty( $current[ "user" ] ) ) {
                            echo $current[ "title" ];
                        } else {
                    ?>
                        <span>
                            <i class="far fa-smile-beam"></i>
                        </span>
                        <span>
                            Olá, <?php echo $current[ "user" ]; ?>!
                        </span>
                    <?php } ?>
                    </h2>
                </div>
                
                <div class="my-5">

                    <?php if ( empty( $current[ "user" ] ) ) : ?>
                        <form @submit="login" class="m-auto mw-xs">
                            <div class="text-left my-3 w-xs px-2 mx-auto">
                                <small>
                                    Usuário
                                </small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-pContrast">
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

                            <div class="text-left my-3 w-xs px-2 mx-auto">
                                <small>
                                    Senha
                                </small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-pContrast">
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

                            <div class="ml-sm-2 my-4 mx-auto text-center">
                                <button class="btn btn-success">
                                    <span>
                                        <i v-if="!loading" class="fas fa-user"></i>
                                        <i v-if="loading" class="fas fa-spinner pulse"></i>
                                    </span>
                                    <span class="mx-1">
                                        Fazer login
                                    </span>
                                </button>
                            </div>

                            <div class="text-center">
                                <button
                                    v-on:click="forgotPassword"
                                    class="btn btn-link"
                                >
                                    Esqueci minha senha
                                </button>
                            </div>
                        </form> 
                    <?php else: ?>

                        <div class="text-center py-3 px-2">
                            <h3 class="text-info h4 opacity">
                                <i class="fas fa-question-circle"></i>
                                <span class="mx-1">
                                    Precisando de ajuda
                                </span>
                                <i class="fas fa-question-circle"></i>
                            </h3>
                        
                            <p class="text-muted mw-xs mx-auto mt-2 mb-5">
                                Entre em contato a qualquer momento que precisar por algum dos canais de comunicação listados abaixo.
                            </p>

                            <ul class="mw-xs list-unstyled mx-auto my-5 d-flex justify-content-around">
                                
                                <li class="m-2">
                                    <a
                                        href="http://"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="d-block"
                                    >
                                        <div>
                                            <i class="fab fa-lg fa-whatsapp"></i>
                                        </div>
                                        <div style="line-height: 1">
                                            Whatsapp
                                            <br />
                                            <small>
                                                21964470631
                                            </small>
                                        </div>
                                    </a>

                                </li>

                                <li class="m-2">
                                    <a
                                        href="https://www.facebook.com/thefulldevs/"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="d-block"
                                    >
                                        <div>
                                            <i class="fab fa-lg fa-facebook"></i>
                                        </div>
                                        <div style="line-height: 1">
                                            Facebook
                                            <br />
                                            <small>
                                                @thefulldevs
                                            </small>
                                        </div>
                                    </a>
                                </li>

                            </ul>

                            <div>


                                <div class="d-flex flex-column flex-sm-row justify-content-around">

                                    <div class="m-2 mt-auto">
                                        <button 
                                            v-if="!redefinePass"
                                            v-on:click="redefineToggle"
                                            class="btn btn-outline-success"
                                        >
                                            <span>
                                                <i class="fas fa-key"></i>
                                            </span>
                                            <span class="mx-1">
                                                Redefinir senha
                                            </span>
                                        </button>
                                        <button
                                            v-if="redefinePass"
                                            v-on:click="redefineToggle"
                                            class="btn btn-outline-danger"
                                        >
                                            <span>
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="mx-1">
                                                Cancelar
                                            </span>
                                        </button>
                                        <div v-if="redefinePass" class="mx-auto my-3 input-group" style="max-width:200px">
                                            <input
                                                required
                                                type="text"
                                                v-model="redefPassword"
                                                class="form-control"
                                                title="Mínimo de 8 caracteres"
                                                placeholder="Nova senha"
                                                pattern=".{8,}"
                                            />
                                            <div class="input-group-prepend" v-on:click="redefine">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-2 mt-4 mb-0 p-0 mt-sm-auto">
                                        <p
                                            class="mx-auto text-muted pt-2"
                                            style="max-width: 150px"
                                        >
                                            <small>
                                                Sair da sua conta de usuário.
                                            </small>
                                        </p>
                                        <button 
                                            v-on:click="logout"
                                            class="btn btn-success">
                                            <span>
                                                <i v-if="!loading" class="fas fa-user-alt-slash"></i>
                                                <i v-if="loading" class="fas fa-spinner pulse"></i>
                                            </span>
                                            <span class="mx-1">
                                                Encerrar sessão
                                            </span>
                                        </button>
                                    </div>

                                
                                </div>
                            
                            </div>

                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>


        <script>
            Vue.component( 'aside-nav', {
                props: {
                    nav: Object,
                },
                template: `<?php require( TEMPLATES_URI . "aside.html" ); ?>`
            } )
            new Vue( {
                el: "#app",
                data: {
                    nav: <?php echo $nav; ?>,
                    loading: false,
                    message: "",
                    messageClass: "bg-primary text-pContrast",
                    username: "",
                    password: "",
                    visible: false,
                    redefinePass: false,
                    redefPassword: "",
                    reload: false,
                },
                methods: {
                    login: function ( ev ) {
                        ev.preventDefault();
                        this.loading = true;
                        axios.post( "/api/login", {
                            username: this.username,
                            password: this.password,
                        } )
                        .then( res => {
                            const r = res.data;
                            this.messageHandler( r.message, r.messageType );
                            this.reload = r.reload;
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.loading = false;
                            if ( this.reload ) {
                                location.reload();
                            }
                        } );
                    },
                    messageHandler: function ( message, type = "primary" ) {
                        this.message = message;
                        switch ( type ) {
                            case "secondary":
                                this.messageClass = "bg-secondary text-sContrast";
                                break;
                            case "warning":
                                this.messageClass = "bg-warning";
                                break;
                            case "danger":
                                this.messageClass = "bg-danger text-white";
                                break;
                            case "info":
                                this.messageClass = "bg-info text-white";
                                break;
                            case "success":
                                this.messageClass = "bg-success text-white";
                                break;
                            default:
                                this.messageClass = "bg-primary text-pContrast";
                                break;
                        }
                        let self = this;
                        setTimeout( () => {
                            self.message = "";
                        }, 3000 );
                    },
                    togglePassw: function () {
                        this.visible = ! this.visible;
                    },
                    logout: function () {
                        this.loading = true;
                        axios.get( "/api/logout" )
                        .then( res => {
                            const r = res.data;
                            this.messageHandler( r.message, r.messageType );
                            this.reload = r.reload;
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.loading = false;
                            if ( this.reload ) {
                                location.reload();
                            }
                        } );
                    },
                    forgotPassword: function ( ev ) {
                        ev.preventDefault();
                        if ( this.username.length < 6 ) {
                            this.messageHandler( "Insira nome de usuário válido.", "warning" );
                        }
                        this.loading = true;
                        axios.post( "/api/password/" + this.username, {} )
                        .then( res => {
                            const r = res.data;
                            this.messageHandler( r.message, r.messageType );
                            this.reload = r.reload;
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.loading = false;
                            if ( this.reload ) {
                                location.reload();
                            }
                        } );
                    },
                    redefineToggle: function () {
                        this.redefinePass = ! this.redefinePass;
                    },
                    redefine: function ( ev ) {
                        ev.preventDefault();
                        if ( this.redefPassword.match( /.{8,}/ ) ) {
                            axios.post( "/api/password/<?php echo $_SESSION[ "user" ][ "username" ]; ?>", {
                                password: this.redefPassword,
                            } )
                            .then( res => {
                                const r = res.data;
                                this.messageHandler( r.message, r.messageType );
                                this.reload = r.reload;
                            } )
                            .catch( err => {
                                console.warn( err );
                            } )
                            .finally( () => {
                                this.loading = false;
                                if ( this.reload ) {
                                    location.reload();
                                }
                            } );
                        } else {
                            this.messageHandler( "A senha deve ter no mínimo 8 caracteres.", "warning" );
                        }
                    },
                },
                mounted: function () {}
            } );
        </script>
    </body>
</html>
