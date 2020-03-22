<?php
header( "Access-Control-Allow-Origin: *" );
header( "Access-Control-Allow-Headers: Content-Type" );
header( "Access-Control-Allow-Methods: GET, POST, PUT, DELETE" );


use Slim\Http\Request;
use Slim\Http\Response;
use SebastianBergmann\GlobalState\Exception;

/*****************************/
/***********        **********/
/*          ATENÇÃO          */
/***********        **********/
/*****************************/
// PHPMailer e GuzzelHttp devem ser transferidas para `dependencies.php`
use PHPMailer\PHPMailer\PHPMailer;
use GuzzleHttp\Client as HTTP;

/**
 * 
 * THIRD PARTY
 */
$app->map( [ "POST", "GET" ], "/xesquedele", function( Request $request, Response $response, array $args ){
    $pdo = $this->database;
    $teste = hashGenerate($pdo, "erwebdev2", $this->mailer);
    if( $teste === 0 ){
        $message = "Verifique seu e-mail para ativar sua conta";
    } else {
        $message = "Algo errado, verifique se o e-mail foi inserido corretamente";
    }
    return $response->withJson(["message"=>$message]);
});
$app->map( [ "POST", "GET" ], "/biribiri", function( Request $request, Response $response, array $args ){
    $connection = $this->database;
    $body = $request->getParsedBody();
    foreach($body as $row){
        if($row["service_segment"] === ""){
            $parentId = '0';
        } else {
            $sql = "SELECT service_id FROM oag_services WHERE service_name = '{$row["service_segment"]}'";
            $preparedSql = $connection->prepare($sql);
            $preparedSql->execute();
            $result = $preparedSql->fetch();
            $parentId = array_values($result);
        }
        $sql = "INSERT INTO oag_services(service_name, service_parentId, service_active) VALUES ('{$row["service_name"]}', '{$parentId[0]}', '1')";
        $preparedSql = $connection->prepare($sql);
        try {
            $preparedSql->execute();
            $status = 0;
        } catch (PDOException $p) {
            $status = 1;
        } catch (Exception $e) {
            $status = 1;
        }
        if($status === 0){
            $message = "Ok.";
        } else {
            $message = "Error.";
        }
    }
    return $response->withJson(["status"=>$status, "message"=>$message]);
});
$app->group( "/localities", function () use ( $app ) {
    
    $app->get( "/states[/{id}]", function ( Request $request, Response $response, array $args ) {
        return $response->withJson(
            ( empty( $args[ "id" ] ) )
            ? $this->location->getStates()
            : $this->location->getCities( $args[ "id" ] )
        );
    } );

    $app->get( "/cities/{id}", function ( Request $request, Response $response, array $args ) {
        return $response->withJson( $this->location->getCity( $args[ "id" ] ) );
    } );

} );

