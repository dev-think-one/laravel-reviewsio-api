<?php

namespace Reviewsio\Endpoints;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Traits\ForwardsCalls;

abstract class AbstractEndpointResponse
{
    use ForwardsCalls;

    protected Response $baseResponse;

    public function __construct(Response $baseResponse)
    {
        $this->baseResponse = $baseResponse;
    }

    public function baseResponse(): Response
    {
        return $this->baseResponse;
    }

    public function __call(string $method, array $parameters)
    {
        return $this->forwardCallTo($this->baseResponse, $method, $parameters);
    }
}
