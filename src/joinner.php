<?php
$router = [
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
    ],
    [
        "methods" => [ "GET" ],
        "url" => "/equipe",
        "function" => $rt[ "team" ],
        "middleware" => $mw[ "track" ]
    ]
];

