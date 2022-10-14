<?php

namespace Reviewsio\Endpoints\ProductReviewBySku;

use Reviewsio\Endpoints\AbstractEndpointRequest;
use Reviewsio\Endpoints\HasQueryPagination;

/**
 * https://api.reviews.io/documentation/index.html#api-Product_Reviews-List_Reviews_for_Product
 */
class Request extends AbstractEndpointRequest
{
    use HasQueryPagination;

    public function store(string $store): static
    {
        return $this->addParameterToQuery('store', $store);
    }

    public function sku(string $sku): static
    {
        return $this->addParameterToQuery('sku', $sku);
    }

    public function mpn(string $mpn): static
    {
        return $this->addParameterToQuery('mpn', $mpn);
    }

    public function call(array $options = []): Response
    {
        $this->withQuery($options);
        $response = $this->client->pendingRequest()->get('product/review', array_merge($this->query(), $options));

        return new Response($response);
    }
}
