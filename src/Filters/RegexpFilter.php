<?php

namespace HalimonAlexander\Filesystem\Filters;

use HalimonAlexander\Filesystem\Collections\CollectionInterface;

class RegexpFilter implements FilterInterface
{
    private string $condition;
    private string $flags;

    public function __construct(string $condition, string $flags = "")
    {
        $this->condition = $condition;
        $this->flags = $flags;

    }

    public function filter(CollectionInterface $collection): array
    {
        return array_filter($collection->get(), function(string $item) {
            return preg_match(sprintf("/%s/%s", $this->condition, $this->flags), $item) === 1;
        });
    }
}
