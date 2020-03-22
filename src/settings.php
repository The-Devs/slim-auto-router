<?php

$name = "Project Name";

$view = [
    "template_path" => TEMPLATES_URI,
];
$logger = [
    "name" => "orcaagora-system",
    "path" => isset($_ENV["docker"]) ? "php://stdout" : __DIR__ . "/../logs/app.log",
    "level" => \Monolog\Logger::DEBUG,
];
$domain = [
    "PROD" => "domain",
    "TEST" => "test.domain",
    "DEV" => "dev.domain"
];

$mail = [
    "PROD" => [
        "to" => "contato@orcaagora.com.br",
        "from" => "orcaagora@orcaagora.com.br",
        "fromName" => "orcaagora",
        "reply" => "no-reply@orcaagora.com.br",
        "replyName" => "NoReply",
        "charset" => "UTF-8",
        "secure" => "tls",
        "port" => 587,
        "host" => "smtp.mailgun.org",
        "limitTime" => "7",
        "username" => "postmaster@dev.orcaagora.com.br",
        "password" => "3ccb22b81868fa1826284aca15beed69-af6c0cec-a7751d37"
    ],
    "TEST" => [
        "to" => "contato@orcaagora.com.br",
        "from" => "orcaagora@orcaagora.com.br",
        "fromName" => "orcaagora",
        "reply" => "no-reply@orcaagora.com.br",
        "replyName" => "NoReply",
        "charset" => "UTF-8",
        "secure" => "tls",
        "port" => 587,
        "host" => "smtp.mailgun.org",
        "limitTime" => "7",
        "username" => "postmaster@dev.orcaagora.com.br",
        "password" => "3ccb22b81868fa1826284aca15beed69-af6c0cec-a7751d37"
    ],
    "DEV" => [
        "to" => "contato@orcaagora.com.br",
        "from" => "orcaagora@orcaagora.com.br",
        "fromName" => "orcaagora",
        "reply" => "no-reply@orcaagora.com.br",
        "replyName" => "NoReply",
        "charset" => "UTF-8",
        "secure" => "tls",
        "port" => 587,
        "host" => "smtp.mailgun.org",
        "limitTime" => "7",
        "username" => "postmaster@dev.orcaagora.com.br",
        "password" => "3ccb22b81868fa1826284aca15beed69-af6c0cec-a7751d37"
    ]
];

