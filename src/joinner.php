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
			"url" => "/{tableName}",
			"function" => $rt[ "crudRows" ],
		],
		[
			"methods" => [ "GET" ],
			"url" => "/{tableName}/{id}",
			"function" => $rt[ "crudRows" ],
		],
	]
];

