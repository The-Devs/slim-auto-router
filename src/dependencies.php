<?php

use TDClass\DatabaseConnection;
use TDClass\ErrorHandler;
use TDClass\ResponseTemplate;
use TDClass\PhpFormBuilder;
use TDClass\SessionHandler;
use TDClass\Password;
use GuzzleHttp\Client;
use PHPMailer\PHPMailer\PHPMailer;

$container = $app->getContainer();                  

$container[ "errorHandler" ] = function ( $c ) {
    return new ErrorHandler();
};

$container[ "project" ] = function ( $c ) {
    $settings = $c->get( "settings" );
    return [
        "domain" => $settings[ "domain" ],
        "name" => $settings[ "name" ]
    ];
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

$container[ "tddb" ] = function ( $c ) {
    $dbInfo = $c->get( 'settings' )[ "tddb" ];
    return new DatabaseConnection( $dbInfo );
};

$container[ "http" ] = function ( $c ) {
    return new GuzzleHttp\Client();
};

$container[ "database" ] = function ( $c ) {
    $dbInfo = $c->get( 'settings' )[ "database" ];
    return new DatabaseConnection( $dbInfo );
};

$container[ "mailer" ] = function ( $c ) {
    $s = $c->get( "settings" )[ "mail" ];
    $mail = new PHPMailer( true );
    $mail->CharSet = $s[ "charset" ];
    $mail->isSMTP();
    $mail->Host = $s[ "host" ];
    $mail->SMTPAuth = true;
    $mail->Username = $s[ "username" ];
    $mail->Password = $s[ "password" ];
    $mail->SMTPSecure = $s[ "secure" ];
    $mail->Port = $s[ "port" ];  
    $mail->setFrom( $s[ "from" ], $s[ "fromName" ] );
    $mail->addReplyTo( $s[ "reply" ], $s[ "replyName" ] );
    $mail->isHTML( true );
    
    return $mail;
};

$container[ "view" ] = function ( $c ) {
    $settings = $c->get( "settings" )[ "view" ];
    return new Slim\Views\PhpRenderer( $settings[ "template_path" ] );
};

$container[ "html" ] = function ( $c ) {
    foreach( $c->get( 'settings' )[ "database" ][ "tables" ] as $tableName => $tableData ) {

        if ( isset( $tableData[ "view" ] ) ) {
            foreach ( $tableData[ "view" ] as $type => $viewData ) {
                $toView = $viewData;
                $toView[ "requestParam" ] = $tableName;
                if ( ! empty( $viewData[ "url" ] ) ) {
                    $view[ "nav" ][] = $viewData;
                    $view[ "urlPage" ][ $viewData[ "url" ] ] = $toView;
                } else {
                    $view[ "noUrlPage" ][] = $toView;
                }
            }
        }

    }
    return $view;
};

$container[ "form" ] = function ( $c ) {
    return new PhpFormBuilder();
};

$container[ "session" ] = function ( $c ) {
    return new SessionHandler();
};
$container[ "password" ] = function ( $c ) {
    return new Password();
};