// 
// 
// API
//
//  
$app->group( '/api', function () use ( $app ) {

    $app->get("/count/{table}", function(Request $request, Response $response, array $args) {
        $queryParams = $request->getQueryParams();
        $connection = $this->database;
        $prefix = getTablePrefix($connection, $this->dbInfo, $args['table']);
        $db = $this->dbInfo;
        $sql = "SELECT count( {$prefix}id ) from oag_{$args['table']}";
        if ( ! empty ( $queryParams ) ) {
            foreach ( $queryParams as $field => $value ) {
                if ( in_array( $field, $haystack) ) {
                    $paramValues = explode(",", $value);
                    foreach ( explode( ",", $value ) as $paramValue ) {
                        if ( ! empty( $paramValue ) ) {
                            $where[] = $field . " LIKE '%" . $paramValue . "%'";
                        }
                    }
                } else {
                    $where[] = $field . " = '" . $value . "'";
                }
            }
            $sql .= " WHERE " . implode( " AND ", $where );
        }
        //ORDER BY
        $x = $connection->prepare($sql);
        $x->execute();
        $sql_result = $x->fetch();
        $response = $response->withJson( [ "count" => $sql_result["count( account_id )"] ] );
        return $response;
    } );

    $this->map( [ "POST", "GET" ], "/{param}", function( Request $request, Response $response, array $args ) {
        $db = $this->dbInfo;
        $route = $args['param'];
        $connection = $this->database;
        $tablePrefix = $request->getAttribute( "tablePrefix" );
        if( $request->isGet() ){
            $queryParams = $request->getQueryParams();
            $statement = "SELECT * FROM " . $db[ "prefix" ] . $route;
            $haystack = [
                "quotation_providerIds",
            ];
            $orderBy = "";
            if ( ! empty ( $queryParams ) ) {
                foreach ( $queryParams as $field => $value ) {
                    if( $field !== "order_by" ) {
                        if ( in_array( $field, $haystack) ) {
                            $paramValues = explode(",", $value);
                            foreach ( explode( ",", $value ) as $paramValue ) {
                                if ( ! empty( $paramValue ) ) {
                                    $where[] = $field . " LIKE '%" . $paramValue . "%'";
                                }
                            }
                        } else {
                            $where[] = $field . " = '" . $value . "'";
                        }
                    } else {
                        $orderBy = " ORDER BY " . $value . " ASC";
                    }
                }
                $statement .= " WHERE " . implode( " AND ", $where ) . $orderBy;
            }
            try {
                if ( in_array( $field, $haystack ) ) {
                    foreach ( $connection->query( $statement ) as $row ) {
                        $idsInQueryParam = explode( ",", $request->getQueryParam( $field ) );
                        $rowProvIds = explode( ",", $row[ $field ] );
                        foreach( $idsInQueryParam as $id ) {
                           if (in_array($id, $rowProvIds))
                           {
                                $idFilter = array_intersect($idsInQueryParam, $rowProvIds);
                                $output[] = $row;
                           }
                        }
                    }
                } else {
                    foreach ( $connection->query( $statement ) as $row ) {
                        $output[] = $row;
                    }
                }

            } catch ( PDOExcepetion $e ) {
                $output[ "code" ] = $e->getCode();
                $output[ "error" ] = ( $e->getCode() == 23000 )? "Informação já existente no banco de dados." : $e->getMessage();
            } finally {
                $response = $response->withJson( $output );
            }
        }
        if ( $request->isPost() ) {
            $body = $request->getParsedBody();
            $keys = implode( ", ", array_keys( $body ) );
            $values = implode( "', '", array_values( $body ) );

            $statement = "INSERT INTO " . $db[ "prefix" ] . $route . " ( " . $keys . " ) VALUES ( '" . $values . "' )";
            try {
                $connection->prepare( $statement );
                $affectedRows = $connection->exec( $statement );
                if ( $affectedRows !== 0 ) {
                    $sql = "SELECT * FROM {$db[ "prefix" ]}{$route} WHERE {$tablePrefix}id=(";
                    $sql .= " SELECT max({$tablePrefix}id) FROM {$db[ "prefix" ]}{$route}";
                    $sql .= " )";
                    $pdoStatement = $connection->query( $sql );
                    $output = $pdoStatement->fetch();
                }
            } catch ( PDOExcepetion $e ) {
                $output[ "code" ] = $e->getCode();
                $output[ "error" ] = ( $e->getCode() == 23000 )? "Informação já existente no banco de dados." : $e->getMessage();
            } finally {
                $response = $response->withJson( $output );
            }
        }
        
        return $response;
    } );
    
    $this->map( [ "PUT", "DELETE", "GET" ], "/{param}/{id}", function( Request $request, Response $response, array $args ) {
        
        $db = $this->dbInfo;
        $connection = $this->database;
        $tablePrefix = $request->getAttribute( "tablePrefix" );
        
        if( $request->isPut() ){
            $body = $request->getParsedBody();
            foreach ( $body as $key => $value ) {
                $pairs[] = $key . " = '" . $value . "'";
            }
            $sql = "UPDATE " . $db[ "prefix" ] . $args[ "param" ] . " SET ". implode( ", ", $pairs ) ." WHERE " . $tablePrefix . "id = " . $args[ "id" ];
            try {
                foreach ( $connection->query( $sql ) as $row ) {
                    $output = $row;
                }
                $updated = true;
            }
            catch ( PDOExcepetion $e ) {
                $output = $e->getMessage();
                $updated = false;
            }
            if( $updated ) {
                $sql = "SELECT * FROM " . $db[ "prefix" ] . $args[ "param" ] . " WHERE " . $tablePrefix . "id = " . $args[ "id" ];
                foreach ( $connection->query( $sql ) as $row ) {
                    $output = $row;
                }
            } else {
                $output = NULL;                
            }
            
            $response = $response->withJson( $output );
        }
        
        if ( $request->isDelete() ) {
            $sql = "DELETE FROM " . $db[ "prefix" ] . $args[ "param" ] . " WHERE " . $tablePrefix . "id = " . $args[ "id" ];
            $output = ( $this->database->exec( $sql ) ) ? [ "status" => "ok" ]: [ "status" => "error" ];
            $response = $response->withJson( $output );
        }
        if ( $request->isGet() ) {
            $sql = "SELECT * FROM " . $db[ "prefix" ] . $args[ "param" ] . " WHERE " . $tablePrefix . "id = " . $args[ "id" ];
            foreach ( $connection->query( $sql ) as $row ) {
                $output = $row;
            }
            $response = $response->withJson( $output );
        }
            
        return $response;
    } );
    
} )->add( $mw[ "api" ] )->add( $mw[ "hashIt" ] );

/*****************************/
/***********        **********/
/*          ATENÇÃO          */
/***********        **********/
/*****************************/
/**
 * 
 * PHPMailer é usado neste grupo
 */
$app->group( '/validation', function () use ( $app ) {

    $app->post( "/contact", function(Request $request, Response $response, array $args) {
        $body = $request->getParsedBody();
        if( preg_match( '/[a-z0-9.]+@[a-z0-9]+\.[a-z]+/i', $body[ "text" ] ) || preg_match( '/(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))/', $body[ "text" ] ) ) {
            $status = 1;
            $message = "O campo possui dados de contato.";
        } else {
            $status = 0;
            $message = "O Campo está sem informações de contato.";
        }
        return $response->withJson( [ "status" => $status, "message" => $message ] );
    } );

    $app->get( "/document/[{doc}]", function( Request $request, Response $response, array $args ) {
        if ( ! empty( $args[ "doc" ] ) ) {
            $doc = new TDClass\Document( $args[ "doc" ] );
            if ( $doc->getType() !== NULL ) {
                $response = $response->withJson( [ "status" => true, "type" => $doc->getType() ] );
            } else {
                $response = $response->withJson( [ "status" => false ] );
            }
        } else {
            $response = $response->withJson( [ "status" => false ] );
        }
        return $response;
    });

    $app->get( "/mail/{userName}/generate", function( Request $request, Response $response, array $args ) {
        $pdo = $this->database;
        $userName = $args[ "userName" ];
        $teste = hashGenerate($pdo, $userName, $this->mailer);
        if( $teste === 0 ){
            $message = "Verifique seu e-mail para ativar sua conta";
        } else {
            $message = "Algo errado, verifique se o e-mail foi inserido corretamente";
        }
        return $response->withJson(["message"=>$message]);
    });

    $app->get( "/mail/{userName}/verify", function( Request $request, Response $response, array $args ) {
        $db = $this->dbInfo;
        $pdo = $this->database;
        $userName = $args["userName"];
        if ( !empty($userName) ) {
            $tablePrefix = getTablePrefix($this->database, $this->dbInfo, "people");
            $requiredFields = ["account_personId", "account_id", "person_email"];
            $sql = "SELECT ".implode( ",", $requiredFields) . " FROM oag_accounts INNER JOIN  {$db[ "prefix" ]}people ON oag_accounts.account_personId = oag_people.person_id WHERE account_userName = '{$userName}'";
            foreach( sqlExec($pdo, $sql) as $row ){
                $userInfo = $row;
            }
            $mailDoc = $userInfo["person_email"] . "xesque";
            $hashVer = $request->getQueryParam("hash");
            if ( password_verify( $mailDoc, $hashVer) ) {
                $sql = "UPDATE oag_accounts SET account_verified = 1 WHERE account_id = {$userInfo[account_id]}";
                try {
                    $status = ( sqlCon($pdo, $sql) ) ? 0 : 1;
                } catch ( Exception $e ) {
                    $status = 1;
                }
                $response = $response->withJson([ "status" => 0, "message" => "E-mail verificado com sucesso." ]);
            } else {
                $status = 1;
            }
            $message = ( $status === 0 ) ? "E-mail verificado com sucesso." : "Erro fatal na verificação de email." ;
            $url = ( $status === 0 ) ? APP : BASENAME;
            return $response->withRedirect( $url );
        }
    });
    
})->add($mw[ "validation" ])->add($mw[ "activity" ]);

