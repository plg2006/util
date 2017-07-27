<?php

namespace Plg\Util;

trait VariableObject
{
    private $data = [];

    public function __call( $method, $arguments ) {
        preg_match_all( '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $method, $matches );
        $method = $matches[0];
        foreach ( $method as &$match ) {
            $match = $match == strtoupper( $match ) ? strtolower( $match ) : lcfirst( $match );
        }
        
        $action = array_shift( $method );
        $requested_var = implode( '_', $method );

        switch ( $action ) {
            case 'isset':
                return isset( $this->data[$requested_var] );

            case 'empty':
                return empty( $this->data[$requested_var] );

            case 'get':
                if ( ! isset( $this->data[$requested_var] ) ) {
                    return null;
                }
                return $this->data[$requested_var];

            case 'set':
                $this->data[$requested_var] = $arguments[0];
                break;

            case 'append':
                // TODO
                break;

            case 'prepend':
                // TODO
                break;

            case 'push':
                // TODO
                break;

            case 'shift':
                // TODO
                break;

            case 'pop':
                // TODO
                break;

            case 'unshift':
                // TODO
                break;
        }

        return $this;
    }
}