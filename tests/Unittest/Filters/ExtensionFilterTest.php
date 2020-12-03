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
use HalimonAlexander\Filesystem\Collections\MixedCollection;
use HalimonAlexander\Filesystem\Exceptions\InvalidFilterApplied;
use HalimonAlexander\Filesystem\Filters\ExtensionFilter;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \HalimonAlexander\Filesystem\Filters\ExtensionFilter
 */
class ExtensionFilterTest extends TestCase
{
    /**
     * @covers ::filter
     */
    public function testFilter()
    {
        $collection = new FilesCollection([
            'file1.jpg',
            'file2.jpg',
            'file3.png',
        ]);

        $filter = new ExtensionFilter('jpg');
        $result = $filter->filter($collection);

        $this->assertEquals([
            'file1.jpg',
            'file2.jpg',
        ], $result);
    }

    /**
     * @covers ::filter
     */
    public function testFilterException()
    {
        $this->expectException(InvalidFilterApplied::class);

        $collection = new MixedCollection([
            '/path/to/folder/',
            '/path/to/file.txt',
        ]);
        $filter = new ExtensionFilter('txt');
        $filter->filter($collection);
    }
}
