<?php

namespace RobSimpkins\HasOffers\Affiliate;

use RobSimpkins\HasOffers\Client as BaseClient;

abstract class Client extends BaseClient
{
    /**
     * Define API key parameter name.
     * @var string
     */
    const API_KEY_PARAM = 'api_key';

    /**
     * Define network ID parameter name.
     * @var string
     */
    const NETWORK_ID_PARAM = 'NetworkId';
}
