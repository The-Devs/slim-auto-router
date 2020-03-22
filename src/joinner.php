<?php
$router = [
    "admin-app" => [
        "crud" => [
            [
                "methods" => [ "GET" ],
                "url" => "/",
                "function" => $rt[ "crudRoot" ]
            ],
            [
                "methods" => [ "GET" ],
                "url" => "/install",
                "function" => $rt[ "crudInstall" ]
            ],
            [
                "methods" => [ "GET", "POST" ],
                "url" => "/{tableName}",
                "function" => $rt[ "crudRows" ]
            ],
            [
                "methods" => [ "GET", "PUT", "DELETE" ],
                "url" => "/{tableName}/{id}",
                "function" => $rt[ "crudRowById" ]
            ],
            "middleware" => $mw[ "checkApiKey" ]
        ],
        [
            "methods" => [ "GET" ],
            "url" => "/",
            "function" => $rt[ "home" ],
            "middleware" => $mw[ "track" ]
        ],
        [
            "methods" => [ "GET" ],
            "url" => "/{param}[/{id}]",
            "function" => $rt[ "adminScreens" ],
            "middleware" => $mw[ "checkSessionLogin" ]
        ],
    ],
    "api" => [
        "crud" => [
            [
                "methods" => [ "GET" ],
                "url" => "/",
                "function" => $rt[ "tdCrudRoot" ]
            ],
            [
                "methods" => [ "GET" ],
                "url" => "/install",
                "function" => $rt[ "tdCrudInstall" ]
            ],
            [
                "methods" => [ "GET", "POST" ],
                "url" => "/{tableName}",
                "function" => $rt[ "tdCrudRows" ]
            ],
            [
                "methods" => [ "GET", "PUT", "DELETE" ],
                "url" => "/{tableName}/{id}",
                "function" => $rt[ "tdCrudRowById" ]
            ],
        ],
        [
            "methods" => [ "POST" ],
            "url" => "/login",
            "function" => $rt[ "tdLogin" ],
        ],
        [
            "methods" => [ "GET" ],
            "url" => "/logout",
            "function" => $rt[ "tdLogout" ],
        ],
        [
            "methods" => [ "POST" ],
            "url" => "/password/{username}",
            "function" => $rt[ "tdNewPassword" ],
            // "middleware" => $rt[ "hash" ]
        ]
    ],
    [
        "methods" => [ "GET" ],
        "url" => "/",
        "function" => $rt[ "home" ],
        "middleware" => $mw[ "track" ]
    ]
];

