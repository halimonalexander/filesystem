<?php

namespace HalimonAlexander\Filesystem\Collections;

use HalimonAlexander\Filesystem\Filters\FilterInterface;

interface CollectionInterface
{
    public function filter(FilterInterface $filter): CollectionInterface;

    public function get(): array;
}
