<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Code\Scanner;

use PHPUnit\Framework\TestCase;
use Zend\Code\Scanner\AggregateDirectoryScanner;
use Zend\Code\Scanner\DirectoryScanner;

class AggregateDirectoryScannerTest extends TestCase
{
    public function testAggregationOfDirectories()
    {
        $this->markTestIncomplete('This test needs to be filled out');
    }

    public function testGetNamespacesReturnsArrayOfNamespacesAsStrings()
    {
        $aggregateDirectoryScanner = new AggregateDirectoryScanner([
            new DirectoryScanner(dirname(__DIR__) . '/TestAsset'),
            new DirectoryScanner(__DIR__ . '/TestAsset')
        ]);
        $result = $aggregateDirectoryScanner->getNamespaces();
        $this->assertInternalType('array', $result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnly('string', $result);
    }

    public function testGetNamespacesReturnsAllUniqueNamespacesRetrievedFromDirectoryScanners(
    )
    {
        $directoryScanner1 = new DirectoryScanner(dirname(__DIR__) . '/TestAsset');
        $directoryScanner2 = new DirectoryScanner(__DIR__ . '/TestAsset');
        $aggregateDirectoryScanner = new AggregateDirectoryScanner([
            $directoryScanner1,
            $directoryScanner2
        ]);

        $result = $aggregateDirectoryScanner->getNamespaces();
        $expected = array_values(array_unique(array_merge(
            $directoryScanner1->getNamespaces(),
            $directoryScanner2->getNamespaces()
        )));

        $this->assertEquals($expected, $result);
    }
}