/*****************************/
/***********        **********/
/*          ATENÇÃO          */
/***********        **********/
/*****************************/
/**
 * 
 * PHPMailer é usado nestas rotas
 */
$app->map( [ "GET", "POST" ], "/mail/welcome", function( Request $request, Response $response, array $args ) {
    $body = $request->getParsedbody();
    $userEmail = $body["mail"];
    $mail = $this->mailer;
    $mail->addAddress("$userEmail");
    $mail->Subject = 'Cadastro Orça Agora!';
    $mail->Body    = '<div>';
    $mail->Body    .=    '<div style="text-align: center;">';
    $mail->Body    .=       '<img src="https://media.licdn.com/dms/image/C4D0BAQGCWZb8E9Iw_A/company-logo_200_200/0?e=2159024400&v=beta&t=SmI-5wypKGA_HfkWOhO26MxwtrH9JMidLsF2m8x0lEo">';
    $mail->Body    .=   '</div>'   ;
    $mail->Body    .=   '<div style="background-color: #359690; text-align: center; padding: 2.5em;">';
    $mail->Body    .=        '<span style="font-size: 2.2rem; color: #fff;">';
    $mail->Body    .=           'Faça seu Cadastro';
    $mail->Body    .=        '</span>';
    $mail->Body    .=    '</div>';
    $mail->Body    .=   '<div>';
    $mail->Body    .=       '<div style="text-align: center; padding-top: 2em;">';
    $mail->Body    .=       '<div style="margin-top: 2em;">';
    $mail->Body    .=           'Você recebeu um convite para aproveitar as vantagens do sistema Orça Agora!<br>';
    $mail->Body    .=            'Clique no link abaixo para aproveitar as vantagens.';
    $mail->Body    .= "<a style='display: block; padding: 1em;' href='http://app.orcaagora.com.br'>http://app.orcaagora.com.br</a>";
    $mail->Body    .=        '</div>';
    $mail->Body    .=        '</div>';
    $mail->Body    .=   ' </div>';
    $mail->Body    .=   '<div style="flex-column m-auto">';
    $mail->Body    .=      '<div style="padding: 1em; color: #0a0; text-align: center;">';
    $mail->Body    .=      '<span>Abraços, equipe orçaagora.com.br</span>';
    $mail->Body    .=     ' </div>';
    $mail->Body    .= ' </div>';
    $mail->Body    .=  '</div>';
    if ( $mail->send() )
    {
        return $response->withJson( [ "message" => "Mensagem enviada com sucesso." ] );
    } else
    {
        return $response->withJson( [ "message" => "Falha no envio da mensagem." ] );
    }
} );

$app->map( [ "POST" ], "/suporte", function( Request $request, Response $response, array $args ) {
    $body = $request->getParsedBody();
    $mail = $this->mailer;
    $mail->addAddress("suporte@orcaagora.com.br", "Suporte");
    $mail->Subject = 'Suporte';
    $mail->Body    = " {$body['message']} ";
    $mail->Body   .= ", {$body['email']} ";
    $mail->Body   .= ", {$body['name']}. ";
    $status = ( $mail->send() ) ? 0 : 1;
    $message = ( $status === 0 ) ? "Mensagem enviada com sucesso." : "Falha. Tente novamente mais tarde.";
    return $response->withJson( [ "message"=>$message, "status"=>$status ] );
});

$app->map( ["GET"], "/mail/quotation/{id}" , function( Request $request, Response $response, array $args ) {
    $db = $this->$dbInfo;
    $userId = $args["id"];
    $sql = "SELECT * FROM {$db["prefix"]}accounts WHERE account_id = {$userId}";
    foreach($db->query($sql) as $row)
    {
        $row = $userInfo;
    }
    $sql = "SELECT * FROM {$db["prefix"]}people WHERE person_id = {$userInfo["account_personId"]}";
    foreach( $db->query($sql) as $row )
    {
        $row = $personInfo;
    }
    $userEmail = $personInfo["person_email"];
    $mailFrom = 'orcaagora@orcaagora.com.br';
    $subject = "Cotação negada";
    $replyTo = "noreply@orcaagora.com.br";
    $phpMailer = setMailer($mailFrom, $replyTo, $userEmail, $subject);
    $phpMailer->Body = mailBody("Quotation");
    if($phpMailer->Send())
    {
        echo "Mensagem enviada com sucesso.";
    } else 
    {
        echo "Falha ao enviar a mensagem.";
    }
});

/**
 * 
 * 
 * 
 * USER API
 * 
 */

$app->post( "/login", function ( Request $request, Response $response, array $args ) {
    $connection = $this->database;
    $db = $this->dbInfo;
    $body = $request -> getParsedBody();
    $userName = $body["userName"];
    $passwordCon = $body["password"];
    $requiredFields = [
        "account_id",
        "account_userName",
        "account_password"
    ];
    $sql = "SELECT " . implode( ",", $requiredFields )." FROM " . $db[ "prefix" ] . "accounts WHERE account_userName = '{$userName}'";
    foreach( $connection->query( $sql ) as $row ) {
        $account = $row;
    }
    if ( empty( $account ) ) {
        return false;
    }
    if( password_verify( $passwordCon, $account[ 'account_password' ] ) ) {
        $token = hashGen( array( $userName, $passwordCon ) );
        $date = date( 'Y/m/d h:i:s', time() );
        $sql = "INSERT INTO oag_accesstokens ( oauth_accessToken, oauth_accountId, oauth_expires ) VALUES ( '{$token}', '{$accId}', '{$date}' )";
        if ( $connection->exec( $sql ) ) {
            return $response->withJson( [ "publicKey" => $token, "id" => $account[ "account_id" ] ] );
        }
    }
    return false;
} );

