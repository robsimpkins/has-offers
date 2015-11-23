# HasOffers PHP Client

## Overview
This libary is heavily based upon draperstudio/hasoffers-php-client.

## Installation

```js
composer require rob-simpkins/has-offers-php-client
```

## Example

```php
$client = RobSimpkins\HasOffers\Factory::create('Affiliate\\Offer', API_KEY, NETWORK_ID);

$response = $client->findAll();
var_dump($response);

```

## Supported
- Affiliate API (partial)
- Brand API (partial)
