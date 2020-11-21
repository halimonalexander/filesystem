<?php

namespace HalimonAlexander\Filesystem\Collections;

use HalimonAlexander\Filesystem\Filters\FilterInterface;

abstract class AbstractCollection implements CollectionInterface
{
    private array $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function filter(FilterInterface $filter): self
    {
        $this->list = $filter->filter($this);

        return $this;
    }

    public function get(): array
    {
        return $this->list;
    }
}
