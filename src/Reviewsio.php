<?php

namespace Reviewsio;

class Reviewsio
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function api(): ReviewsioApi
    {
        return new ReviewsioApi($this->config);
    }
}
