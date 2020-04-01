<?php
$router = [
    "equipe" => [
        [
            "methods" => [ "GET" ],
            "url" => "/{username}",
            "function" => $rt[ "curriculum-vitae" ],
        ]
    ],
    [
        "methods" => [ "GET" ],
        "url" => "/",
        "function" => $rt[ "home" ],
    ],
    [
        "methods" => [ "POST" ],
        "url" => "/mail",
        "function" => $rt[ "mailer" ],
    ],
];

