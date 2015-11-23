<?php

namespace RobSimpkins\HasOffers\Affiliate;

use RobSimpkins\HasOffers\Affiliate\Client;

class Offer extends Client
{
    /**
     * API target class
     * @var string
     */
    protected $target = 'Affiliate_Offer';


    /**
     * Find all Offers.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function findAll(array $args = [], array $options = [])
    {
        return $this->get(__FUNCTION__, $this->prepareQueryParams($args, $options));
    }

    /**
     * Find an Offer by ID.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function findById(array $args = [], array $options = [])
    {
        return $this->get(__FUNCTION__, $this->prepareQueryParams($args, $options));
    }

    /**
     * Request access to an Offer that requires approval.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function requestOfferAccess(array $params = [], array $options = [])
    {
        return $this->get(__FUNCTION__, $this->prepareQueryParams($args, $options));
    }
}