$app->group( '/user', function () use ( $app ) {

    $app->post( '/create', function( Request $request, Response $response, array $args ){
        $body = $request->getParsedbody();
        $user = $this->user;
        $user->debug( true ); // default is false
        $user->setPrefix( $this->dbInfo[ "prefix" ] ); // if not set, prefix is ""
        
        $status = ( $user->create( $body ) ) ? 0 : 1;
        $message = ( $status === 0 ) ? "Cadastrado com sucesso" : "Falha ao enviar dados, tente novamente mais tarde.";
        return $response->withJson( [ "status" => $status, "message" => $message ] );
    } );

    $app->group( '/update', function () use ( $app ) {

        $app->post( '/recover-password', function ( Request $request, Response $response, array $args ) {
            $body = $request->getParsedBody();
            if ( empty( $body ) ) {
                return $response->withJson(["status" => 155, "message" => "Usuário não encontrado"]);
            }
            if ( empty( $body[ "userName" ] ) ) {
                return $response->withJson(["status" => 155, "message" => "Usuário não encontrado"]);
            }
            $userName = $body[ "userName" ];
            $newPassword = rand( 100000, 999999 );
            $newHash = password_hash( $newPassword,  PASSWORD_DEFAULT );
            // db
            $connection = $this->database;
            $sql1 = "UPDATE oag_accounts SET account_password = '$newHash' WHERE account_userName = '$userName'";
            $prepared = $connection->prepare( $sql1 );
            if ( ! $prepared->execute() ) {
                return $response->withJson(["status" => 155, "message" => "Usuário não encontrado"]);
            }
            // 
            $sql2 = "SELECT person_email FROM oag_people INNER JOIN oag_accounts ON oag_accounts.account_personId = oag_people.person_id WHERE oag_accounts.account_userName = '$userName'";
            $prepared = $connection->prepare( $sql2 );
            $prepared->execute();
            $row = $prepared->fetch();
            if ( empty( $row ) ) {
                return $response->withJson(["status" => 155, "message" => "Usuário não encontrado"]);
            }
            // mailing
            $mail = $this->mailer;
            $mail->addAddress( $row[ "person_email" ] );
            $mail->Subject = 'Nova senha de login';
            $mail->Body    = '<div>';
            $mail->Body    .=    '<div style="text-align: center;">';
            $mail->Body    .=       '<img src="https://media.licdn.com/dms/image/C4D0BAQGCWZb8E9Iw_A/company-logo_200_200/0?e=2159024400&v=beta&t=SmI-5wypKGA_HfkWOhO26MxwtrH9JMidLsF2m8x0lEo">';
            $mail->Body    .=   '</div>'   ;
            $mail->Body    .=   '<div style="background-color: #359690; text-align: center; padding: 2.5em;">';
            $mail->Body    .=        '<span style="font-size: 2.2rem; color: #fff;">';
            $mail->Body    .=           'Senha de Acesso';
            $mail->Body    .=        '</span>';
            $mail->Body    .=    '</div>';
            $mail->Body    .=   '<div>';
            $mail->Body    .=       '<div style="text-align: center; padding-top: 2em;">';
            $mail->Body    .=       '<div style="margin-top: 2em;">';
            $mail->Body    .=           'Esqueceu sua senha e nós geramos uma automaticamente para você.';
            $mail->Body    .=            ' Use essa nova senha para acessar o painel de controle e lá poderá alterá-la para outra de sua preferência';
            $mail->Body    .= "<div style='display: block; padding: 1em;'>Sua nova senha: <strong>$newPassword</strong></div>";
            $mail->Body    .=        '</div>';
            $mail->Body    .=        '</div>';
            $mail->Body    .=   ' </div>';
            $mail->Body    .=   '<div style="flex-column m-auto">';
            $mail->Body    .=      '<div style="padding: 1em; color: #0a0; text-align: center;">';
            $mail->Body    .=      '<span>Abraços, equipe orçaagora.</span>';
            $mail->Body    .=     ' </div>';
            $mail->Body    .= ' </div>';
            $mail->Body    .=  '</div>';
            $mail->send();
            $response = $response->withJson(["status" => 0, "message" => "Uma mensagem foi enviada para o email cadastrado. Siga as etapas descritas nele."]);
            return $response;
        } );

        $app->post( "/{id}/services", function( Request $request, Response $response, array $args ){
            $connection = $this->database;
            $body = $request->getParsedbody();
            $accId = $args["id"];
            foreach( $body as $row ){
                $serviceIds = [];
                foreach ( array_values($row["children"]) as $s ) {
                    $serviceIds[] = $s[ "id" ];
                }
                $services = implode( ",", $serviceIds );
                $segs[] = $row[ "id" ] . ":" . $services;
            }
            $segsServ = implode("-", $segs);
            $statement = "UPDATE oag_accounts SET account_services = '{$segsServ}' WHERE account_id = {$accId}";
            $preparedStatement = $connection->prepare($statement);
            if ( $preparedStatement->execute() ) {
                $res = [ "status" => 0, "message" => "Serviços atualizados com sucesso." ];
            } else {
                $res = [ "status" => 155, "message" => "Falha. Tente novamente mais tarde." ];
            }
            return $response->withJson( $res );
        });

        // esta rota não esta atualizando no bd como as de serviço faz
        $app->post( "/{id}/cities", function( Request $request, Response $response, array $args ){
            $connection = $this->database;
            $body = $request->getParsedBody();
            // var_dump( $body );
            // return $response->withJson( 0 );
            $accId = $args[ "id" ];
            if ( $body === "*" ) {
                $prepared = $connection->prepare( "UPDATE oag_accounts SET account_cities = '*' WHERE account_id = " . $accId );
                $status = ( $prepared->execute() ) ? 0 : 1;
                $message = ( $status === 0 ) ? "Locais atualizados com sucesso." : "Falha. Tente novamente mais tarde.";
                return $response->withJson( [ "status" => $status, "message" => $message ] );
            }
            foreach( $body as $row ){
                $cityIds = [];
                if ( $row[ "children" ] === "*" ) {
                    $cities = "*";
                } else {
                    foreach ( array_values( $row["children"] ) as $s ) {
                        $cityIds[] = $s[ "id" ];
                    }
                    $cities = implode( ",", $cityIds );
                }
                $states[] = $row[ "id" ] . ":" . $cities;
            }
            $toSqlString = implode( "-", $states );
            $statement = "UPDATE oag_accounts SET account_cities = '{$toSqlString}' WHERE account_id = {$accId}";
            $preparedStatement = $connection->prepare( $statement );
            $status = ( $preparedStatement->execute() ) ? 0 : 1;
            $message = ( $status === 0 ) ? "Locais atualizados com sucesso." : "Falha. Tente novamente mais tarde.";
            return $response->withJson( [ "status" => $status, "message" => $message ] );
        });
        
        $app->post( "/{id}", function( Request $request, Response $response, array $args ){
             $connection = $this->database;
             $body = $request->getParsedbody();
            // if ( $args["field"] == 0 ){
            //     $requiredFields = "oag_accounts, oag_people, oag_docs";
            //     $args["id"] = $account["id"];
            // $statement = "SELECT * FROM {$requiredFields}";
            // }
            $user = $this->user;
            $user->setId( $args[ "id" ] );
            $user->setPrefix( $this->dbInfo[ "prefix" ] );
            $status = ( $user->update( $body ) ) ? 0 : 1;
            $message = ( $status === 0 ) ? "Dados atualizados com sucesso." : "Falha ao atualizar os dados.";
            return $response->withJson( [ "status" => $status, "message" => $message ] );
        });

    } );

    $app->group( '/read', function () use ( $app ) {

        $app->map( [ "POST", "GET" ], '/{id}/services', function( Request $request, Response $response, array $args ){
            function serviceSQL( $id ) {
                return "SELECT `service_name`, `service_active` FROM `oag_services` WHERE service_id = $id";
            }
            $connection = $this->database;
            $body = $request->getParsedbody();
            $accId = $args["id"];
            $statement = "SELECT account_services FROM oag_accounts WHERE account_id = {$accId}";
            $preparedStatement = $connection->prepare( $statement );
            $preparedStatement->execute();
            $result = $preparedStatement->fetch();
            $services = objectifyFromdb($result["account_services"]);
            $segments = [];
            foreach( $services as $row ){
                $preparedStatement = $connection->prepare( serviceSQL( $row[ "id" ] ) );
                $preparedStatement->execute();
                $selectedSegment = $preparedStatement->fetch();
                $segment = $row;
                $segment[ "name" ] = $selectedSegment[ "service_name" ];
                $segment[ "active" ] = $selectedSegment[ "service_active" ];
                $segment[ "children" ] = [];
                foreach ( $row[ "children" ] as $child ) {
                    $preparedStatement = $connection->prepare( serviceSQL( $child[ "id" ] ) );
                    $preparedStatement->execute();
                    $selectedServices = $preparedStatement->fetch();
                    $service = $child;
                    $service[ "name" ] = $selectedServices[ "service_name" ];
                    $service[ "active" ] = $selectedServices[ "service_active" ];
                    $segment[ "children" ][] = $service;
                }
                $segments[] = $segment;
            }
            return $response->withJson( $segments );
        });
    
        $app->map( [ "POST", "GET" ], '/{id}/cities', function( Request $request, Response $response, array $args ){
            $connection = $this->database;
            $accId = $args[ "id" ];
            $statement = "SELECT account_cities FROM oag_accounts WHERE account_id = {$accId}";
            $preparedStatement = $connection->prepare($statement);
            $preparedStatement->execute();
            $result = $preparedStatement->fetch();
            if ( $result[ "account_cities" ] === "*" || empty( $result[ "account_cities" ] ) ) {
                return $response->withJson( "*" );
            }
            $cities = objectifyFromdb( $result[ "account_cities" ] );
            
            $http = new HTTP( [
                "base_uri" => LOCALS . "/"
            ] );
            $states = [];

            foreach ( $cities as $row ) {
                $clientResponse = $http->get( "estados/{$row[ "id" ]}" );
                $clientBody = $clientResponse->getBody();
                $clientBody = json_decode( $clientBody, true );
                $state[ "id" ] = $clientBody[ "id" ];
                $state[ "name" ] = $clientBody[ "sigla" ];
                $state[ "fullName" ] = $clientBody[ "nome" ];
                $state[ "children" ] = [];
                if ( $row[ "children" ][ 0 ][ "id" ] === "*" ) {
                    $state[ "children" ] = "*";
                } else {
                    foreach ( $row[ "children" ] as $child ) {
                        $clientRes = $http->get( "municipios/{$child[ "id" ]}" );
                        $cBody = json_decode( $clientRes->getBody(), true );
                        $city = [
                            "id" => $cBody[ "id" ],
                            "name" => $cBody[ "nome" ]
                        ];
                        $state[ "children" ][] = $city;
                    }
                }
                $states[] = $state;
            }
            return $response->withJson( $states );
        });
        
        $app->map( [ "POST", "GET" ], '/{id}[/{attribute}]' , function ( Request $request, Response $response, array $args ) {
            $user = $this->user;
            $user->setId( $args[ "id" ] );
            $user->setPrefix( $this->dbInfo[ "prefix" ] );
            return $response->withJson( $user->read( $request->getAttribute( "attribute", "" ) ) );
        } );

    } );

    $app->post( '/delete/{id}', function( Request $request, Response $response, array $args ){
        $user = $this->user;
        $user->setId( $args[ "id" ] );
        $user->setPrefix( $this->dbInfo[ "prefix" ] );
        return $response->withJson([$user]);
        $status = ( $user->delete() ) ? 0 : 1;
        $message = ( $status === 0 ) ? "Remoção realizada com sucesso" : "Falha ao enviar dados, tente novamente mais tarde.";
        return $response->withJson([ "status"=>$status, "message"=>$message ]);
    });
});

