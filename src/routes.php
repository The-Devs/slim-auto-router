<?php
header( "Access-Control-Allow-Origin: *" );
header( "Access-Control-Allow-Headers: Content-Type" );
header( "Access-Control-Allow-Methods: GET, POST, PUT, DELETE" );


use Slim\Http\Request;
use Slim\Http\Response;
use SebastianBergmann\GlobalState\Exception;


/**
 * ADMIN SCENES
 */
// "AdminApp"/{param}[/{id}]
$rt[ "adminScreens" ] = function ( Request $request, Response $response, array $args ) {
    $html = $this->html;
    $url = $args[ "param" ];
    $id = $request->getParam( "id", 0 );
    $data[ "nav" ] = json_encode( $html[ "nav" ] );

    if ( in_array( $url, array_keys( $html[ "urlPage" ] ) ) ) {
        $data[ "current" ] = $html[ "urlPage" ][ $url ];
        foreach ( $data[ "current" ][ "fields" ] as $props ) {
            $body[ $props[ "name" ] ] = "";
        }
        switch ( $data[ "current" ][ "requestMethod" ] ) {
            case "get":
            case "GET":
                $file = "sidebar-full-height-list.php";
                break;
            case "put":
            case "PUT":
                $data[ "current" ][ "id" ] = $id;
                $data[ "current" ][ "body" ] = json_encode( $body );
                $file =  "sidebar-full-height-single.php";
                break;
            case "post":
            case "POST":
                $data[ "current" ][ "body" ] = json_encode( $body );
                $file = "sidebar-full-height-form.php";
                break;
            case "delete":
            case "DELETE":
                // $file = "sidebar-full-height-form.php";
                // $data[ "current" ][ "form" ] = $props;
                break;
            default:
                break;
        }
    } else {
        // if({id})else:
        switch ( $url ) {
            case "inicio":
                $data[ "current" ][ "title" ] = "Dados para Acesso";
                $data[ "current" ][ "user" ] = $this->session->whoIsThere();
                $file = "sidebar-full-height-login.php";
                break;
            default:
                $data[ "current" ][ "title" ] = "Página não encontrada";
                $file = "sidebar-full-height-404.php";
                break;
        }
    }
    return $this->view->render(
        $response,
        $file,
        $data
    );
};

/**
 * all html root routes
 */
$rt[ "home" ] = function ( Request $request, Response $response, array $args ) {
    $route = $request->getUri()->getPath();
    $numbOfParams = intval( count( explode( "/", $route ) ) ) - 2;
    switch( $numbOfParams ) {
        case 1:
            $file = "home.php";
            break;
        default:
            $file = "index.php";
            break;
    }
    return $this->view->render(
        $response,
        $file,
        []
    );
};


/**
 * CRUD
 */
// /crud/{tableName}[/{id|colName}[/{value}]]
$rt[ "crudRoot" ] = function ( Request $request, Response $response, array $args ) {
    return "Set API Key first of all.";
};

