<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Test\ContaoManager;


use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\DelegatingParser;
use HeimrichHannot\ContaoDisqusBundle\ContaoManager\Plugin;
use HeimrichHannot\ContaoDisqusBundle\HeimrichHannotContaoDisqusBundle;
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(Plugin::class, new Plugin());
    }
    public function testGetBundles()
    {
        $plugin = new Plugin();
        /** @var BundleConfig[] $bundles */
        $bundles = $plugin->getBundles(new DelegatingParser());
        static::assertCount(1, $bundles);
        static::assertInstanceOf(BundleConfig::class, $bundles[0]);
        static::assertEquals(HeimrichHannotContaoDisqusBundle::class, $bundles[0]->getName());
        static::assertEquals(ContaoCoreBundle::class, $bundles[0]->getLoadAfter()[0]);
    }
}