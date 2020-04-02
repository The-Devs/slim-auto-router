<?php

// Array utilities
function isAssoc( array $arr ) {
    if ( array() === $arr ) return false;
    return array_keys( $arr ) !== range( 0, count($arr) - 1 );
}

function unPrefix ( $string ) {
    return explode( "_", $string )[ 1 ];
}

function unPrefixAll( $array ) {
    if ( isAssoc( $array ) ) {
        foreach ( array_keys( $array ) as $value ) {
            $keys[] = unPrefix( $value );
        }
        $unPrefixedArr = array_combine( $keys, array_values( $array ) );
    } else {
        foreach ( $array as $value ) {
            $unPrefixedArr[] = unPrefix( $value );
        }
    }
    return $unPrefixedArr;
}

// Templates
function call_sidebar ( string $appPrefix, $logo = "" ) {
    ?>
    <aside class="bg-primary d-none d-sm-block">
        <div class="my-3 mx-2 text-center">
            <?php if ( ! empty( $logo ) ): ?>
                <figure>
                    <img
                        src="<?php echo $logo; ?>"
                        alt="Admin App"
                    >
                </figure>
            <?php else: ?>
                <h2 class="border p-1 text-pContrast h5">
                    <span>
                        <i class="fas fa-upload"></i>
                    </span>
                    <small class="mx-1">
                        SUA LOGO
                    </small>
                </h2>
            <?php endif; ?>
        </div>
        <div>
            <nav class="p-2">
                <ul class="list-unstyled m-3">
                    <li class="mx-3 mt-0 mb-5">
                        <a
                            href="/"
                            class="d-block text-center text-pContrast"
                        >
                            <figure class="my-0">
                                <i class="fas fa-arrow-circle-left fa-lg"></i>
                            </figure>
                            <span style="font-size: 0.8em;">
                                The Devs
                            </span>
                        </a>
                    </li>
                    <li class="mx-3 my-4">
                        <a
                            href="/<?php echo $appPrefix; ?>/inicio"
                            class="d-block text-center text-pContrast"
                        >
                            <figure class="my-0">
                                <i class="fas fa-home fa-lg"></i>
                            </figure>
                            <span style="font-size: 0.8em;">
                                Início
                            </span>
                        </a>
                    </li>
                    <li v-for="item in nav" class="mx-3 my-4">
                        <a
                            :href="'/<?php echo $appPrefix; ?>/' + item.url"
                            class="d-block text-center text-pContrast"
                        >
                            <figure class="my-0">
                                <i :class="item.icon + ' fa-lg'"></i>
                            </figure>
                            <span style="font-size: 0.8em;">
                                {{ item.label }}
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <aside class="bg-primary position-fixed fixed-bottom d-block d-sm-none">
        <nav class="">
            <ul class="list-unstyled d-flex m-3">
                <li class="mr-auto">
                    <a
                        href="/"
                        class="d-block text-center text-pContrast"
                    >
                        <figure class="my-0">
                            <i class="fas fa-arrow-circle-left fa-lg"></i>
                        </figure>
                        <span style="font-size: 0.8em;">
                            The Devs
                        </span>
                    </a>
                </li>
                <li class="mx-3">
                    <a
                        href="/<?php echo $appPrefix; ?>/inicio"
                        class="d-block text-center text-pContrast"
                    >
                        <figure class="my-0">
                            <i class="fas fa-home fa-lg"></i>
                        </figure>
                        <span style="font-size: 0.8em;">
                            Início
                        </span>
                    </a>
                </li>
                <li class="mx-3">
                    <a
                        href="/<?php echo $appPrefix; ?>/inicio"
                        class="d-block text-center text-pContrast"
                    >
                        <figure class="my-0">
                            <i class="fas fa-ellipsis-h fa-lg"></i>
                        </figure>
                        <span style="font-size: 0.8em;">
                            Menu
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <?php
}

function call_footer() {
    ?>
    <footer class="p-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item">
                            <a href="/">The Devs</a>
                        </li>
                        <li class="list-inline-item">&sdot;</li>
                        <li class="list-inline-item">
                            <a href="/equipe">Equipe</a>
                        </li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">Desenvolvimento de Software focado na sua experiência.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mr-3">
                            <a href="https://facebook.com/thefulldevs" target="_blank">
                                <i class="fab fa-facebook fa-2x fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mr-3">
                            <a href="https://www.linkedin.com/company/the-devs-software-development" target="_blank">
                                <i class="fab fa-linkedin fa-2x fa-fw"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/The-Devs" target="_blank">
                                <i class="fab fa-github fa-2x fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <?php
}

function call_analytics() {
?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72747311-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-72747311-3');
    </script>
<?php
}

function call_default() {
?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="<?php echo STYLES_PATH; ?>bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/e1df53984c.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
<?php
}

function call_head( string $appPrefix ) {
    ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72747311-3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-72747311-3');
        </script>

        <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet" />

        <link href="<?php echo STYLES_PATH . $appPrefix; ?>/main.css" rel="stylesheet" />

        <!-- DEV / PROD -->
        <script src="<?php echo SCRIPTS_PATH . $appPrefix; ?>/vue.dev.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->


        <script src="https://kit.fontawesome.com/e1df53984c.js"></script>

        <style>
            h1,
            h2 {
                font-family: "Roboto", sans-serif;
            }
            .fade-enter-active, .fade-leave-active {
                transition: opacity .75s;
            }
            .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
                opacity: 0;
            }
        </style>
    <?php
}