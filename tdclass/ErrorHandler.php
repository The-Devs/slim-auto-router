<?php

namespace TDClass;

/**
 * status
 * 0: ok
 * 1: route error
 * 2: sql error
 * 3: http status 500
 */

class ErrorHandler {
    public function __invoke( $request, $response, $exception ) {
        $status = 3;
        $message = $exception->getMessage();
        return $response
            ->withStatus(500)
            ->withJson( [ "status" => $status, "message" => $message ] );
            //  ->withHeader('Content-Type', 'application/json')
            //  ->write('Something went wrong!');
    }
}
