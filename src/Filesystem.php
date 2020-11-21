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

namespace HalimonAlexander\Filesystem;

use HalimonAlexander\Filesystem\Collections\RawCollection;
use HalimonAlexander\Filesystem\Exceptions\PathScanFailed;

class Filesystem
{
    public function enter(string $path): RawCollection
    {
        try {
            $list = \scandir($path);
            if ($list === false) {
                throw new \ErrorException();
            }
        } catch (\ErrorException $exception) {
            throw new PathScanFailed('Unable to fetch files and folders list in path: ' . $path);
        }

        return new RawCollection($list, $path);
    }
}
