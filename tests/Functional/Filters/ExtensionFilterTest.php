<?php
/*
 * This file is part of Filesystem.
 *
 * (c) Halimon Alexander <a@halimon.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HalimonAlexander\Tests\Filesystem\Functional\Filters;

use HalimonAlexander\Filesystem\Exceptions\InvalidFilterApplied;
use HalimonAlexander\Filesystem\Filesystem;
use HalimonAlexander\Filesystem\Filters\ExtensionFilter;
use PHPUnit\Framework\TestCase;

class ExtensionFilterTest extends TestCase
{
    private const TESTCASE_FOLDER = __DIR__ . '/../../testcase/';

    public function testFilter()
    {
        $result = (new Filesystem())
            ->enter(self::TESTCASE_FOLDER)
            ->files()
            ->filter(new ExtensionFilter('json'))
            ->get();

        $this->assertEquals([self::TESTCASE_FOLDER . 'file.json'], $result);
    }

    public function testFilterWithFolders()
    {
        $this->expectException(InvalidFilterApplied::class);
        (new Filesystem())
            ->enter(self::TESTCASE_FOLDER)
            ->directories()
            ->filter(new ExtensionFilter('json'))
            ->get();
    }
}