$app->group( "/services", function () use ( $app ) {

    $app->map( [ "GET" ], "/read[/{id}]", function( Request $request, Response $response, array $args ) {
        $connection = $this->database;
        $pfx = $this->dbInfo[ "prefix" ];
        $parentId = ( empty( $args[ "id" ] ) ) ? 0 : $args[ "id" ];
        $sql = "SELECT * FROM {$pfx}services WHERE service_parentId = $parentId AND service_active = 1";
        $prepared = $connection->prepare( $sql );
        $prepared->execute();
        $servicesList = $prepared->fetchAll();
        foreach ( $servicesList as $service ) {
            $unPrefixedList[] = unPrefixAll( $service, true );
        }
        return $response->withJson( $unPrefixedList );
    } );

    $app->map( [ "POST" ], "/write/{id}", function( Request $request, Response $response, array $args ) {
        $connection = $this->database;
        $body = $request->getParsedBody();
        $pfx = $this->dbInfo[ "prefix" ];
        foreach ( $body as $key => $value ) {
            $pairs[] = "service_$key = '$value'";
        }
        $set = implode( ", ", $pairs );
        $sql = "UPDATE {$pfx}services SET $set WHERE service_id = {$args[ "id" ]}";
        $prepared = $connection->prepare( $sql );
        $prepared->execute();
        if ( $prepared->execute() ) {
            $status = 0;
            $message = "Dados atualizados com sucesso.";
        } else {
            $status = 1;
            $message = "Falha ao atualizar os dados.";
        }
        return $response->withJson( [ "status" => $status, "message" => $message ] );
    } );

    $app->map( [ "POST" ], "/update", function( Request $request, Response $response, array $args ){
        // corpo ARC: {"id": 2, "accountId":152, "segment":"51", "services":"cddn"}
        $connection = $this->database;
        $body = $request->getParsedbody();
        $pfx = $this->dbInfo["prefix"];
        if(is_numeric($body["segment"]) === false){
            $requiredTables = "oag_services";
            $requiredFields = "service_name, service_parentId, service_active";
            $v = "'{$body["segment"]}', 0, 1";
            $sql = "INSERT INTO {$requiredTables} ({$requiredFields}) VALUES ({$v})";
            $preparedStatement = $connection->prepare($sql);
            try {
                $preparedStatement->execute();
            } catch ( PDOException $e ) {
                return $response->withJson( ["status" => 1, "message" => "Falha. Serviço já sugerido."] );
            }
            $sql = "SELECT LAST_INSERT_ID()";
            $preparedStatement = $connection->prepare($sql);
            $segId = array_values($preparedStatement->fetch());
            foreach( explode(",", $body["services"]) as $x )
            {
                $requiredTables = "oag_services";
                $requiredFields = "service_name, service_parentId, service_active";
                $v = "'{$x}', {$segId[0]}, 1";
                $sql = "INSERT INTO {$requiredTables} ({$requiredFields}) VALUES ({$v})";
                $preparedStatement = $connection->prepare($sql);
                try {
                    $preparedStatement->execute();
                    $sql = "SELECT LAST_INSERT_ID()";
                    $preparedStatement = $connection->prepare($sql);
                    $sIds[] = array_values($preparedStatement->fetch());
                } catch ( PDOException $e ) {
                    return $response->withJson(["status" => 1, "message" => "Falha"]);
                }
            }
        } else {
            $segId = $body["segment"];
            foreach( explode(",", $body["services"]) as $x )
            {
                $requiredTables = "{$pfx}services";
                $requiredFields = "service_name, service_parentId, service_active";
                $v = "'{$x}', '{$body["segment"]}', 1";
                $sql = "INSERT INTO {$requiredTables}({$requiredFields}) VALUES ({$v})";
                $preparedStatement = $connection->prepare($sql);
                try {
                    $preparedStatement->execute();
                    $sql = "SELECT LAST_INSERT_ID()";
                    $preparedStatement = $connection->prepare($sql);
                    $preparedStatement->execute();
                    $sIds[] = array_values( $preparedStatement->fetch() )[ 0 ];
                } catch ( PDOException $e ) {
                    return $response->withJson( ["status" => 1, "message" => "Falha. Serviço $x já existente."] );
                }
            }
        }
        $link = APP;

        $user = $this->user;
        $user->setPrefix( $pfx );
        $user->setId( $body[ "accountId" ] );
        $email = $user->read( "email" )[ "email" ];
        $mail = $this->mailer;
        $mail->addAddress( "$email", "Sugestões Aceitas!" );
        $mail->Subject = 'Verificação de Conta';
        $mail->Body    = '<div>';
        $mail->Body    .=    '<div style="text-align: center;">';
        $mail->Body    .=       '<img src="https://media.licdn.com/dms/image/C4D0BAQGCWZb8E9Iw_A/company-logo_200_200/0?e=2159024400&v=beta&t=SmI-5wypKGA_HfkWOhO26MxwtrH9JMidLsF2m8x0lEo">';
        $mail->Body    .=   '</div>'   ;
        $mail->Body    .=   '<div style="background-color: #359690; text-align: center; padding: 2.5em;">';
        $mail->Body    .=        '<span style="font-size: 2.2rem; color: #fff;">';
        $mail->Body    .=           'Sugestões Aceitas';
        $mail->Body    .=        '</span>';
        $mail->Body    .=    '</div>';
        $mail->Body    .=   '<div>';
        $mail->Body    .=       '<div style="text-align: center; padding-top: 2em;">';
        $mail->Body    .=       '<div style="margin-top: 2em;">';
        $mail->Body    .=           'Você sugeriu serviços ou produtos pelo painel adminstrtivo Orça Agora. Suas sugestões foram aceitas.';
        $mail->Body    .=            'Agora é só acessar <strong>Meu Serviços</strong> no painel de adminstrativo e acrescentar as opções que você sugeriu, agora disponíveis na listagem.';
        $mail->Body    .= "<a style='display: block; padding: 1em;' href='$link'>$link</a>";
        $mail->Body    .=        '</div>';
        $mail->Body    .=        '</div>';
        $mail->Body    .=   ' </div>';
        $mail->Body    .=   '<div style="flex-column m-auto">';
        $mail->Body    .=      '<div style="padding: 1em; color: #0a0; text-align: center;">';
        $mail->Body    .=      '<span>Abraços, equipe orçaagora.</span>';
        $mail->Body    .=     ' </div>';
        $mail->Body    .= ' </div>';
        $mail->Body    .=  '</div>';
        try {     
            $status = ( $mail->send() ) ? 0 : 1;
        } catch ( Exception $e ) {
            $status = 1;
        }
        $message = ( $status === 0 ) ? "E-mail enviado com sucesso." : "Erro fatal na verificação de email." ;
        
        return $response->withJson( [ "status" => $status, "message" => $message ] );
        // $userServices = "{$body["segment"]}:{$body["services"]}";
        // $user = $this->user;
        // $user->setId($body["accountId"]);
        // $user->setPrefix($pfx);
        // $uData = $user->read(""); 
        // $uServices = $uData["services"];
        // if ( ! empty ( $uServices ) ) {
        //     $segmentsArray = explode( "-", $uServices );
        //     for ( $i = 0; $i < count( $segmentsArray ); $i++ ) {
        //         $segmentWithServices = $segmentsArray[ $i ];
        //         $segAndServicePair = explode( ":", $segmentWithServices );
        //         // return $response->withJson( $segAndServicePair );
        //         $segmentHierarchy[ $i ] = array(
        //             "id" => $segAndServicePair[ 0 ],
        //             "children" => explode( ",", $segAndServicePair[ 1 ] )
        //         );
        //         if ( $segAndServicePair[ 0 ] == $body["segment"] ) {
        //             foreach ( $sIds as $x ) {
        //                 $segmentHierarchy[ $i ][ "children" ][] = "$x";
        //             }
        //             $implodeHierarchyser = implode(",", $segmentHierarchy[ $i ]["children"] );
        //             $concSegSerHierarchy[] = $segAndServicePair[0] . ":" . $implodeHierarchyser;
        //             // implode( , )
        //             // return $response->withJson( "mec" );
        //         }
        //     }
        //     if ( isset( $concSegSerHierarchy ) ) {
        //         $uData["services"] = implode( "-", $concSegSerHierarchy );
        //         unset( $concSegSerHierarchy );
        //     }
        //     // return $response->withJson( $concSegSerHierarchy );
        // } else {
        //     foreach ( $sIds as $x ) {
        //         $segmentHierarchy[ $i ][ "children" ][] = "$x";
        //     }
        //     $implodeHierarchyser = implode(",", $segmentHierarchy[$i]["children"] );
        //     $concSegSerHierarchy = $segAndServicePair[0] . ":" . $implodeHierarchyser;
        //     $uData["services"] = $concSegSerHierarchy;
        //     return $response->withJson($uData);
        // }
        // if () {
        //     $status = 0;
        //     $message = "Success";
        // } else {
        //     $status = 1;
        //     $message = "gtfu";
        // }
        // return $response->withJson(["status" => $status, "message" => $message]);
    });

} );