// /crud/{tableName} - get, post
// get ?fieldName=fieldValue
//      &qType=(like||interval)
//      &fields=fieldName1,fieldName2
//      &perPage=[0-9]+
//      &page=[0-9]+
$rt[ "crudRows" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->database;
    $resTemp = $this->resTemp;
    $tableName = $args[ "tableName" ];
    if ( $db->isTable( $tableName ) ) {
        if ( $request->isGet() ) {
            $fields = $request->getParam( "fields", [] );
            if ( ! empty( $fields ) ) {
                $fields = explode( ",", $fields );
            }
            // aqui!!!
            $where = $request->getQueryParams();
            $perPage = $request->getQueryParam( "perPage" );
            $page = $request->getQueryParam( "page", 1 );
            if ( ! empty( $perPage ) ) {
                $offset = $perPage*( $page - 1);
                $db->setSelectLimit( $perPage, $offset );
            }
            unset(
                $where[ "fields" ],
                $where[ "qType" ],
                $where[ "perPage"],
                $where[ "page"]
            );
            switch ( $request->getQueryParam( "qType" ) ) {
                case "like":
                    $db->setWhereType( "like" );
                    $data = $db->select( $tableName, $fields, $where );
                    break;
                case "interval":
                    break;
                // case "csv":
                //     break;
                default:
                    $data = $db->select( $tableName, $fields, $where );
                    break;
            }
            // 
            $resTemp->setMaxDataSize( $db->countTable( $tableName, $where ) );
            $resTemp->setPagination( $page );
            $res = $resTemp->build( 0, $data );
        }
        if ( $request->isPost() ) {
            $body = $request->getParsedBody();
            $dbResponse = $db->insert( $tableName, $body );
            if ( $dbResponse !== false ) {
                $res = $resTemp->build( 0 );
            } else {
                $res = $resTemp->build( 2 );
            }
        }
    } else {
        $res = $resTemp->build( 1 );
    }
    return $response->withJson( $res );
};
// /crud/{tableName}/{id} - get, put, delete
$rt[ "crudRowById" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->database;
    $resTemp = $this->resTemp;
    $tableName = $args[ "tableName" ];
    $where = [ "id" => $args[ "id" ] ];
    if ( $db->isTable( $tableName ) ) {
        if ( $request->isGet() ) {
            $res = $resTemp->build( 0, $db->select( $tableName, [], $where ) );
        }
        if ( $request->isPut() ) {
            $body = $request->getParsedBody();
            $dbResponse = $db->update( $tableName, $body, $where );
            if ( $dbResponse !== false ) {
                $res = $resTemp->build( 0 );
            } else {
                $res = $resTemp->build( 2 );
            }
        }
        if ( $request->isDelete() ) {
            $dbResponse = $db->delete( $tableName, $where );
            if ( $dbResponse !== false ) {
                $res = $resTemp->build( 0 );
            } else {
                $res = $resTemp->build( 2 );
            }
        }
    } else {
        $res = $resTemp->build( 1 );
    }
    return $response->withJson( $res );
};
$rt[ "crudInstall" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->database;
    $resTemp = $this->resTemp;
    if ( $db->isEmpty() ) {
        $res = $db->createTables() . " tables created.";
    } else {
        $res = $resTemp->build( 4 );
        // 4 = cannot install. There is previous installation
    }
    return $response->withJson( $res );
};
// $rt[ "crudTableName" ] = function ( Request $request, Response $response, array $args ) {};
// $rt[ "crudTableName" ] = function ( Request $request, Response $response, array $args ) {};

/**
 * THE DEVS INTERFACE
 */

$rt[ "tdLogin" ] = function ( Request $request, Response $response, array $args ) {
    $body = $request->getParsedBody();
    $usr = $body[ "username" ];
    $pwd = $body[ "password" ];
    $db = $this->tddb;
    $resTemp = $this->resTemp;
    $a = $db->select( "accounts", [], [ "username" => $usr ] );
    if ( count( $a ) === 0 ) {
        $resTemp->setResourceName( "Usuário" );
        return $response->withJson( $resTemp->build( 1 ) );
    }
    $res = $a[ 0 ];
    if ( ! password_verify( $pwd, $res[ "password" ] ) ) {
        return $response->withJson( $resTemp->build( 3 ) );
    }
    if ( empty( $res[ "isActive" ] ) ) {
        $resTemp->setResourceMessage( "Usuário inativo. Entre em contato com o suporte." );
        return $response->withJson( $resTemp->build( 2 ) );
    }

    $session = $this->session;
    if ( $session->create( $usr, $res[ "id" ] ) ) {
        $resTemp->forceReload();
        $res = $resTemp->build( 0 );
    } else {
        $resTemp->setResourceMessage( "Não foi possível iniciar a sessão." );
        $res = $resTemp->build( 2 );
    }
    return $response->withJson( $res );
    // middleware -> verifica user na sessão; redireciona pra login; após login verifica keys; redireciona pra criação da key; redireciona para site de origem
};

$rt[ "tdLogout" ] = function ( Request $request, Response $response, array $args ) {
    $this->session->destroy();
    $resTemp = $this->resTemp;
    $resTemp->forceReload();
    return $response->withJson( $resTemp->build( 0 ) );
};

