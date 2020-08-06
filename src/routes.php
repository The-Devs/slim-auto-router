<?php
use Slim\Http\Request;
use Slim\Http\Response;
use TDClass\ResponseTemplate;
use SebastianBergmann\GlobalState\Exception;

$rt[ "home" ] = function ( Request $request, Response $response, array $args ) {
	return $response->getBody()->write( "Mec" );
};
// /crud/{tableName}[/{id|colName}[/{value}]]
$rt[ "crudRoot" ] = function ( Request $request, Response $response, array $args ) {
    return "Show what endpoints exist and links for navigations in API.";
};

// /crud/{tableName} - get, post
// get
//      ?[fieldName]=fieldValue
//      &qType=(like|csv|interval)
//      &fields=fieldName1,fieldName2
//      &perPage=[0-9]+
//      &page=[0-9]+
$rt[ "crudRows" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->database;
    $tableName = $args[ "tableName" ];
    if ( $db->isTable( $tableName ) ) {
        if ( $request->isGet() ) {
            $fields = $request->getParam( "fields", [] );
            if ( ! empty( $fields ) ) {
                $fields = explode( ",", $fields );
            }
            $where = $request->getQueryParams();
            $perPage = $request->getQueryParam( "perPage", DEFAULT_PAGINATION );
            $page = $request->getQueryParam( "page", DEFAULT_PAGE );
			$offset = $perPage*( $page - 1 );
			$db->setSelectLimit( $perPage, $offset );
			foreach ( PRE_EXISTENT_PARAMS as $preExistentParam )
			{
				if ( isset( $where[ $preExistentParam ] ) )
				{
					unset( $where[ $preExistentParam ] );
				}
			}
            switch ( $request->getQueryParam( "qType" ) ) {
                case "like":
                    $db->setWhereType( "like" );
                    $data = $db->select( $tableName, $fields, $where );
                    break;
                case "interval":
                    break;
                case "csv":
					// get csv col from db (no pagination)
					$unhandledData = $db->select( $tableName );
					$data = [];
					// [fieldName]=$csvList
					foreach ( $where as $colName => $colValue )
					{
						$listAsArray = array_map( "intval", explode( ",", $colValue ) );
						foreach ( $unhandledData as $unhandledRow )
						{
							$valuesAsArray = explode( ",", $unhandledRow[ $colName ] );
							$valuesAsArray = array_map( "intval", $valuesAsArray );
							$intersection = array_intersect( $listAsArray, $valuesAsArray );
							if ( $intersection === $listAsArray )
							{
								$data[] = $unhandledRow;
							}
						}
					}
                    break;
                default:
                    $data = $db->select( $tableName, $fields, $where );
                    break;
            }
			//
			$resTemp = new ResponseTemplate( 200 );
			$resTemp->setLink( "self", "page=$page" );
            $res = $resTemp->build( $data );
        }
        if ( $request->isPost() ) {
            $body = $request->getParsedBody();
            $dbResponse = $db->insert( $tableName, $body );
            if ( $dbResponse !== false ) {
				$resTemp = new ResponseTemplate( 200 );
				$resTemp->setLink( "created", "page=" );
                $res = $resTemp->build();
            } else {
				$resTemp = new ResponseTemplate( 500 );
                $res = $resTemp->build();
            }
        }
    } else {
		$resTemp = new ResponseTemplate( 404 );
        $res = $resTemp->build();
    }
    return $response->withJson( $res );
};
// /crud/{tableName}/{id} - get, put, delete
$rt[ "crudRowById" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->database;
    $tableName = $args[ "tableName" ];
    $where = [ "id" => $args[ "id" ] ];
    if ( $db->isTable( $tableName ) ) {
        if ( $request->isGet() ) {
			$resTemp = new ResponseTemplate( 200 );
            $res = $resTemp->build( $db->select( $tableName, [], $where ) );
        }
        if ( $request->isPut() ) {
            $body = $request->getParsedBody();
            $dbResponse = $db->update( $tableName, $body, $where );
            if ( $dbResponse !== false ) {
				$resTemp = new ResponseTemplate( 200 );
                $res = $resTemp->build();
            } else {
				$resTemp = new ResponseTemplate( 500 );
                $res = $resTemp->build();
            }
        }
        if ( $request->isDelete() ) {
            $dbResponse = $db->delete( $tableName, $where );
            if ( $dbResponse !== false ) {
				$resTemp = new ResponseTemplate( 200 );
                $res = $resTemp->build();
            } else {
				$resTemp = new ResponseTemplate( 500 );
                $res = $resTemp->build();
            }
        }
    } else {
		$resTemp = new ResponseTemplate( 404 );
        $res = $resTemp->build();
    }
    return $response->withJson( $res );
};
$rt[ "crudInstall" ] = function ( Request $request, Response $response, array $args ) {
    $db = $this->database;
	$res = $db->createTables() . " tables created.";
    return $response->withJson( $res );
};
