<?php

namespace RobSimpkins\HasOffers\Brand\Offer;

use RobSimpkins\HasOffers\Brand\Client;

class File extends Client
{
    /**
     * API target class
     * @var string
     */
    protected $target = 'OfferFile';


    /**
     * Create an OfferFile for an Offer.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function create(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareMultipartParams($args, $options));
    }
}