// api/password/{username}
$rt[ "tdNewPassword" ] = function ( Request $request, Response $response, array $args ) {
    $body = $request->getParsedBody();
    $db = $this->tddb;
    $resTemp = $this->resTemp;
    $username = $args[ "username" ];
    $res = $db->select( "accounts", [], [ "username" => $username ] );
    if ( count( $res ) === 0 ) {
        $resTemp->setResourceName( "Usuário" );
        return $response->withJson( $resTemp->build( 1 ) );
    }
    // 
    $pass = $this->password;
    $pwd = ( empty( $body[ "password" ] ) ) ? $pass->create() : $body[ "password" ];
    $pass->set( $pwd );

    if ( ! $db->update( "accounts", [ "password" => $pass->hash() ], [ "username" => $username ] ) ) {
        return $response->withJson( $resTemp->build( 2 ) );
    }
    return $response->withRedirect( "/api/logout" );
};

// /api/crud/
$rt[ "tdCrudRows" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->tddb;
    $resTemp = $this->resTemp;
    $tableName = $args[ "tableName" ];
    if ( $db->isTable( $tableName ) ) {
        if ( $request->isGet() ) {
            $fields = $request->getParam( "fields", [] );
            if ( ! empty( $fields ) ) {
                $fields = explode( ",", $fields );
            }
            // aqui!!!
            $where = $request->getQueryParams();
            $perPage = $request->getQueryParam( "perPage" );
            $page = $request->getQueryParam( "page", 1 );
            if ( ! empty( $perPage ) ) {
                $offset = $perPage*( $page - 1);
                $db->setSelectLimit( $perPage, $offset );
            }
            unset(
                $where[ "fields" ],
                $where[ "qType" ],
                $where[ "perPage"],
                $where[ "page"]
            );
            switch ( $request->getQueryParam( "qType" ) ) {
                case "like":
                    $db->setWhereType( "like" );
                    $data = $db->select( $tableName, $fields, $where );
                    break;
                case "interval":
                    break;
                // case "csv":
                //     break;
                default:
                    $data = $db->select( $tableName, $fields, $where );
                    break;
            }
            // 
            $resTemp->setMaxDataSize( $db->countTable( $tableName, $where ) );
            $resTemp->setPagination( $page );
            $res = $resTemp->build( 0, $data );
        }
        if ( $request->isPost() ) {
            $body = $request->getParsedBody();
            $dbResponse = $db->insert( $tableName, $body );
            if ( $dbResponse !== false ) {
                $res = $resTemp->build( 0 );
            } else {
                $res = $resTemp->build( 2 );
            }
        }
    } else {
        $res = $resTemp->build( 1 );
    }
    return $response->withJson( $res );
};
// /crud/{tableName}/{id} - get, put, delete
$rt[ "tdCrudRowById" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->tddb;
    $resTemp = $this->resTemp;
    $tableName = $args[ "tableName" ];
    $where = [ "id" => $args[ "id" ] ];
    if ( $db->isTable( $tableName ) ) {
        if ( $request->isGet() ) {
            $res = $resTemp->build( 0, $db->select( $tableName, [], $where ) );
        }
        if ( $request->isPut() ) {
            $body = $request->getParsedBody();
            $dbResponse = $db->update( $tableName, $body, $where );
            if ( $dbResponse !== false ) {
                $res = $resTemp->build( 0 );
            } else {
                $res = $resTemp->build( 2 );
            }
        }
        if ( $request->isDelete() ) {
            $dbResponse = $db->delete( $tableName, $where );
            if ( $dbResponse !== false ) {
                $res = $resTemp->build( 0 );
            } else {
                $res = $resTemp->build( 2 );
            }
        }
    } else {
        $res = $resTemp->build( 1 );
    }
    return $response->withJson( $res );
};
$rt[ "tdCrudInstall" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->tddb;
    $resTemp = $this->resTemp;
    if ( $db->isEmpty() ) {
        $res = $db->createTables() . " tables created.";
    } else {
        $res = $resTemp->build( 4 );
        // 4 = cannot install. There is previous installation
    }
    return $response->withJson( $res );
};
