<?php
namespace TDClass;

class ErrorHandler {
    public function __invoke( $request, $response, $exception ) {
        $status = 500;
        $message = $exception->getMessage();
        return $response
            ->withStatus(500)
            ->withJson( [ "status" => $status, "message" => $message ] );
            //  ->withHeader('Content-Type', 'application/json')
            //  ->write('Something went wrong!');
    }
}
