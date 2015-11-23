<?php

namespace RobSimpkins\HasOffers\Affiliate\Offer;

use RobSimpkins\HasOffers\Affiliate\Client;

class Targeting extends Client
{
    /**
     * API target class
     * @var string
     */
    protected $target = 'Affiliate_OfferTargeting';


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
}
