<?php
/*
 * This file is part of Filesystem.
 *
 * (c) Halimon Alexander <a@halimon.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HalimonAlexander\Tests\Filesystem\Unittest\Collections;

use HalimonAlexander\Filesystem\Collections\DirectoryCollectionInterface;
use HalimonAlexander\Filesystem\Collections\FilesCollectionInterface;
use HalimonAlexander\Filesystem\Collections\MixedCollection;
use HalimonAlexander\Filesystem\Collections\RawCollection;
use HalimonAlexander\Filesystem\Filters\RegexpFilter;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \HalimonAlexander\Filesystem\Collections\RawCollection
 */
class RawCollectionTest extends TestCase
{
    private const TESTCASE_FOLDER = __DIR__ . '/../../testcase/';

    private RawCollection $collection;

    public function setUp(): void
    {
        $this->collection = new RawCollection([
            '.',
            '..',
            'file.json',
            'file.txt',
            'other-file.txt',
            'folder1',
            'folder2',
            'other-folder',
        ], self::TESTCASE_FOLDER);
    }

    /**
     * @covers ::files
     */
    public function testFiles()
    {
        $result = $this->collection->files();

        $this->assertInstanceOf(FilesCollectionInterface::class, $result);
        $this->assertEquals([
            self::TESTCASE_FOLDER . 'file.json',
            self::TESTCASE_FOLDER . 'file.txt',
            self::TESTCASE_FOLDER . 'other-file.txt',
        ], $result->get());
    }

    /**
     * @covers ::directories
     */
    public function testDirectories()
    {
        $result = $this->collection->directories();

        $this->assertInstanceOf(DirectoryCollectionInterface::class, $result);
        $this->assertEquals([
            self::TESTCASE_FOLDER . 'folder1/',
            self::TESTCASE_FOLDER . 'folder2/',
            self::TESTCASE_FOLDER . 'other-folder/',
        ], $result->get());
    }

    /**
     * @covers ::get
     */
    public function testGet()
    {
        $result = $this->collection->get();

        $this->assertIsArray($result);
        $this->assertEquals([
            self::TESTCASE_FOLDER . 'file.json',
            self::TESTCASE_FOLDER . 'file.txt',
            self::TESTCASE_FOLDER . 'other-file.txt',
            self::TESTCASE_FOLDER . 'folder1',
            self::TESTCASE_FOLDER . 'folder2',
            self::TESTCASE_FOLDER . 'other-folder',
        ], $result);
    }

    /**
     * @covers ::filter
     */
    public function testFilter()
    {
        $result = $this->collection->filter(new RegexpFilter('.*-.*'));

        $this->assertInstanceOf(MixedCollection::class, $result);
        $this->assertEquals([
            self::TESTCASE_FOLDER . 'other-file.txt',
            self::TESTCASE_FOLDER . 'other-folder',
        ], $result->get());
    }
}
