<?php

use TDClass\DatabaseConnection;
use TDClass\ErrorHandler;
use TDClass\ResponseTemplate;

$container = $app->getContainer();                  

$container[ "errorHandler" ] = function ( $c ) {
    return new ErrorHandler();
};

$container[ "logger" ] = function ( $c ) {
    $settings = $c->get( "settings" )[ "logger" ];
    $logger = new Monolog\Logger( $settings[ "name" ] );
    $logger->pushProcessor( new Monolog\Processor\UidProcessor() );
    $logger->pushHandler( new Monolog\Handler\StreamHandler( $settings[ "path" ], $settings[ "level" ] ) );
    return $logger;
};

$container[ "resTemp" ] = function ( $c ) {
    return new ResponseTemplate();
};
$container[ "database" ] = function ( $c ) {
    $dbInfo = $c->get( 'settings' )[ "database" ];
    return new DatabaseConnection( $dbInfo );
};
