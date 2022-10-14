<?php

namespace Reviewsio\Endpoints;

use Illuminate\Http\Client\Response;

abstract class AbstractEndpointResponse
{
    protected Response $baseResponse;

    public function __construct(Response $baseResponse)
    {
        $this->baseResponse = $baseResponse;
    }

    public function baseResponse(): Response
    {
        return $this->baseResponse;
    }
}
