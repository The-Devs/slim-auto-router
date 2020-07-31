<?php

// Array utilities
function isAssoc( array $arr ) {
    if ( array() === $arr ) return false;
    return array_keys( $arr ) !== range( 0, count($arr) - 1 );
}

function unPrefix ( $string ) {
    return explode( "_", $string )[ 1 ];
}

function unPrefixAll( $array ) {
    if ( isAssoc( $array ) ) {
        foreach ( array_keys( $array ) as $value ) {
            $keys[] = unPrefix( $value );
        }
        $unPrefixedArr = array_combine( $keys, array_values( $array ) );
    } else {
        foreach ( $array as $value ) {
            $unPrefixedArr[] = unPrefix( $value );
        }
    }
    return $unPrefixedArr;
}
