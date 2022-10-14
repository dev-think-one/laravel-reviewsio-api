<?php

namespace Reviewsio\Endpoints;

trait HasResponsePagination
{
    abstract protected function entityKey(): string;

    public function total(): int
    {
        return (int) $this->baseResponse()->json("{$this->entityKey()}.total", 0);
    }

    public function perPage(): int
    {
        return (int) $this->baseResponse()->json("{$this->entityKey()}.per_page", 0);
    }

    public function currentPage(): int
    {
        return (int) $this->baseResponse()->json("{$this->entityKey()}.current_page", 0);
    }

    public function lastPage(): int
    {
        return (int) $this->baseResponse()->json("{$this->entityKey()}.last_page", 0);
    }

    public function from(): int
    {
        return (int) $this->baseResponse()->json("{$this->entityKey()}.from", 0);
    }

    public function to(): int
    {
        return (int) $this->baseResponse()->json("{$this->entityKey()}.to", 0);
    }

    public function items(): array
    {
        return $this->baseResponse()->json("{$this->entityKey()}.data", []);
    }
}
