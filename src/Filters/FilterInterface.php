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

namespace HalimonAlexander\Filesystem\Filters;

use HalimonAlexander\Filesystem\Collections\CollectionInterface;

interface FilterInterface
{
    public function filter(CollectionInterface $collection): array;
}
