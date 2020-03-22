<?php

require "functions.php";
// 
// UTILITIES
// 
//  ENVIRONMENT: 'DEV', 'TEST' or 'PROD'
define( "DS", DIRECTORY_SEPARATOR );
// 
// BASIC SETTINGS
// 
//  _URI constant points to absolute path on server
//  _PATH constant points to path to be appended on url browser's client
// 
define( "ENVIRONMENT", "DEV" );

$protocol = ( empty( $_SERVER[ "HTTPS" ] ) ) ? "http" : "https";
$srvName = $_SERVER[ "SERVER_NAME" ];
$port = "8000";
define( "BASENAME", "$protocol://$srvName:$port" );

define( "ROOT_PATH", DS );
define( "ROOT_URI", __DIR__ . DS );

// Private
define( "VENDOR_URI", ROOT_URI . "vendor" . DS );
define( "SOURCE_URI", ROOT_URI . "src" . DS );

// Public
define( "PUBLIC_PATH", ROOT_PATH );
define( "PUBLIC_URI", ROOT_URI . "public" . DS  );

define( "TEMPLATES_PATH", ROOT_PATH . "templates" . DS );
define( "TEMPLATES_URI", ROOT_URI . "templates" . DS );

define( "ASSETS_PATH", ROOT_PATH . "assets" . DS );
define( "ASSETS_URI", ROOT_URI . "assets" . DS );

define( "SASS_PATH", ASSETS_PATH . "sass" . DS );
define( "SASS_URI", ASSETS_URI . "sass" . DS );
// 
// ASSETS
// 
//  _URI constant points to absolute path on server
//  _PATH constant points to path to be appended on url browser's client
//

define( "IMAGES_PATH", PUBLIC_PATH . "images" . DS );
define( "IMAGES_URI", PUBLIC_URI . "images" . DS );

define( "USERS_PATH", PUBLIC_PATH . "users" . DS);
define( "USERS_URI", PUBLIC_URI . "users" . DS);

define( "STYLES_PATH", PUBLIC_PATH . "styles" . DS );
define( "STYLES_URI", PUBLIC_URI . "styles" . DS );

define( "SCRIPTS_PATH", PUBLIC_PATH . "js" . DS );
define( "SCRIPTS_URI", PUBLIC_URI . "js" . DS );