$tddb = [
    "PROD" => [
        "host" => "localhost",
        "name" => "dbOrcaAgora",
        "charset" => "utf8",
        "user" => "orcaagora",
        "password" => "chama no xesque",
        "prefix" => "oag_",
        "tables" => []
    ],
    "TEST" => [
        "host" => "localhost",
        "name" => "thedevs",
        "charset" => "utf8",
        "user" => "orcaagora",
        "password" => "um2tres45",
        "prefix" => "td_",
        "tables" => []
    ],
    "DEV" => [
        "host" => "localhost",
        "name" => "thedevs",
        "charset" => "utf8",
        "user" => "enriquerene",
        "password" => "um2tres45",
        "prefix" => "td_",
        "tables" => [
            "accounts" => [
                "prefix" => "account_",
                "primary" => "id",
                "unique" => [ "username" ],
                "null" => [ "serviceIds", "productIds", "lastLogin" ],
                "default" => [ "isActive" => 1, "creationData" => "CURRENT_TIMESTAMP" ],
                "fields" => [
                    "id" => "int(11)",
                    "username" => "varchar(50)",
                    "password" => "varchar(255)",
                    "productIds" => "varchar(200)", // route root; crud allow access to /crud/*; mailer allow access to /mailer/*. The root route of module is the "creation key" (crud/ or mailer/) endpoint. 
                    "serviceIds" => "varchar(200)",
                    "customerId" => "int(11)",
                    "isActive" => "tinyint(1)",
                    "newletters" => "tinyint(1)",
                    "creationDate" => "timestamp",
                    "lastLogin" => "timestamp",
                ]
            ],
            "customers" => [
                "prefix" => "customer_",
                "primary" => "id",
                "unique" => [ "fullName", "email", "mobileNumber" ],
                "fields" => [
                    "id" => "int(11)",
                    "fullName" => "varchar(100)",
                    "email" => "varchar(100)",
                    "mobileNumber" => "varchar(16)",
                    "birthday" => "date",
                    "addressCode" => "varchar(50)",
                    "address" => "varchar(200)",
                ],
                "view" => [
                    "clientes" => [
                        "requestMethod" => "GET",
                        "title" => "Registro de Clientes",
                        "icon" => "fas fa-users",
                        "label" => "Clientes",
                        "fields" => [
                            "fullName" => "Nome",
                            "email" => "Email",
                            "mobileNumber" => "Telefone"
                        ]
                    ],
                    "novo-cliente" => [
                        "requestMethod" => "POST",
                        "title" => "Registrar Novo Cliente",
                        "icon" => "fas fa-user-plus",
                        "label" => "Novo Cliente",
                        "fields" => [
                            [
                                "name" => "fullName",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome completo",
                                "required" => true,
                            ],
                            [
                                "name" => "email",
                                "type" => "email",
                                "max" => "100",
                                "label" => "email",
                                "required" => true,
                            ],
                            [
                                "name" => "mobileNumber",
                                "type" => "text",
                                "max" => "16",
                                "label" => "Celular",
                                "required" => true,
                            ],
                            [
                                "name" => "birthday",
                                "type" => "date",
                                "label" => "Nascimento",
                                "required" => true,
                            ],
                            [
                                "name" => "addressCode",
                                "type" => "text",
                                "max" => "50",
                                "label" => "CEP",
                                "required" => true,
                            ],
                            [
                                "name" => "address",
                                "type" => "text",
                                "max" => "200",
                                "label" => "Endereço",
                                "required" => true,
                            ],
                        ]
                    ]
                ]
            ],
            "staff" => [
                "prefix" => "staff_",
                "primary" => "id",
                "fields" => [
                    "id" => "int(11)",
                    "fullName" => "varchar(100)",
                    "email" => "varchar(100)",
                    "mobileNumber" => "varchar(16)",
                    "birthday" => "date",
                    "document" => "varchar(30)",
                    "addressCode" => "varchar(50)",
                    "address" => "varchar(200)",
                ],
                "view" => [
                    "equipe" => [
                        "requestMethod" => "GET",
                        "title" => "Registros de Funcionária/os",
                        "icon" => "fas fa-users",
                        "label" => "Funcionárias/os",
                        "fields" => [
                            "fullName" => "Nome",
                            "email" => "Email",
                            "mobileNumber" => "Telefone"
                        ]
                    ],
                    "registrar-na-equipe" => [
                        "requestMethod" => "POST",
                        "title" => "Registrar Funcionária/o",
                        "icon" => "fas fa-user-plus",
                        "label" => "Registrar Funcionária/o",
                        "fields" => [
                            [
                                "name" => "fullName",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome completo",
                                "required" => true,
                            ],
                            [
                                "name" => "email",
                                "type" => "email",
                                "max" => "100",
                                "label" => "email",
                                "required" => true,
                            ],
                            [
                                "name" => "mobileNumber",
                                "type" => "text",
                                "max" => "16",
                                "label" => "Celular",
                                "required" => true,
                            ],
                            [
                                "name" => "document",
                                "type" => "text",
                                "label" => "Documento",
                                "required" => true,
                            ],
                            [
                                "name" => "birthday",
                                "type" => "date",
                                "label" => "Nascimento",
                                "required" => true,
                            ],
                            [
                                "name" => "addressCode",
                                "type" => "text",
                                "max" => "50",
                                "label" => "CEP",
                                "required" => true,
                            ],
                            [
                                "name" => "address",
                                "type" => "text",
                                "max" => "200",
                                "label" => "Endereço",
                                "required" => true,
                            ],
                        ]
                    ]
                ]
            ],
            "products" => [
                "prefix" => "product_",
                "primary" => "id",
                "unique" => [ "name" ],
                "default" => [ "stock" => 0 ],
                "null" => [ "salesPrice", "lastPrice", "description", "mainImage", "images" ],
                "fields" => [
                    "id" => "int(11)",
                    "name" => "varchar(100)",
                    "price" => "varchar(10)",
                    "lastPrice" => "varchar(100)",
                    "salesPrice" => "varchar(10)",
                    "stock" => "int(11)",
                    "description" => "text",
                    "mainImage" => "varchar(100)",
                    "images" => "varchar(500)",
                ],
                "view" => [
                    "produtos" => [
                        "requestMethod" => "GET",
                        "title" => "Registros de Produto",
                        "icon" => "fas fa-boxes",
                        "label" => "Produtos",
                        "fields" => [
                            "name" => "Nome",
                            "price" => "Preço",
                            "salesPrice" => "Promoção",
                        ]
                    ],
                    "registrar-produto" => [
                        "requestMethod" => "POST",
                        "title" => "Registrar Novo Produto",
                        "icon" => "fas fa-box",
                        "label" => "Novo Produto",
                        "fields" => [
                            [
                                "name" => "name",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome do Produto",
                                "required" => true,
                            ],
                            [
                                "name" => "price",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "stock",
                                "type" => "number",
                                "min" => "0",
                                "label" => "Estoque",
                                "required" => true,
                            ],
                            [
                                "name" => "description",
                                "type" => "text",
                                "min" => "0",
                                "label" => "Descrição",
                                "required" => false,
                            ],
                        ]
                    ]
                ]
            ],
            "services" => [
                "prefix" => "service_",
                "primary" => "id",
                "unique" => [ "name" ],
                "null" => [ "salesPrice", "lastPrice", "description", "mainImage", "images", "meanTime" ],
                "fields" => [
                    "id" => "int(11)",
                    "name" => "varchar(100)",
                    "price" => "varchar(10)",
                    "lastPrice" => "varchar(100)",
                    "salesPrice" => "varchar(10)",
                    "meanTime" => "int(11)",
                    "description" => "text",
                    "mainImage" => "varchar(100)",
                    "images" => "varchar(500)",
                ],
                "view" => [
                    "servicos" => [
                        "requestMethod" => "GET",
                        "title" => "Registros de Serviço",
                        "icon" => "fas fa-cogs",
                        "label" => "Serviços",
                        "fields" => [
                            "name" => "Nome",
                            "price" => "Preço",
                            "meanTime" => "Temp médio",
                        ]
                    ],
                    "registrar-servico" => [
                        "requestMethod" => "POST",
                        "title" => "Registrar Novo Serviço",
                        "icon" => "fas fa-cog",
                        "label" => "Novo Serviço",
                        "fields" => [
                            [
                                "name" => "name",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome do Serviço",
                                "required" => true,
                            ],
                            [
                                "name" => "price",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "meanTime",
                                "type" => "number",
                                "min" => "0",
                                "label" => "Tempo médio (minutos)",
                                "required" => false,
                            ],
                            [
                                "name" => "description",
                                "type" => "text",
                                "min" => "0",
                                "label" => "Descrição",
                                "required" => false,
                            ],
                        ]
                    ]
                ]
            ],
            "keys" => [
                "prefix" => "key_",
                "primary" => "id",
                "unique" => [ "name", "secret", "public" ],
                "null" => [ "revokeDate", "prefix" ],
                "fields" => [
                    "id" => "int(11)",
                    "name" => "varchar(50)",
                    "prefix" => "varchar(10)",
                    "module" => "varchar(50)", // route root; crud allow access to /crud/*; mailer allow access to /mailer/*. The root route of module is the "creation key" (crud/ or mailer/) endpoint. 
                    "scope" => "varchar(4)",
                    "secret" => "varchar(64)",
                    "public" => "varchar(64)",
                    "creationDate" => "date",
                    "expirationDate" => "date",
                    "revokeDate" => "date",
                ],
            ]
        ]
    ]
];


