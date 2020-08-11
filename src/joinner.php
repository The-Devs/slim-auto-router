<?php
$router = [
	"api" => [
		[
			"methods" => [ "GET" ],
			"url" => "/",
			"function" => $rt[ "crudRoot" ],
		],
		[
			"methods" => [ "GET" ],
			"url" => "/install",
			"function" => $rt[ "crudInstall" ],
		],
		[
			"methods" => [ "GET" ],
			"url" => "/questions",
			"function" => $rt[ "questionsRoute" ],
		],
		[
			"methods" => [ "GET", "POST" ],
			"url" => "/{tableName}",
			"function" => $rt[ "crudRows" ],
		],
		[
			"methods" => [ "GET", "POST" ],
			"url" => "/{tableName}/{id}",
			"function" => $rt[ "crudRowId" ],
		],
	],
	[
		"methods" => [ "GET" ],
		"url" => "/",
		"function" => $rt[ "home" ]
	]
];

