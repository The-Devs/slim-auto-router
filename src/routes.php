<?php
use Slim\Http\Request;
use Slim\Http\Response;
use SebastianBergmann\GlobalState\Exception;

// /crud/{tableName}[/{id|colName}[/{value}]]
$rt[ "crudRoot" ] = function ( Request $request, Response $response, array $args ) {
    return "Show what endpoints exist and links for navigations in API.";
};

// /crud/{tableName} - get, post
// get
//      ?fieldName=fieldValue
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
