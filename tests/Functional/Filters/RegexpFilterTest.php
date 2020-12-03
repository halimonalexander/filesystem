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

use HalimonAlexander\Filesystem\Filesystem;
use HalimonAlexander\Filesystem\Filters\RegexpFilter;
use PHPUnit\Framework\TestCase;

class RegexpFilterTest extends TestCase
{
    private const TESTCASE_FOLDER = __DIR__ . '/../../testcase/';

    public function testFilter()
    {
        $result = (new Filesystem())
            ->enter(self::TESTCASE_FOLDER)
            ->directories()
            ->filter(new RegexpFilter('folder[\d]+'))
            ->get();

        $this->assertEquals([
            self::TESTCASE_FOLDER . 'folder1/',
            self::TESTCASE_FOLDER . 'folder2/',
        ], $result);
    }
}
