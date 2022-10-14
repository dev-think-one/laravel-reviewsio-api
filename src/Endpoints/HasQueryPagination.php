<?php

namespace Reviewsio\Endpoints;

use Illuminate\Pagination\Paginator;

trait HasQueryPagination
{
    use HasGetQuery;

    public function paginate(int $perPage = 15, ?int $page = null, string $pageName = 'page'): static
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $this->addParameterToQuery('per_page', $perPage)
             ->addParameterToQuery('page', $page);

        return $this;
    }
}
