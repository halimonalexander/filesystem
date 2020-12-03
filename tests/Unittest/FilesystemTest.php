<?php
/*
 * This file is part of Filesystem.
 *
 * (c) Halimon Alexander <a@halimon.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HalimonAlexander\Tests\Filesystem\Unittest;

use HalimonAlexander\Filesystem\Collections\RawCollection;
use HalimonAlexander\Filesystem\Exceptions\PathScanFailed;
use HalimonAlexander\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass  \HalimonAlexander\Filesystem\Filesystem
 */
class FilesystemTest extends TestCase
{
    /**
     * @covers ::enter
     */
    public function testEnter()
    {
        $filesystem = new Filesystem();
        $response = $filesystem->enter(__DIR__ . '/../testcase');

        $this->assertInstanceOf(RawCollection::class, $response);
    }

    /**
     * @covers ::enter
     */
    public function testEnterException()
    {
        $this->expectException(PathScanFailed::class);

        $filesystem = new Filesystem();
        $filesystem->enter(__DIR__ . '/nxFolder/');
    }
}
