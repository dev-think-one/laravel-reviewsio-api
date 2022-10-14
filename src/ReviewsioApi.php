<?php

namespace Reviewsio;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Reviewsio\Endpoints\ProductReviewBySku;
use Reviewsio\Endpoints\SimpleRequest;

class ReviewsioApi
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function pendingRequest(array $additionalOptions = []): PendingRequest
    {
        $config = array_merge_recursive($this->config, $additionalOptions);

        $client = Http::baseUrl($config['base_url'] ?? 'https://api.reviews.io');

        if (isset($config['guzzle']) && is_array($config['guzzle'])) {
            $client->withOptions($config['guzzle']);
        }

        if (isset($config['headers']) && is_array($config['headers'])) {
            $client->withHeaders($config['headers']);
        }

        return $client;
    }

    public function simpleRequest(): SimpleRequest
    {
        return (new SimpleRequest($this));
    }

    public function productReviewBySku(array $query = []): ProductReviewBySku\Request
    {
        if (!isset($query['store']) && isset($this->config['store'])) {
            $query['store'] = $this->config['store'];
        }

        return (new ProductReviewBySku\Request($this))->withQuery($query);
    }
}
