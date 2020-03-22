<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <?php call_head( "admin-app" ); ?>
    </head>

    <body>

        <div id="app">
            <!-- <aside-nav nav='<?php // echo $nav; ?>'></aside-nav> -->
            <main>
                        <!-- v-on:display-message="messageHandler( $event )" -->
                <transition name="fade">
                    <div
                        v-if="message"
                        class="bg-primary text-p-contrast fixed-top container mr-0 p-4 opacity text-center"
                    >
                        {{ message }}
                    </div>
                </transition>
                <!-- <header-title title="<?php echo $current[ "title" ]; ?>"></header-title> -->
                <div class="my-5">
                    <!-- <form-create url="/admin-app/crud/<?php echo $current[ "requestParam" ]; ?>"></form-create> -->
                </div>
            </main>
        </div>
        <script>

            // Vue.component( 'aside-nav', {
            //     props: {
            //         nav: Object,
            //     },
            //     template: `<?php require( TEMPLATES_URI . "aside.html" ); ?>`
            // } )
            // Vue.component( 'header-title', {
            //     props: {
            //         title: String
            //     },
            //     template: `<?php require( TEMPLATES_URI . "header-title.html" ); ?>`
            // } )
            // Vue.component( 'form-create', {
            //     props: {
            //         url: String,
            //     },
            //     data: function () {
            //         return {
            //             formFields: <?php echo json_encode( $current[ "fields" ] ); ?>,
            //             body: <?php echo $current[ "body" ]; ?>,
            //             loading: false,
            //         },
            //     },
            //     methods: {
            //         sendForm: function ( ev ) {
            //             ev.preventDefault();
            //             this.loading = true;
            //             axios.post( this.url, this.body )
            //             .then( res => {
            //                 const r = res.data;
            //                 // to parent handler 
            //                 $emit( 'display-message', r.message );
            //                 // this.messageHandler( r.message );
            //                 // 
            //                 if ( r.error === 0 ) {
            //                     this.resetForm();
            //                 }
            //             } )
            //             .catch( err => {
            //                 console.warn( err );
            //             } )
            //             .finally( () => {
            //                 this.loading = false;
            //             })

            //         },
            //         resetForm: function ( ev = null ) {
            //             if ( ev ) {
            //                 ev.preventDefault();
            //             }
            //             for ( let key in this.body ) {
            //                 this.body[ key ] = null;
            //             }
            //             document.querySelector( "form" ).reset();
            //         }
            //     },
            //     template: `<?php require( TEMPLATES_URI . "form-create.html" ); ?>`
            // } )
            new Vue( {
                el: '#app',
                data: {
                    message: ""
                },
                methods: {
                    messageHandler: function ( message ) {
                        this.message = message;
                        let self = this;
                        setTimeout( () => {
                            self.message = "";
                        }, 3000 );
                    }
                },
            } )
        </script>
    </body>
</html>
