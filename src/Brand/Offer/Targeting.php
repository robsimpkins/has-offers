<?php

namespace RobSimpkins\HasOffers\Brand\Offer;

use RobSimpkins\HasOffers\Brand\Client;

class Targeting extends Client
{
    /**
     * API target class
     * @var string
     */
    protected $target = 'OfferTargeting';


    /**
     * Add a TargetRuleOffer to an Offer.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function addTargetRuleToOffer(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareFormParams($args, $options));
    }

    /**
     * Get all TargetRuleOffers for an Offer.
     *
     * @param  array  $args
     * @param  array  $options
     * @return array
     */
    public function getRuleTargetingForOffer(array $args = [], array $options = [])
    {
        return $this->get(__FUNCTION__, $this->prepareQueryParams($args, $options));
    }

    /**
     * Remove a TargetRuleOffer from an Offer.
     *
     * @param  array  $args    [description]
     * @param  array  $options [description]
     * @return [type]          [description]
     */
    public function removeTargetRuleFromOffer(array $args = [], array $options = [])
    {
        return $this->post(__FUNCTION__, $this->prepareFormParams($args, $options));
    }
}
