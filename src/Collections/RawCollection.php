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

class RawCollection implements CollectionInterface
{
    private array $list;
    private string $path;

    public function __construct(array $list, string $path)
    {
        $this->list = $list;
        $this->path = $path;
    }

    public function directories(): DirectoryCollectionInterface
    {
        $filteredList = [];
        foreach ($this->list as $item) {
            if ($item === "." || $item === "..") {
                continue;
            }

            $folder = $this->path . $item . \DIRECTORY_SEPARATOR;
            if (\is_dir($folder) && \is_readable($folder)) {
                $filteredList[] = $folder;
            }
        }

        return new DirectoriesCollection($filteredList);
    }

    public function files(): FilesCollectionInterface
    {
        $filteredList = [];
        foreach ($this->list as $item) {
            if ($item === "." || $item === "..") {
                continue;
            }

            $filename = $this->path . $item;
            if (\is_file($filename) && \is_readable($filename)) {
                $filteredList[] = $filename;
            }
        }

        return new FilesCollection($filteredList);
    }

    public function filter(FilterInterface $filter): MixedCollection
    {
        return new MixedCollection($filter->filter($this));
    }

    public function get(): array
    {
        $filteredList = [];
        foreach ($this->list as $item) {
            if ($item === "." || $item === "..") {
                continue;
            }

            $filename = $this->path . $item;
            if (\is_readable($filename)) {
                $filteredList[] = $filename;
            }
        }

        return $filteredList;
    }
}