$app->group( "/suggestions",function () use ( $app ) {

    $app->get( "/read[/{id}]", function( Request $request, Response $response, array $args ) {
        $connection = $this->database;
        $sql = "SELECT * FROM oag_suggestions";
        if ( ! empty( $args[ "id" ] ) ) {
            $sql .= " WHERE suggestion_id = {$args[ "id" ]}";
        }
        $preparedSql = $connection->prepare( $sql );
        $preparedSql->execute();
        if ( ! empty( $args[ "id" ] ) ) {
            $suggestions[] = $preparedSql->fetch();
        } else {
            $suggestions = $preparedSql->fetchAll();
        }
        foreach( $suggestions as $suggestion ){
            $suggestion = unPrefixAll( $suggestion, true );
            if( is_numeric( $suggestion[ "segment" ] ) ){
                $sql = "SELECT service_name FROM oag_services WHERE service_id = {$suggestion["segment"]}";
                $preparedSql = $connection->prepare($sql);
                $preparedSql->execute();
                $suggestion[ "segment" ] = $preparedSql->fetch()[ "service_name" ];
            }
            $services = explode( ",", $suggestion[ "services" ] );
            $json[] = [
                "segmentName" => $suggestion[ "segment" ],
                "segmentId" => $suggestion[ "id" ],
                "accountId" => $suggestion[ "accountId" ],
                "services" => $services
            ];
        }
        return $response->withJson( $json );

    } );
    
} );

