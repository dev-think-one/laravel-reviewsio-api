<?php

namespace Reviewsio\Endpoints;

use Reviewsio\ReviewsioApi;

abstract class AbstractEndpointRequest
{
    protected ReviewsioApi $client;

    public function __construct(ReviewsioApi $client)
    {
        $this->client = $client;
    }

    abstract public function call(array $options = []): AbstractEndpointResponse;
}
