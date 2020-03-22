<?php

$mw[ "track" ] = function ( $request, $response, $next ) {
    return $next( $request, $response );
};
$mw[ "checkApiKey" ] = function ( $request, $response, $next ) {
    // echo "api?";
    return $next( $request, $response );
};
$mw[ "checkSessionLogin" ] = function ( $request, $response, $next ) {
    if ( end( explode( "/", $request->getUri()->getPath() ) ) !== "inicio" ) {
        if ( empty( $this->session->whoIsThere() ) ) {
            return $response->withRedirect( "/admin-app/inicio" );
        }

    }
    return $next( $request, $response );
};

$mw[ "hash" ] = function ( $request, $response, $next ) {
    // $body = $request->getParsedBody();
    // $pass = $this->password;
    // $pwd = ( empty( $body ) ) ? $pass->create(): $body[ "password" ];
    // mailer
    // $pass->set( $pwd );
    // $request = $request->withParsedBody( [ "password" => $pass->hash() ] );
    return $next( $request, $response );
};