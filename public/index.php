<?php

header( "Access-Control-Allow-Origin: *" );
header("Access-Control-Allow-Headers: Content-Type" );
header( "Access-Control-Allow-Methods: GET, POST, PUT, DELETE" );



// Setting all relatives path and absolute uri
require_once "../definitions.php";

// Set website domain here
require VENDOR_URI . "autoload.php";
session_start();

// Instantiate the app
$settings = require SOURCE_URI . "settings.php";
$app = new \Slim\App( $settings );

// Set up dependencies
require SOURCE_URI . "dependencies.php";

// Register middleware
require SOURCE_URI . "middleware.php";

// Register routes
require SOURCE_URI . "routes.php";

// Join registered middlewares to groups and routes
require SOURCE_URI . "joinner.php";

// Apply joint stuff to Slimframework
foreach ( $router as $groupName => $routes ) {
    if ( gettype( $groupName ) === "string" && $subGroupName !== "middleware" ) {
        $slimGroup = $app->group( "/$groupName", function () use ( $app, $routes ) {
            foreach ( $routes as $subGroupName => $route ) {
                if ( gettype( $subGroupName ) === "string" && $subGroupName !== "middleware" ) {
                    $slimSubGroup = $app->group( "/$subGroupName", function () use ( $app, $route ) {
                        foreach ( $route as $subSubGroupName => $subGroupRoutes ) {
                            // make recursive verification $subSubGroupName and so on using class
                            if ( gettype( $subSubGroupName ) === "string" && $subSubGroupName !== "middleware" ) {
                                $slimSubSubGroup = $app->group( "/$subGroupName", function () use ( $app, $route ) {
                                    foreach ( $route as $subSubGroupName => $subGroupRoutes ) {

                                    }
                                } );
                                if ( array_key_exists( "middleware", $subGroupRoutes ) ) {
                                    $slimSubSubGroup->add( $subGroupRoutes[ "middleware" ] );
                                }
                            } else {
                                if ( gettype( $subSubGroupName ) === "integer" ) {
                                    $slimSubSubRoute = $app->map( $subGroupRoutes[ "methods" ], $subGroupRoutes[ "url" ], $subGroupRoutes[ "function" ] );
                                    if ( array_key_exists( "middleware", $subGroupRoutes ) ) {
                                        $slimSubSubRoute->add( $subGroupRoutes[ "middleware" ] );
                                    }
                                    if ( array_key_exists( "middleware", $subGroupRoutes ) ) {
                                        $slimSubGroup->add( $subGroupRoutes[ "middleware" ] );
                                    }
                                }
                            }

                        }
                    } );
                    if ( array_key_exists( "middleware", $route ) ) {
                        $slimSubGroup->add( $route[ "middleware" ] );
                    }
                    
                } else {
                    if ( gettype( $subGroupName ) === "integer" ) {
                        $slimSubRoute = $app->map( $route[ "methods" ], $route[ "url" ], $route[ "function" ] );
                        if ( array_key_exists( "middleware", $route ) ) {
                            $slimSubRoute->add( $route[ "middleware" ] );
                        }
                    }
                }
            }
        } );
        if ( array_key_exists( "middleware", $routes ) ) {
            $slimGroup->add( $routes[ "middleware" ] );
        }
    } else {
        $slimRoute = $app->map( $routes[ "methods" ], $routes[ "url" ], $routes[ "function" ] );
        if ( array_key_exists( "middleware", $routes ) ) {
            $slimRoute->add( $routes[ "middleware" ] );
        }
    }
}

// Run app
$app->run();
