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
            <div id="nav"></div>
            
            <!-- Main scrollable max-height:full Height -->
            <div id="main"></div>
        </div>

        <?php var_dump( $current ); ?>


        <script>
            const requestUrl = "/admin-app/crud/<?php echo $current[ "request" ][ "param" ]; ?>";
            new Vue( {
                el: "#nav",
                data: {
                    nav: <?php echo json_encode( $nav ); ?>,
                },
                template: `<?php require_once( TEMPLATES_URI . "aside.html" ); ?>`
            } );
            new Vue( {
                el: "#main",
                data: {
                    loading: true,
                    message: "",
                    data: [],
                    formFields: <?php echo json_encode( $current[ "form" ] ); ?>,
                    body: <?php
                        foreach ( $current[ "form" ] as $props ) {
                            $body[ $props[ "name" ] ] = "";
                        }
                        echo json_encode( $body );
                    ?>,
                },
                methods: {
                    fetchData: function ( url ) {
                        axios.get( url )
                        .then( res => {
                            const r = res.data;
                            const rData = res.data.data[ 0 ];
                            let data = [];
                            for ( let key in rData ) {
                                data.push( { key: key, value: rData[ key ] } );
                            }
                            this.data = data;
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.loading = false;
                        } );
                    },
                    updateData: function ( url, data ) {
                        axios.post( url, data )
                        .then( res => {
                            const r = res.data;
                            this.messageHandler( r.message );
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.fetchData( url );
                        } );
                    },
                    messageHandler: function ( message ) {
                        this.message = message;
                        let self = this;
                        setTimeout( () => {
                            self.message = "";
                        }, 3000 );
                    }
                },
                mounted: function () {
                    this.fetchData( requestUrl + "/<?php echo $current[ "id" ];?>" );
                },
                template: `<?php require_once( TEMPLATES_URI . "main.update.html" ); ?>`
            } );
        </script>
    </body>
</html>
