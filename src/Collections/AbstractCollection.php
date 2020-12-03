<?php
/*
 * This file is part of Filesystem.
 *
 * (c) Halimon Alexander <a@halimon.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

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
