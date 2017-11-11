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
use Zend\Code\Scanner\DirectoryScanner;

class DirectoryScannerTest extends TestCase
{
    public function testGetNamespacesReturnsArrayOfNamespacesAsStrings()
    {
        $directoryScanner = new DirectoryScanner(dirname(__DIR__) . '/TestAsset');
        $result = $directoryScanner->getNamespaces();
        $this->assertInternalType('array', $result);
        $this->assertContainsOnly('string', $result);
    }

    public function testGetNamespacesReturnsAllUniqueNamespacesDefinedInDirectory()
    {
        $directoryScanner = new DirectoryScanner(dirname(__DIR__) . '/TestAsset');
        $result = $directoryScanner->getNamespaces();

        $this->assertEquals(
            ['ZendTest\Code\TestAsset', 'ZendTest\Code\TestAsset\Proxy'],
            $result
        );
    }
}
