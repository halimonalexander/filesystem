<?php
/*
 * This file is part of Filesystem.
 *
 * (c) Halimon Alexander <a@halimon.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HalimonAlexander\Tests\Filesystem\Functional;

use HalimonAlexander\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemTest extends TestCase
{
    private const TESTCASE_FOLDER = __DIR__ . '/../testcase/';

    public function testDirectories()
    {
        $filesystem = new Filesystem();
        $response = $filesystem
            ->enter(self::TESTCASE_FOLDER)
            ->directories()
            ->get();

        $this->assertEquals([
            self::TESTCASE_FOLDER . 'folder1/',
            self::TESTCASE_FOLDER . 'folder2/',
            self::TESTCASE_FOLDER . 'other-folder/',
        ], $response);
    }

    public function testFiles()
    {
        $filesystem = new Filesystem();
        $response = $filesystem
            ->enter(self::TESTCASE_FOLDER)
            ->files()
            ->get();

        $this->assertEquals([
            self::TESTCASE_FOLDER . 'file.json',
            self::TESTCASE_FOLDER . 'file.txt',
            self::TESTCASE_FOLDER . 'other-file.txt',
        ], $response);
    }

    public function testMixed()
    {
        $filesystem = new Filesystem();
        $response = $filesystem
            ->enter(self::TESTCASE_FOLDER)
            ->get();

        $this->assertEquals([
            self::TESTCASE_FOLDER . 'file.json',
            self::TESTCASE_FOLDER . 'file.txt',
            self::TESTCASE_FOLDER . 'folder1',
            self::TESTCASE_FOLDER . 'folder2',
            self::TESTCASE_FOLDER . 'other-file.txt',
            self::TESTCASE_FOLDER . 'other-folder',
        ], $response);
    }
}
