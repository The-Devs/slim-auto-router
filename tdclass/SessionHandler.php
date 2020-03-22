<?php
declare(strict_types=1);

namespace TDClass;

class SessionHandler {

    private $username = "";
    private $id = 0;
    private $key = "";

    // function __construct () {}
    
    public function create ( $username, $id ) {
        if ( ! is_string( $username ) || ! is_int( $id ) ) return false;

        $_SESSION[ "user" ][ "username" ] = $username;
        $_SESSION[ "user" ][ "id" ] = $id;
        return true;
    }
   
    public function destroy () {
        session_destroy();
        $this->setUsername( "" );
        $this->setId( 0 );
    }

    public function whoIsThere () {
        if ( empty ( $_SESSION[ "user" ] ) ) return false;
        return $_SESSION[ "user" ][ "username" ];
    }

    private function setUsername ( string $username ) {
        $this->username = $username;
    }
    private function getUsername () {
        return $this->username;
    }

    private function setId ( int $id ) {
        $this->id = $id;
    }
    private function getId () {
        return $this->id;
    }

}


?>