$database = [
    "PROD" => [
        "host" => "localhost",
        "name" => "dbOrcaAgora",
        "charset" => "utf8",
        "user" => "orcaagora",
        "password" => "chama no xesque",
        "prefix" => "oag_",
        "tables" => [
            "table1" => [
                "prefix" => "t1_",
                "fields" => [
                    "field1" => [
                        "varchar(30)",
                        "unique key"
                    ],
                    "field2" => [
                        "varchar(50)",
                    ]
                ]
            ],
            "table2" => [
                "prefix" => "t2_",
                "fields" => [
                    "field1" => [
                        "varchar(30)",
                        "unique key"
                    ],
                    "field2" => [
                        "varchar(50)",
                    ]
                ]
            ],
            "table3" => [
                "prefix" => "t3_",
                "fields" => [
                    "field1" => [
                        "varchar(30)",
                        "unique key"
                    ],
                    "field2" => [
                        "text",
                    ]
                ]
                ]
        ]
    ],
    "TEST" => [
        "host" => "localhost",
        "name" => "intest",
        "charset" => "utf8",
        "user" => "orcaagora",
        "password" => "chama no xesque",
        "prefix" => "oag_",
        "tables" => [
            "table1" => [
                "prefix" => "t1_",
                "fields" => [
                    "field1" => [
                        "varchar(30)",
                        "unique key"
                    ],
                    "field2" => [
                        "varchar(50)",
                    ]
                ]
            ],
            "table2" => [
                "prefix" => "t2_",
                "fields" => [
                    "field1" => [
                        "varchar(30)",
                        "unique key"
                    ],
                    "field2" => [
                        "varchar(50)",
                    ]
                ]
            ],
            "table3" => [
                "prefix" => "t3_",
                "fields" => [
                    "field1" => [
                        "varchar(30)",
                        "unique key"
                    ],
                    "field2" => [
                        "varchar(50)",
                    ]
                ]
                ]
        ]
    ],
    "DEV" => [
        "host" => "localhost",
        "name" => "theadmin",
        "charset" => "utf8",
        "user" => "enriquerene",
        "password" => "um2tres45",
        "prefix" => "tda_",
        "tables" => [
            "customers" => [
                "prefix" => "customer_",
                "primary" => "id",
                // "default" => [ "name" => "" ],
                "unique" => [ "fullName", "email", "mobileNumber" ],
                "fields" => [
                    "id" => "int(11)",
                    "fullName" => "varchar(100)",
                    "email" => "varchar(100)",
                    "mobileNumber" => "varchar(16)",
                    "birthday" => "date",
                    "addressCode" => "varchar(50)",
                    "address" => "varchar(200)",
                ],
                "view" => [
                    "all" => [
                        "url" => "clientes",
                        "requestMethod" => "GET",
                        "title" => "Registro de Clientes",
                        "icon" => "fas fa-users",
                        "label" => "Clientes",
                        "fields" => [
                            "fullName" => "Nome",
                            "email" => "Email",
                            "mobileNumber" => "Telefone"
                        ]
                    ],
                    "new" => [
                        "url" => "novo-cliente",
                        "requestMethod" => "POST",
                        "title" => "Registrar Novo Cliente",
                        "icon" => "fas fa-user-plus",
                        "label" => "Novo Cliente",
                        "fields" => [
                            [
                                "name" => "fullName",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome completo",
                                "required" => true,
                            ],
                            [
                                "name" => "email",
                                "type" => "email",
                                "max" => "100",
                                "label" => "email",
                                "required" => true,
                            ],
                            [
                                "name" => "mobileNumber",
                                "type" => "text",
                                "max" => "16",
                                "label" => "Celular",
                                "required" => true,
                            ],
                            [
                                "name" => "birthday",
                                "type" => "date",
                                "label" => "Nascimento",
                                "required" => true,
                            ],
                            [
                                "name" => "addressCode",
                                "type" => "text",
                                "max" => "50",
                                "label" => "CEP",
                                "required" => true,
                            ],
                            [
                                "name" => "address",
                                "type" => "text",
                                "max" => "200",
                                "label" => "Endereço",
                                "required" => true,
                            ],
                        ]
                    ],
                    "one" => [
                        "url" => null,
                        "requestMethod" => "PUT",
                        "title" => "Atualizar Cliente",
                        "icon" => "fas fa-user",
                        "label" => "Detalhes de Cliente",
                        "fields" => [
                            [
                                "name" => "fullName",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome completo",
                                "required" => true,
                            ],
                            [
                                "name" => "email",
                                "type" => "email",
                                "max" => "100",
                                "label" => "email",
                                "required" => true,
                            ],
                            [
                                "name" => "mobileNumber",
                                "type" => "text",
                                "max" => "16",
                                "label" => "Celular",
                                "required" => true,
                            ],
                            [
                                "name" => "birthday",
                                "type" => "date",
                                "label" => "Nascimento",
                                "required" => true,
                            ],
                            [
                                "name" => "addressCode",
                                "type" => "text",
                                "max" => "50",
                                "label" => "CEP",
                                "required" => true,
                            ],
                            [
                                "name" => "address",
                                "type" => "text",
                                "max" => "200",
                                "label" => "Endereço",
                                "required" => true,
                            ],
                        ]
                    ]
                ]
            ],
            "staff" => [
                "prefix" => "staff_",
                "primary" => "id",
                "fields" => [
                    "id" => "int(11)",
                    "fullName" => "varchar(100)",
                    "email" => "varchar(100)",
                    "mobileNumber" => "varchar(16)",
                    "birthday" => "date",
                    "document" => "varchar(30)",
                    "addressCode" => "varchar(50)",
                    "address" => "varchar(200)",
                ],
                "view" => [
                    "all" => [
                        "url" => "equipe",
                        "requestMethod" => "GET",
                        "title" => "Registros de Funcionária/os",
                        "icon" => "fas fa-users",
                        "label" => "Funcionárias/os",
                        "fields" => [
                            "fullName" => "Nome",
                            "email" => "Email",
                            "mobileNumber" => "Telefone"
                        ]
                    ],
                    "new" => [
                        "url" => "registrar-na-equipe",
                        "requestMethod" => "POST",
                        "title" => "Registrar Funcionária/o",
                        "icon" => "fas fa-user-plus",
                        "label" => "Registrar Funcionária/o",
                        "fields" => [
                            [
                                "name" => "fullName",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome completo",
                                "required" => true,
                            ],
                            [
                                "name" => "email",
                                "type" => "email",
                                "max" => "100",
                                "label" => "email",
                                "required" => true,
                            ],
                            [
                                "name" => "mobileNumber",
                                "type" => "text",
                                "max" => "16",
                                "label" => "Celular",
                                "required" => true,
                            ],
                            [
                                "name" => "document",
                                "type" => "text",
                                "label" => "Documento",
                                "required" => true,
                            ],
                            [
                                "name" => "birthday",
                                "type" => "date",
                                "label" => "Nascimento",
                                "required" => true,
                            ],
                            [
                                "name" => "addressCode",
                                "type" => "text",
                                "max" => "50",
                                "label" => "CEP",
                                "required" => true,
                            ],
                            [
                                "name" => "address",
                                "type" => "text",
                                "max" => "200",
                                "label" => "Endereço",
                                "required" => true,
                            ],
                        ]
                    ],
                    "one" => [
                        "url" => null,
                        "requestMethod" => "POST",
                        "title" => "Registrar Funcionária/o",
                        "icon" => "fas fa-user-plus",
                        "label" => "Registrar Funcionária/o",
                        "fields" => [
                            [
                                "name" => "fullName",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome completo",
                                "required" => true,
                            ],
                            [
                                "name" => "email",
                                "type" => "email",
                                "max" => "100",
                                "label" => "email",
                                "required" => true,
                            ],
                            [
                                "name" => "mobileNumber",
                                "type" => "text",
                                "max" => "16",
                                "label" => "Celular",
                                "required" => true,
                            ],
                            [
                                "name" => "document",
                                "type" => "text",
                                "label" => "Documento",
                                "required" => true,
                            ],
                            [
                                "name" => "birthday",
                                "type" => "date",
                                "label" => "Nascimento",
                                "required" => true,
                            ],
                            [
                                "name" => "addressCode",
                                "type" => "text",
                                "max" => "50",
                                "label" => "CEP",
                                "required" => true,
                            ],
                            [
                                "name" => "address",
                                "type" => "text",
                                "max" => "200",
                                "label" => "Endereço",
                                "required" => true,
                            ],
                        ]
                    ]
                ]
            ],
            "products" => [
                "prefix" => "product_",
                "primary" => "id",
                "unique" => [ "name" ],
                "default" => [ "stock" => 0 ],
                "null" => [ "salesPrice", "lastPrice", "description", "mainImage", "images" ],
                "fields" => [
                    "id" => "int(11)",
                    "name" => "varchar(100)",
                    "price" => "varchar(10)",
                    "lastPrice" => "varchar(100)",
                    "salesPrice" => "varchar(10)",
                    "stock" => "int(11)",
                    "description" => "text",
                    "mainImage" => "varchar(100)",
                    "images" => "varchar(500)",
                ],
                "view" => [
                    "all" => [
                        "url" => "produtos",
                        "requestMethod" => "GET",
                        "title" => "Registros de Produto",
                        "icon" => "fas fa-boxes",
                        "label" => "Produtos",
                        "fields" => [
                            "name" => "Nome",
                            "price" => "Preço",
                            "stock" => "Estoque",
                        ]
                    ],
                    "new" => [
                        "url" => "registrar-produto",
                        "requestMethod" => "POST",
                        "title" => "Registrar Novo Produto",
                        "icon" => "fas fa-box",
                        "label" => "Novo Produto",
                        "fields" => [
                            [
                                "name" => "name",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome do Produto",
                                "required" => true,
                            ],
                            [
                                "name" => "price",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "stock",
                                "type" => "number",
                                "min" => "0",
                                "label" => "Estoque",
                                "required" => true,
                            ],
                            [
                                "name" => "description",
                                "type" => "text",
                                "min" => "0",
                                "label" => "Descrição",
                                "required" => false,
                            ],
                        ]
                    ],
                    "one" => [
                        "url" => null,
                        "requestMethod" => "PUT",
                        "title" => "Atualizar Novo Produto",
                        "icon" => "fas fa-box",
                        "label" => "Detalhes do Produto",
                        "fields" => [
                            [
                                "name" => "name",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome do Produto",
                                "required" => true,
                            ],
                            [
                                "name" => "price",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "stock",
                                "type" => "number",
                                "min" => "0",
                                "label" => "Estoque",
                                "required" => true,
                            ],
                            [
                                "name" => "description",
                                "type" => "text",
                                "min" => "0",
                                "label" => "Descrição",
                                "required" => false,
                            ],
                        ]
                    ]
                ],
            ],
            "services" => [
                "prefix" => "service_",
                "primary" => "id",
                "unique" => [ "name" ],
                "null" => [ "salesPrice", "lastPrice", "description", "mainImage", "images", "meanTime" ],
                "fields" => [
                    "id" => "int(11)",
                    "name" => "varchar(100)",
                    "price" => "varchar(10)",
                    "lastPrice" => "varchar(100)",
                    "salesPrice" => "varchar(10)",
                    "meanTime" => "int(11)",
                    "description" => "text",
                    "mainImage" => "varchar(100)",
                    "images" => "varchar(500)",
                ],
                "view" => [
                    "all" => [
                        "url" => "servicos",
                        "requestMethod" => "GET",
                        "title" => "Registros de Serviço",
                        "icon" => "fas fa-cogs",
                        "label" => "Serviços",
                        "fields" => [
                            "mainImage" => "Imagem",
                            "name" => "Nome",
                            "price" => "Preço",
                        ]
                    ],
                    "new" => [
                        "url" => "registrar-servico",
                        "requestMethod" => "POST",
                        "title" => "Registrar Novo Serviço",
                        "icon" => "fas fa-cog",
                        "label" => "Novo Serviço",
                        "fields" => [
                            [
                                "name" => "name",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome do Serviço",
                                "required" => true,
                            ],
                            [
                                "name" => "price",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "meanTime",
                                "type" => "number",
                                "min" => "0",
                                "label" => "Tempo médio (minutos)",
                                "required" => false,
                            ],
                            [
                                "name" => "description",
                                "type" => "text",
                                "min" => "0",
                                "label" => "Descrição",
                                "required" => false,
                            ],
                        ]
                    ],
                    "one" => [
                        "url" => null,
                        "requestMethod" => "PUT",
                        "title" => "Registrar Novo Serviço",
                        "icon" => "fas fa-cog",
                        "label" => "Novo Serviço",
                        "fields" => [
                            [
                                "name" => "name",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Nome do Serviço",
                                "required" => true,
                            ],
                            [
                                "name" => "price",
                                "type" => "text",
                                "max" => "100",
                                "label" => "Preço",
                                "required" => true,
                            ],
                            [
                                "name" => "meanTime",
                                "type" => "number",
                                "min" => "0",
                                "label" => "Tempo médio (minutos)",
                                "required" => false,
                            ],
                            [
                                "name" => "description",
                                "type" => "text",
                                "min" => "0",
                                "label" => "Descrição",
                                "required" => false,
                            ],
                        ]
                    ]
                ]
            ],
            "keys" => [
                "prefix" => "key_",
                "primary" => "id",
                "unique" => [ "name", "secret", "public" ],
                "null" => [ "revokeDate", "prefix" ],
                "fields" => [
                    "id" => "int(11)",
                    "name" => "varchar(50)",
                    "prefix" => "varchar(10)",
                    "module" => "varchar(50)", // route root; crud allow access to /crud/*; mailer allow access to /mailer/*. The root route of module is the "creation key" (crud/ or mailer/) endpoint. 
                    "scope" => "varchar(4)",
                    "secret" => "varchar(64)",
                    "public" => "varchar(64)",
                    "creationDate" => "date",
                    "expirationDate" => "date",
                    "revokeDate" => "date",
                ],
            ]
        ]
    ]
];

$displayErrorDetails = [
    "PROD" => false,
    "TEST" => true,
    "DEV" => true
];
$addContentLengthHeader = [
    "PROD" => true,
    "TEST" => true,
    "DEV" => false
];

return [
    "settings" => [
        "displayErrorDetails" => $displayErrorDetails[ ENVIRONMENT ],
        "addContentLengthHeader" => $addContentLengthHeader[ ENVIRONMENT ],
        "view" => $view,
        "logger" => $logger,
        "mail" => $mail,
        "database" => $database[ ENVIRONMENT ],
        "tddb" => $tddb[ ENVIRONMENT ],
        "domain" => $domain[ ENVIRONMENT ],
        "name" => $name,
    ]
];
