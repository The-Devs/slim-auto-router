<?php
$view = [ "template_path" => TEMPLATES_URI ];
$logger = [
    "name" => "mancab",
    "path" => isset($_ENV["docker"]) ? "php://stdout" : __DIR__ . "/../logs/app.log",
    "level" => \Monolog\Logger::DEBUG,
];
$database = [
	"host" => "localhost",
	"name" => "mancab",
	"charset" => "utf8",
	"user" => "mancab",
	"password" => "pSikSL(TxBe8T]yd",
	"prefix" => "mcb_",
	"tables" => [
		"products" => [
			"prefix" => "product_",
			"primary" => "id",
			"unique" => [ "name" ],
			// "default" => [ "date" => 0 ],
			"fields" => [
				"id" => "int(11)",
				"date" => "date",
				"content" => "text",
				"title" => "varchar(80)",
				"name" => "varchar(100)",
				"excerpt" => "varchar(100)",
				"img" => "varchar(100)",
				"tagIds" => "varchar(100)",
			],
		],
		"tags" => [
			"prefix" => "tag_",
			"primary" => "id",
			"unique" => [ "name" ],
			"fields" => [
				"id" => "int(11)",
				"name" => "varchar(100)",
			],
		],
		"reviews" => [
			"prefix" => "review_",
			"primary" => "id",
			"unique" => [ "name" ],
			// "default" => [ "date" => 0 ],
			"fields" => [
				"id" => "int(11)",
				"date" => "date",
				"productId" => "int(11)",
				"content" => "text",
				"title" => "varchar(80)",
				"name" => "varchar(100)",
			],
		],
	]
];

return [
    "settings" => [
        "displayErrorDetails" => true,
        "addContentLengthHeader" => true,
        "view" => $view,
        "logger" => $logger,
        "database" => $database,
    ]
];
