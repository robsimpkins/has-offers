<?php

namespace RobSimpkins\HasOffers\Brand;

use RobSimpkins\HasOffers\Client as BaseClient;

abstract class Client extends BaseClient
{
    /**
     * Define API key parameter name.
     * @var string
     */
    const API_KEY_PARAM = 'NetworkToken';

    /**
     * Define network ID parameter name.
     * @var string
     */
    const NETWORK_ID_PARAM = 'NetworkId';
}
