<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <?php call_head( "admin-app" ); ?>
    </head>

    <body>

        <div
            class="d-flex"
            id="app"
        >
            <!-- Sidebar full Height -->
            <?php // call_sidebar( "admin-app" ); ?>
            <aside id="aside-nav"></aside>
            
            <!-- Main scrollable max-height:full Height -->
            <main id="main-container"></main>
        </div>
        <?php
                            foreach ( $current[ "form" ] as $props ) {
                                $body[ $props[ "name" ] ] = "";
                            }
                            echo json_encode( $body );
                            var_dump( $body, json_encode( $body ) );
                        ?>

        <script>
            new Vue.component( 'aside-nav', {
                el: '#aside-nav',
                template: `<?php require_once( TEMPLATES_URI . "aside.html" ); ?>`,
                data: function () {
                    return {
                        nav:<?php echo json_encode( $current[ "nav" ] ); ?>
                    }
                },
            } );
            new Vue.component( 'main-container', {
                el: '#main-container',
                data: function () {
                    return {
                        formFields: <?php echo json_encode( $current[ "form" ] ); ?>,
                        body: <?php
                            foreach ( $current[ "form" ] as $props ) {
                                $body[ $props[ "name" ] ] = "";
                            }
                            echo json_encode( $body );
                        ?>,
                        loading: false,
                        message: ""
                    },
                },
                methods: {
                    sendForm: function ( ev ) {
                        ev.preventDefault();
                        this.loading = true;
                        axios.post( "/admin-app/crud/<?php echo $current[ "request" ][ "param" ]; ?>", this.body )
                        .then( res => {
                            const r = res.data;
                            this.messageHandler( r.message );
                            if ( r.error === 0 ) {
                                this.resetForm();
                            }
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.loading = false;
                        })

                    },
                    resetForm: function ( ev = null ) {
                        if ( ev ) {
                            ev.preventDefault();
                        }
                        for ( let key in this.body ) {
                            this.body[ key ] = null;
                        }
                        document.querySelector( "form" ).reset();
                    },
                    messageHandler: function ( message ) {
                        this.message = message;
                        let self = this;
                        setTimeout( () => {
                            self.message = "";
                        }, 3000 );
                    }
                },
                template: `<?php require_once( TEMPLATES_URI . "main.create.html" ); ?>`
            } );
            new Vue( {
                el: "#app"
            } );
        </script>
    </body>
</html>
