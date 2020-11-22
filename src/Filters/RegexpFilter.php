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
        return array_values(array_filter($collection->get(), function(string $item) {
            return preg_match(sprintf("/%s/%s", $this->condition, $this->flags), $item) === 1;
        }));
    }
}
