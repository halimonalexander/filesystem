<?php

namespace HalimonAlexander\Filesystem\Filters;

use HalimonAlexander\Filesystem\Collections\CollectionInterface;

interface FilterInterface
{
    public function filter(CollectionInterface $collection): array;
}
