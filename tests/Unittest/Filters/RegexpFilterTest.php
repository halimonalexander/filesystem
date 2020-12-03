<?php
/*
 * This file is part of Filesystem.
 *
 * (c) Halimon Alexander <a@halimon.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HalimonAlexander\Tests\Filesystem\Unittest\Filters;

use HalimonAlexander\Filesystem\Collections\FilesCollection;
use HalimonAlexander\Filesystem\Filters\RegexpFilter;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \HalimonAlexander\Filesystem\Filters\RegexpFilter
 */
class RegexpFilterTest extends TestCase
{
    /**
     * @covers ::filter
     */
    public function testFilter()
    {
        $collection = new FilesCollection([
            'file1.jpg',
            'file2.jpg',
            'other-file.jpg',
        ]);

        $filter = new RegexpFilter('file\d+.*');
        $result = $filter->filter($collection);

        $this->assertEquals([
            'file1.jpg',
            'file2.jpg',
        ], $result);
    }
}
