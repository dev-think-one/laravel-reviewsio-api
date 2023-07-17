<?php

namespace Reviewsio\Endpoints;

class SimpleRequest extends AbstractEndpointRequest
{
    public function call(array $options = [], array $pendingRequestOptions = []): AbstractEndpointResponse
    {
        return new SimpleResponse($this->client->pendingRequest($pendingRequestOptions)->send(...$options));
    }
}