$app->group( "/quotations", function () use ( $app ){
    /*****************************/
    /***********        **********/
    /*          ATENÇÃO          */
    /***********        **********/
    /*****************************/
    // não deve haver NENHUM comando SQL na rota. Um classe Quotation deve ser implementada para as rotas deste grupo

    $app->post( "/read/providers", function( Request $request, Response $response, array $args ){
        $body = $request->getParsedbody();
        $connection = $this->database;
        
        $select = "account_id, account_services, account_cities, person_fullName, person_companyName";
        $from = "oag_accounts INNER JOIN oag_people ON oag_accounts.account_personId = oag_people.person_id";
        $where = "account_scope = 'provider' AND account_services LIKE '%:%'";
        if ( $body[ "state" ] === "*" ) {
            $where .= " AND account_cities = '*'";
            $cIds = [];
        } else {
            foreach ( $body[ "state" ][ "children" ] as $w ) {
                $cIds[] = $w[ "id" ];
            }
            $where .= " AND account_cities LIKE '%:%'";
        }
        $sql = "SELECT $select FROM $from WHERE $where";
        $preparedSql = $connection->prepare( $sql );
        $preparedSql->execute();
        $providers = $preparedSql->fetchAll();
        foreach ( array_values( $body[ "segment" ][ "children" ] ) as $x ) {
            $bodyServs[] = "$x";
        }
        function filterIfHas( array $requiredItems, string $type , array $assocArray ) {
            foreach ( $assocArray as $p ) {
                foreach( explode( "-", $p[ "account_$type" ] ) as $pairString ) {
                    $ex = explode( ":", $pairString );
                    $servs = explode( ",", $ex[ 1 ] );
                    $missing = 0;
                    foreach ( $requiredItems as $bS ) {
                        if ( ! in_array( $bS, $servs ) ) {
                            $missing = 1;
                        }
                    }
                    if ( empty( $missing ) ) {
                        $o[] = [
                            "id" => $p[ "account_id" ],
                            "name" => ( empty( $p[ "person_companyName" ] ) ) ? $p[ "person_fullName" ] : $p[ "person_companyName" ]
                        ];
                    }
                }
            }
            return $o;
        }
        $provs = filterIfHas( $bodyServs, "services", $providers );
        return $response->withJson( $provs );
    });
    
    $app->get( "/read[/{id}]", function( Request $request, Response $response, array $args ) {
        $connection = $this->database;
        $pfx = $this->dbInfo[ "prefix" ];
        $sql = "SELECT * FROM {$pfx}quotations";
        if ( ! empty( $args[ "id" ] ) ) {
            $sql .= " WHERE quotation_id = {$args[ "id" ]}";
        }
        $preparedSql = $connection->prepare( $sql );
        $preparedSql->execute();
        if ( ! empty( $args[ "id" ] ) ) {
            $quotations[] = $preparedSql->fetch();
        } else {
            $quotations = $preparedSql->fetchAll();
        }

        foreach( $quotations as $quotation ){
            $quotation = unPrefixAll( $quotation, true );
            $sql = "SELECT * FROM {$pfx}services WHERE service_id = {$quotation[ "serviceId" ]}";
            $preparedSql = $connection->prepare( $sql );
            $preparedSql->execute();
            $service = $preparedSql->fetch();
            
            foreach ( explode( ",", $quotation[ "providerIds" ] ) as $provId ) {
                $preparingProv = $this->user;
                $preparingProv->setPrefix( $pfx );
                $preparingProv->setId( intval( $provId ) );
                $provs[] = $preparingProv->read();
                unset( $preparingProv );
            }
            
            if ( ! empty( $quotation[ "tryingProviderIds" ] ) ) {
                foreach ( explode( ",", $quotation[ "tryingProviderIds" ] ) as $provId ) {
                    $preparingProv = $this->user;
                    $preparingProv->setPrefix( $pfx );
                    $preparingProv->setId( $provId );
                    $tryingProvs[] = $preparingProv->read();
                }
            }

            $quotation[ "providers" ] = $provs;
            $quotation[ "tryingProviders" ] = $tryingProvs;
            $quotation[ "city" ] = $this->location->getCity( $quotation[ "ufs" ] );
            
            $json[] = $quotation;
        }
        return $response->withJson( $json );

    } );

    $app->post( "/update/new-provider", function( Request $request, Response $response, array $args ) {
        $pfx = $this->dbInfo[ "prefix" ];
        $connection = $this->database;
        $b = $request->getParsedBody();
        $reqF = "quotation_tryingProviderIds,quotation_accountId";
        $sql = "SELECT $reqF FROM {$pfx}quotations WHERE quotation_id = " . $b[ "id" ];
        // return $response->withJson( $sql );
        $prSt = $connection->prepare( $sql );
        $prSt->execute();
        $quot = $prSt->fetch();
        $quot = unPrefixAll( $quot, true );
        // 
        $tryPr = ( empty( $quot[ "tryingProviderIds" ] ) ) ? [] : explode( $quot[ "tryingProviderIds" ] );
        $tryPr[] = $b[ "providerId" ];
        $sql = "UPDATE {$pfx}quotations SET quotation_tryingProviderIds =";
        $sql .= " " . implode( ",", $tryPr ) . " ";
        $sql .= "WHERE quotation_id = " . $b[ "id" ];
        $prSt = $connection->prepare( $sql );
        // $prSt->execute();
        // 
        $user = $this->user;
        $user->setPrefix( $pfx );
        $user->setId( $quot[ "accountId" ] );
        $uData = $user->read();
        $medium = [
            "companyName" => $uData[ "companyName" ],
            "fullName" => $uData[ "fullName" ],
            "tel" => $uData[ "tel" ],
            "email" => $uData[ "email" ],
        ];
        $mail = $this->mailer;
        $mail->addAddress("{$medium["email"]}", "{$medium["fullName"]}");
        $mail->Subject = 'Cotação';
        $mail->Body    = mailBody( "Quotation" );
        $status = ( $mail->send() ) ? 0 : 1;
        $message = ( $status === 0 ) ? "Dados atualizados com sucesso." : "Falha na conexão. Tente novamente mais tarde.";
        $res = [
            "status" => $status,
            "message" => $message,
            "data" => $medium
        ];
        return $response->withJson( $res );
    } );
    
} );

/**
 * 
 * 
 *  
 * USER INTERFACE
 * 
 */ 

$app->get( "/login", function ( Request $request, Response $response, array $args ) {
    return $response->withRedirect( APP, 301 );
} );
$app->get( '/[{page}]', function( Request $request, Response $response, array $args ) {
    $navUrl = "/" . $request->getAttribute( "page", "" );
    $connection = $this->database;
    $sql = "SELECT * FROM oag_navigation WHERE nav_scope = 'guest' AND nav_url = '{$navUrl}'";

    $pdoStatement = $connection->prepare( $sql );
    $pdoStatement->execute();
    $page = $pdoStatement->fetch();

   if ( empty( $page ) ) {
        $page[ "file" ] = "404.php";
    } else {
        $page = unPrefixAll( $page, true );
    }

    return $this->view->render( $response, $page[ "file" ], $args );
} );
