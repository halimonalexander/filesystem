<?php

namespace HalimonAlexander\Filesystem\Filters;

use HalimonAlexander\Filesystem\Collections\CollectionInterface;
use HalimonAlexander\Filesystem\Collections\FilesCollection;
use HalimonAlexander\Filesystem\Exceptions\InvalidFilterApplied;

class ExtensionFilter implements FilterInterface
{
    private string $extension;

    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    public function filter(CollectionInterface $collection): array
    {
        if (($collection instanceof FilesCollection) === false) {
            throw new InvalidFilterApplied("Extension filter can be used for FilesCollection only");
        }

        return array_filter($collection->get(), function(string $item) {
            return pathinfo($item, \PATHINFO_EXTENSION) === $this->extension;
        });
    }
}
