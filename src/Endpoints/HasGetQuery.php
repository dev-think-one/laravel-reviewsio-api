<?php

namespace Reviewsio\Endpoints;

trait HasGetQuery
{
    protected array $query = [];

    public function withQuery(array $query = []): static
    {
        $this->query = array_merge($this->query, $query);

        return $this;
    }

    public function addParameterToQuery(string $parameter, mixed $value = null): static
    {
        $this->query[$parameter] = $value;

        return $this;
    }

    public function removeParameterFromQuery(string $parameter): static
    {
        if (isset($this->query[$parameter])) {
            unset($this->query[$parameter]);
        }

        return $this;
    }

    public function query(): array
    {
        return $this->query;
    }
}
