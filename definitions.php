<?php

require "functions.php";
// 
// UTILITIES
// 
define( "DS", DIRECTORY_SEPARATOR );
// 
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

define( "PRE_EXISTENT_PARAMS", [ "fields", "qType", "perPage", "page" ] );
define( "DEFAULT_PAGINATION", 10 );
define( "DEFAULT_PAGE", 1 );
define( "DEFAULT_QUERY_PARAMS", [
	"perPage" => DEFAULT_PAGINATION,
	"page" => DEFAULT_PAGE,
] );
