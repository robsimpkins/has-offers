<?php

namespace RobSimpkins\HasOffers\Brand;

use RobSimpkins\HasOffers\Brand\Client;

class Offer extends Client
{
    /**
     * API target class
     * @var string
     */
    protected $target = 'Offer';


    /**
     * Create an Offer.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function create(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareFormParams($args, $options));
    }

    /**
     * Set Offer Categories. This will replace any existing categories.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function setCategories(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareFormParams($args, $options));
    }

    /**
     * Set Offer Countries. This will replace and existing countries.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function setTargetCountries(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareFormParams($args, $options));
    }

    /**
     * Update an Offer.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function update(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareFormParams($args, $options));
    }
}
