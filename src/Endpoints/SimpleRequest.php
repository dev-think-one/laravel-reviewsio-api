<?php

namespace Reviewsio\Endpoints;

class SimpleRequest extends AbstractEndpointRequest
{
    public function call(array $options = []): AbstractEndpointResponse
    {
        return new SimpleResponse($this->client->pendingRequest()->send(...$options));
    }
}
