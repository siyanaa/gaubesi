<?php

/**
 * This file is part of cocur/slugify.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\Slugify\Tests\RuleProvider;

use Cocur\Slugify\RuleProvider\FileRuleProvider;
use org\bovigo\vfs\vfsStream;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * FileRuleProviderTest
 *
 * @package   Cocur\Slugify\RuleProvider
 * @author    Florian Eckerstorfer
 * @copyright 2015 Florian Eckerstorfer
 * @group     unit
 */
class FileRuleProviderTest extends MockeryTestCase
{
    /**
     * @covers \Cocur\Slugify\RuleProvider\FileRuleProvider::__construct()
     * @covers \Cocur\Slugify\RuleProvider\FileRuleProvider::getRules()
     */
    public function testGetRulesReturnsRulesReadFromJsonFile()
    {
        vfsStream::setup('fixtures', null, [
            'german.json'   => '{"ä": "a"}',
            'austrian.json' => '{"ß": "sz"}',
        ]);

        $provider = new FileRuleProvider(vfsStream::url('fixtures'));

        $this->assertEquals(['ä' => 'a'], $provider->getRules('german'));
        $this->assertEquals(['ß' => 'sz'], $provider->getRules('austrian'));
    }
}
