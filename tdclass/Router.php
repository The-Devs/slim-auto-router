<?php
declare(strict_types=1);

namespace TDClass;

class Router {

    private $routeRule = [];
    private $depth = [];

    function __construct ( array $routeRules ) {
        $this->setRule( $routeRules );
    }

    public function isRoute ( array $data ) {
        return isset( $data[ "function" ] );
    }
    
    public function hasMiddleware ( array $data ) {
        return isset( $data[ "middleware" ] );
    }
   
    private function setRule ( array $data ) {
        $this->routeRule = $routeRule;
    }

    private function deepfy () {
        return $this->hash;
    }

}


?>