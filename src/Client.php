<?php

namespace RobSimpkins\HasOffers;

use GuzzleHttp\Client as HttpClient;
use Exception;
use RuntimeException;

abstract class Client
{
    /**
     * Define API endpoint URL.
     * @var string
     */
    const API_ENDPOINT = 'https://api.hasoffers.com/Apiv3/json';

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

    /**
     * GuzzleHttp Client instance.
     * @var GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Has Offers API key.
     * @var string
     */
    protected $apiKey;

    /**
     * Has Offers Network ID.
     * @var string
     */
    protected $networkId;


    /**
     * Create new client instance.
     *
     * @param  string  $apiKey
     * @param  string  $networkId
     * @return void
     */
    public function __construct($apiKey = null, $networkId = null)
    {
        // Set API key and network ID
        $this->setApiKey($apiKey);
        $this->setNetworkId($networkId);

        // Prepare HTTP client
        $this->setHttpClient(new HttpClient);
    }

    /**
     * Set API key.
     *
     * @param  string  $apiKey
     * @return RobSimpkins\HasOffers\Client
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Get API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set network ID.
     *
     * @param  string  $networkId
     * @return RobSimpkins\HasOffers\Client
     */
    public function setNetworkId($networkId)
    {
        $this->networkId = $networkId;
        return $this;
    }

    /**
     * Get network ID.
     *
     * @return string
     */
    public function getNetworkId()
    {
        return $this->networkId;
    }

    /**
     * Set HTTP client.
     *
     * @param  object  $httpClient
     * @return RobSimpkins\HasOffers\Client
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Get HTTP client.
     *
     * @return object
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Send HTTP GET request to URI with specified options.
     *
     * @param  string  $method
     * @param  array   $options
     * @return object
     */
    public function get($method, array $options = [])
    {
        $response = $this->getHttpClient()->get(static::API_ENDPOINT, $this->mergeDefaultOptions($options, $method));
        return $this->handleResponse($response);
    }

    /**
     * Send HTTP POST request to URI with specified options.
     *
     * @param  string  $method
     * @param  array   $options
     * @return object
     */
    public function post($method, array $options = [])
    {
        $response = $this->getHttpClient()->post(static::API_ENDPOINT, $this->mergeDefaultOptions($options, $method));
        return $this->handleResponse($response);
    }

    /**
     * Merge default and existing options.
     *
     * @param  array   $options
     * @param  string  $method
     * @return array
     */
    public function mergeDefaultOptions(array $options = [], $method = null)
    {
        // Prepare default parameters
        $defaults = [
            static::API_KEY_PARAM    => $this->apiKey,
            static::NETWORK_ID_PARAM => $this->networkId,
            'Target'                 => $this->target,
            'Method'                 => $method,
        ];

        // Check if options contains multipart parameters
        if (isset($options['multipart'])) {
            return $this->prepareMultipartParams($defaults, $options);
        }

        // Check if options contains form parameters
        if (isset($options['form_params'])) {
            return $this->prepareFormParams($defaults, $options);
        }

        return $this->prepareQueryParams($defaults, $options);
    }

    /**
     * Prepare request query string parameters.
     *
     * @param  array  $args
     * @param  array  $params
     * @return array
     */
    public function prepareQueryParams(array $args, array $params = [])
    {
        return array_merge_recursive($params, ['query' => $args]);
    }

    /**
     * Prepare request form parameters.
     *
     * @param  array  $args
     * @param  array  $params
     * @return array
     */
    public function prepareFormParams(array $args, array $params = [])
    {
        return array_merge_recursive($params, ['form_params' => $args]);
    }

    /**
     * Prepare multipart form parameters.
     * Presently files must be referenced by their full filepath, prefixed with @.
     *
     * @param  array  $args
     * @param  array  $params
     * @return array
     */
    public function prepareMultipartParams(array $args, array $params = [])
    {
        // Filter resources from arguments
        $resources = array_filter($args, 'is_resource');

        // Build HTTP query for arguments and explode on &
        $args = urldecode(http_build_query($args));
        $args = explode('&', $args);

        // Separate key/value pairs into field name and contents
        $args = array_map(function ($value) {
            list($name, $contents) = explode('=', $value);
            return compact('name', 'contents');
        }, $args);

        // Restore resources to arguments
        foreach ($resources as $name => $contents) {
            $args[] = compact('name', 'contents');
        }

        return array_merge_recursive($params, ['multipart' => $args]);
    }

    /**
     * Prepare raw body form data.
     *
     * @param  string  $data
     * @param  array   $params
     * @return array
     */
    public function prepareRawBodyData($data, array $params = [])
    {
        return array_merge($params, ['body' => $data]);
    }

    /**
     * Handle HTTP client response.
     * Extract and return response body on success or throw exception on failure.
     *
     * @param  Psr7\Http\Message\ResponseInterface  $response
     * @return object
     */
    public function handleResponse($response)
    {
        // Get response body and status code
        $body = json_decode($response->getBody());
        $statusCode = $response->getStatusCode();

        // Check if JSON response decoded without error
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException(json_last_error_msg());
        }

        // Check if HTTP status code is inside success range
        if ($statusCode < 200 || $statusCode >= 300) {
            throw new Exception($body->message, $statusCode);
        }

        return $body;
    }
}
