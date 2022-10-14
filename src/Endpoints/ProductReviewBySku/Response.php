<?php

namespace Reviewsio\Endpoints\ProductReviewBySku;

use Illuminate\Support\Collection;
use Reviewsio\Endpoints\AbstractEndpointResponse;
use Reviewsio\Endpoints\HasResponsePagination;

class Response extends AbstractEndpointResponse
{
    use HasResponsePagination;

    public function storeName(): string
    {
        return (string) $this->baseResponse()->json('stats.store.name');
    }

    public function storeLogo(): string
    {
        return (string) $this->baseResponse()->json('stats.store.logo');
    }

    public function averageRating(): float
    {
        return (float) $this->baseResponse()->json('stats.average', 0);
    }

    public function count(): int
    {
        return (int) $this->baseResponse()->json('stats.count', 0);
    }

    public function reviews(): Collection
    {
        return collect($this->items());
    }

    protected function entityKey(): string
    {
        return 'reviews';
    }
}
