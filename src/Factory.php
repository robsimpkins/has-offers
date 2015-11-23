<?php

namespace RobSimpkins\HasOffers;

use InvalidArgumentException;

class Factory
{
    /**
     * Create a new Has Offers client instance.
     *
     * @param  string  $class
     * @param  string  $apiKey
     * @param  string  $networkId
     * @return RobSimpkins\HasOffers\Client
     */
    public static function create($class, $apiKey = null, $networkId = null)
    {
        // Prefix class with namespace
        $class = '\\RobSimpkins\\HasOffers\\' . $class;

        // Check if client class exists
        if ( ! class_exists($class)) {
            throw new InvalidArgumentException(sprintf('Cannot instantiate client - class \'%s\' does not exist', $class));
        }

        return new $class($apiKey, $networkId);
    }
}
