<?php
declare(strict_types=1);

namespace TDClass;

class Password {

    private $password = "";
    private $hash = "";

    function __construct ( string $password = "" ) {
        if ( ! empty( $password ) ) {
            $this->set( $password );
        }
    }

    public function create ( int $length = 0 ) {
        $max = ( empty( $length ) ) ? 10 : $length;
        $chars = "abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ.0123456789";
        $string = "";
        $i = 0;
        while ( $i < $max ) {
            $string .= $chars[ rand( 0, count( $chars ) ) ];
            $i++;
        }
        return $string;
    }
    
    public function set ( string $password ) {
        $this->password = $password;
    }
   
    public function hash () {
        $this->setHash( password_hash( $this->getPassword(), PASSWORD_BCRYPT ) );
        return $this->getHash();
    }

    private function setHash ( string $hash ) {
        $this->hash = $hash;
    }

    private function getHash () {
        return $this->hash;
    }

    private function getPassword () {
        return $this->password;
    }

}


?>