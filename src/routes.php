<?php
header( "Access-Control-Allow-Origin: *" );
header( "Access-Control-Allow-Headers: Content-Type" );
header( "Access-Control-Allow-Methods: GET, POST, PUT, DELETE" );


use Slim\Http\Request;
use Slim\Http\Response;
use SebastianBergmann\GlobalState\Exception;


/**
 * all html root routes
 */
$rt[ "home" ] = function ( Request $request, Response $response, array $args ) {
    $file = "index.php";
    return $this->view->render(
        $response,
        $file,
        []
    );
};

// receives a {username} param
$rt[ "curriculum-vitae" ] = function ( Request $request, Response $response, array $args ) {
    $user = $request->getAttribute( "username" );
    $file = file_exists( IMAGES_URI . $user . ".jpg" ) ? "curriculum-vitae.php" : "404.php";
    return $this->view->render(
        $response,
        $file,
        [ "user" => $user ]
    );
};
